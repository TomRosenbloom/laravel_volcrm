<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Organisation;
use App\Address;
use App\IncomeBand;
use App\OrganisationType;
use App\City;

use App\Helpers\Contracts\PaginationPageContract;
use App\Helpers\OrgName;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class OrganisationController extends Controller
{
    private $resultsPerPage = 4;
    private $numResults;
    private $numPages;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->numResults = Organisation::count();
        $this->numPages = round($this->numResults/$this->resultsPerPage);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PaginationPageContract $paginationPageContract)
    {
        if($request->input('num_items') !== null){ // a conditional - that's a bad sign!
            $this->resultsPerPage = $request->input('num_items');
        }

        if($request->input('search_terms')){ // another one!
            $organisations = Organisation::search($request->input('search_terms'))->paginate($this->resultsPerPage);
        } else {
            $organisations = Organisation::orderBy('order_name','asc')->paginate($this->resultsPerPage);
        }

        $paginationPageContract->setPaginationPage($organisations->currentPage());

        return view('organisations.index')->with([
            'organisations' => $organisations,
            'page' => $organisations->currentPage(),
            'num_items' => $this->resultsPerPage,
            'search_terms' => ''
        ]);
    }


    /**
     * Return list of search results, for ajax live search
     *
     * @param  Request $request [description]
     * @return string           [description]
     */
    public function liveSearch(Request $request)
    {
        $output = '';

        if($request->search_terms) {
            $output .= '';
            $organisations = Organisation::search($request->search_terms)->get();
            foreach($organisations as $organisation) {
                $output .= '<p><a href="">' . $organisation->name . '</a></p>';
            }
            $output .= '';
        } else {
            $output = "didn't find nothing";
        }

        return Response($output);
    }


    public function ccImport()
    {
        // come back to this when I get the API key

        $client = new Client();
        $res = $client->request('POST', 'https://url_to_the_api', [
            'form_params' => [
                'client_id' => 'test_id',
                'secret' => 'test_secret',
            ]
        ]);
        echo $res->getStatusCode();
        // "200"
        echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisation = new Organisation; // empty instance to prevent 'non-oject' error in form conditional
        $address = new Address; // ditto. NB you can do conditionals in the form, but that is a serious PITA

        return view('organisations.create')->with([
            'organisation'=>$organisation,
            'address'=>$address,
            'income_bands'=>IncomeBand::all()->pluck('textual'),
            'organisation_types'=>OrganisationType::all(),
            'cities'=>City::pluck('name','id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrgName $OrgName)
    {
        $this->validate($request, [
            'name' => 'required',
            'postcode' => 'required'
        ]);

        $user_id = Auth::id();

        $organisation = new Organisation;
        $organisation->name = $request->input('name');
        $organisation->order_name = $OrgName->definiteArticle($request->input('name'));
        $organisation->aims_and_activities = $request->input('aims_and_activities');
        $organisation->postcode = $request->input('postcode');
        $organisation->email = $request->input('email');
        $organisation->telephone = $request->input('telephone');
        $organisation->income_band_id = $request->input('income_band_id');
        $organisation->user_id = $user_id;
        $organisation->save();

        $address = new Address;
        $address->line_1 = $request->input('line_1');
        $address->line_2 = $request->input('line_2');
        $address->city = $request->input('city');
        $address->postcode = $request->input('postcode');
        $address->save();

        $organisation->addresses()->attach($address,['is_default' => 1]);

        $attach_data = [];
        foreach($request->input('organisation_type') as $orgtype){
            if(isset($orgtype['id'])){
                $attach_data[$orgtype['id']] = array('reg_num'=>$orgtype['reg_num']);
            }
        }
        $organisation->organisation_types()->attach($attach_data);

        Log::info('Stored new organisation, id ' . $organisation->so_id);

        return redirect('/organisations')->with('success', 'Added organisation ' . $organisation->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organisation = Organisation::find($id);
        $address = $organisation->getDefaultAddress();

        return view('organisations.show')->with([
            'organisation'=>$organisation,
            'address'=>$address
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organisation = Organisation::find($id);

        $address = $organisation->getDefaultAddress();

        $income_bands = IncomeBand::all()->pluck('textual');

        $organisation_types = OrganisationType::all();

        $this_org_types = $organisation->organisation_types()->get();

        return view('organisations.edit')->with([
            'organisation'=>$organisation,
            'address'=>$address,
            'income_bands'=>$income_bands,
            'organisation_types'=>$organisation_types,
            'this_org_types'=>$this_org_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PaginationPageContract $paginationPage, OrgName $OrgName)
    {
        $this->validate($request, [
            'name' => 'required',
            'postcode' => 'required'
        ]);

        $organisation = Organisation::find($id);
        $organisation->name = $request->input('name');
        $organisation->order_name = $OrgName->definiteArticle($request->input('name'));
        $organisation->aims_and_activities = $request->input('aims_and_activities');
        $organisation->postcode = $request->input('postcode');
        $organisation->email = $request->input('email');
        $organisation->telephone = $request->input('telephone');
        $organisation->income_band_id = $request->input('income_band_id');
        $organisation->save();

        $address = $organisation->getDefaultAddress(); // can we *guarantee* this will be the right one?
        $address->line_1 = $request->input('line_1');
        $address->line_2 = $request->input('line_2');
        $address->city = $request->input('city');
        $address->postcode = $request->input('postcode');

        $address->save();

        $sync_data = [];
        foreach($request->input('organisation_type') as $orgtype){
            if(isset($orgtype['id'])){
                $sync_data[$orgtype['id']] = array('reg_num'=>$orgtype['reg_num']);
            }
        }
        $organisation->organisation_types()->sync($sync_data);

        $page = $paginationPage->getPaginationPage();

        Log::info('Updated organisation, id ' . $id);
        Log::channel('slack')->critical('Updated organisation, id ' . $id);

        return redirect()->route('organisations.index',['page'=>$page])->with('success', 'Updated organisation ' . $organisation->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PaginationPageContract $paginationPage)
    {
        $organisation = Organisation::find($id);
        $organisation->delete();

        // to return to the pagination page where the item was located,
        // get the page we came from, which will have been set in the index page
        // (that assumes we got here from the index page...)
        // return to that page unless the deletion has reduced the number of pages
        // so maybe, if page doesn't exist, go to the last page?
        $page = $paginationPage->getPaginationPage();
        if($page > $this->numPages){
            $page = $this->numPages;
        }

        //return redirect('/organisations')->with('success', 'Deleted organisation ' . $organisation->name);
        return redirect()->route('organisations.index',['page'=>$page])->with('success', 'Deleted organisation ' . $organisation->name);

    }
}

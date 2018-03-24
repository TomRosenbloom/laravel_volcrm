<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Organisation;
use App\IncomeBand;

class OrganisationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = Organisation::orderBy('name','asc')->paginate(4);
        return view('organisations.index')->with('organisations', $organisations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $income_bands = IncomeBand::all()->pluck('textual');
        $organisation = new Organisation; // empty instance to prevent 'non-oject' error in form conditional
        return view('organisations.create')->with([
            'organisation'=>$organisation,
            'income_bands'=>$income_bands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'postcode' => 'required'
        ]);

        $user_id = Auth::id();

        $organisation = new Organisation;
        $organisation->name = $request->input('name');
        $organisation->aims_and_activities = $request->input('aims_and_activities');
        $organisation->postcode = $request->input('postcode');
        $organisation->email = $request->input('email');
        $organisation->telephone = $request->input('telephone');
        $organisation->income_band_id = $request->input('income_band_id');
        $organisation->user_id = $user_id;
        $organisation->save();

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

        return view('organisations.edit')->with([
            'organisation'=>$organisation,
            'address'=>$address,
            'income_bands'=>$income_bands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'postcode' => 'required'
        ]);

        $organisation = Organisation::find($id);
        $organisation->name = $request->input('name');
        $organisation->aims_and_activities = $request->input('aims_and_activities');
        $organisation->postcode = $request->input('postcode');
        $organisation->email = $request->input('email');
        $organisation->telephone = $request->input('telephone');
        $organisation->income_band_id = $request->input('income_band_id');
        $organisation->save();

        // this would work if 'city' was made 'fillable'
        // which means that Laravel sees this as a 'mass assignment'
        //$organisation->getDefaultAddress()->update(array('city' => $request->input('city')));
        // [this would be much easier if I had made the rel one-to-one or one-to-many...]
        //
        // Currently postcode belongs to org, but should belong to address
        // That has the potential to be a PITA...
        // ...will at least need to make a method in Organisation for getting postcode, I think

        // fuck, I've got to update the pivot table as well! No - only in 'store', right?

        $address = $organisation->getDefaultAddress(); // can we guarantee this will be the right one?
        $address->line_1 = $request->input('line_1');
        $address->line_2 = $request->input('line_2');
        $address->city = $request->input('city');
        $address->postcode = $request->input('postcode');
        $address->is_default = 1;

        $address->save();

        return redirect('/organisations')->with('success', 'Updated organisation ' . $organisation->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organisation = Organisation::find($id);
        $organisation->delete();
        return redirect('/organisations')->with('success', 'Deleted organisation ' . $organisation->name);
    }
}

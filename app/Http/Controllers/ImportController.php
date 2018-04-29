<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Helpers\OrgName;

class ImportController extends Controller
{

    /**
    * A homepage for any import actions
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      //
    }


    public function org_form()
    {
        return view('organisations.import');
    }

    /**
     * Import organisations
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function organisations(Request $request, OrgName $OrgName)
    {
        if($request->file('imported-file')) {
            $path = $request->file('imported-file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

            if(!empty($data) && $data->count()) {
                $data = $data->toArray();
                for($i=0;$i<count($data);$i++)
                {
                    $data[$i]['user_id'] = Auth::id();
                    $data[$i]['income_band_id'] = '7'; // 'unknown'
                    $data[$i]['order_name'] = $OrgName::definiteArticle($data[$i]['name']);
                    $dataImported[] = $data[$i];
                }
            }
            DB::table('organisations')->insert($dataImported);
        }
        return redirect('/organisations')->with('success', 'Imported ' . count($dataImported) . 'organisations');
    }

}

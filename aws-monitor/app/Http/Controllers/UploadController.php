<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;

class UploadController extends Controller
{
    public function index(){
        $data = DB::table('uploads')->orderBy('id','ASC')->get();
        return view('reports.upload', compact('data'));
    }

    public function dataImport(Request $request){
        $this->validate($request, [
            'select_file'   => 'required|mimes:xls,xlsx,csv'
        ]);
        $path = $request->file('select_file')->getRealpath();

        $data = Excel::load($path)->get();

        if($data ->count() > 0) 
        {
            foreach($data as $key => $row)
            {
                $insert_data[] = [
                    'datetime'       => $row->datetime,
                    'rh_wimea'    => $row->rh_wimea,
                    'rh_unma'     => $row->rh_unma,
                    'sol_wimea'   => $row->sol_wimea,
                    'sol_unma'    => $row->sol_unma,
                    'temp_wimea'  => $row->temp_wimea,
                    'temp_unma'   => $row->temp_unma,
                    'press_wimea' => $row->press_wimea,
                    'press_unma'  => $row->press_unma,
                    'station'     => $row->station,
                ];
            }
            if(!empty($insert_data))
            {
                DB::table('uploads')->insert($insert_data);
            }
        }
        return back()->with('success','Excel Data Imported successfully.');

    }
}

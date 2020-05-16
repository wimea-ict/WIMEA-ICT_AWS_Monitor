<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NodeData extends Controller
{
    public function twometerdata(){
        $data  = DB::table('TwoMeterNode')->orderBy('id','DESC')->LIMIT('1000')->get();
        return view('reports.display2m', compact('data'));
    }
    
    public function tenmeterdata(){
        $data = DB::table('TenMeterNode')->orderBy('id','DESC')->LIMIT('1000')->get();
        return view('reports.display10m', compact('data'));        
    }

    public function grounddata(){
        $data = DB::table('GroundNode')->orderBy('id','DESC')->LIMIT('1000')->get();
        return view('reports.displayground', compact('data'));        
    }

    public function manualdata(){
        $data = DB::table('observationslip')->orderBy('id','DESC')->LIMIT('1000')->get();
        return view('reports.displaymanualdata', compact('data'));
    }

    public function entebbecaldata(){
        $data  = DB::table('temperaturecalibration_wimea_unma')->orderBy('index','DESC')->LIMIT('1000')->get();
        return view('reports.entebbecaldata', compact('data'));
    }

    public function kamulicaldata(){
        $data  = DB::table('temperaturecalibration_wimea_unma')->orderBy('index','DESC')->LIMIT('1000')->get();
        return view('reports.kamulicaldata', compact('data'));
    }

    public function entebbecaldata2(){
        $data = DB::table('humiditycalibration_wimea_unma')->orderBy('index','DESC')->LIMIT('1000')->get();
        return view('reports.entebbecaldata2', compact('data'));
    }

    public function kamulicaldata2(){
        $data = DB::table('pressurecalibration_wimea_unma')->orderBy('index','DESC')->LIMIT('1000')->get();
        return view('reports.kamulicaldata2', compact('data'));
    }
}

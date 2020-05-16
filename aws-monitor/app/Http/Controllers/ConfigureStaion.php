<?php

namespace station\Http\Controllers;
use App\layouts;
use station\Station;
use Auth;
use Illuminate\Http\Request;

class ConfigureStaion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::where('StationCategory', 'aws')->get();
        return view('layouts.configurestation', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stationToEdit = Station::find($id);
        

        return view('layouts.addstation', compact('stationToEdit'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* 
        'station_id', 'StationName', 'StationNumber', 'StationRegNumber', 'Location', 'Indicator', 'StationRegion', 'Country', 'Latitude', 'Longitude', 'Altitude', 'StationStatus', 'StationType', 'Opened', 'Closed', 'SubmittedBy', 'CreationDate'
        */
    public function update(Request $request)
    {
        if($request->get('station_number')!= null){
            $id=$request->get('station_number');
        $station = Station::where('StationNumber', $id)->first();
        $station->StationName = $request->get('station_name');
       
        $station->StationNumber = $request->get('snumber');
        $station->Location = $request->get('slocation');
        $station->Latitude = $request->get('latitude');
        $station->Longitude = $request->get('longitude');
            /* 'city' => $request->get('city'),
            'code' => $request->get('code'), */
            $station->StationRegion = $request->get('region');
            $station->Opened = $request->get('date_opened');
            $station->Closed = $request->get('date_closed');
            $station->StationType = $request->get('station_type');
            $station->StationStatus= $request->get('station_status');
            $station->Country= $request->get('country');
            $station->SubmittedBy= Auth::user()->name;
        $station->save();
        }
        return redirect('/configurestation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

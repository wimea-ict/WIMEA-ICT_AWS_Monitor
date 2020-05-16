<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

    // All my routes that needs a logged in user
    Route::resource('addstation', 'StationsController');
    Route::resource('configurestation', 'ConfigureStaion');
    Route::post('updateStation','ConfigureStaion@update');

    Route::get('data_list','UploadController@index');
    Route::post('upload','UploadController@dataImport');
    Route::get('export/{type}','UploadController@dataExport'); 

    Route::resource('downloads','StationDownloads');
    Route::get('caldata1','NodeData@entebbecaldata');
    Route::get('caldata2','NodeData@entebbecaldata2');
    Route::get('caldata3','NodeData@kamulicaldata');
    Route::get('caldata4','NodeData@kamulicaldata2');
    Route::get('nodeData1','NodeData@twometerdata');
    Route::get('nodeData2','NodeData@tenmeterdata');
    Route::get('nodeData3','NodeData@grounddata');
    Route::get('nodeData4','NodeData@manualdata');
    //Route::resource('makererestation','MakerereController');   
    Route::resource('mayuge_station','MayugeStationController');
    Route::resource('kamuli_station','KamuliStationController');
    Route::resource('jinja_station','JinjaStationController');
    Route::resource('buyende2_station','BuyendeStationController');
    Route::resource('lwengo_station','LwengoStationController');
    Route::resource('makerere_station','MakerereStationController');
    Route::resource('entebbe_station','EntebbeStationController');
    Route::resource('mubende_station','MubendeStationController');
    Route::resource('configure10mnode', 'TenMNodeController');
    Route::post('updateTenMNode', 'TenMNodeController@update');
    Route::resource('configure2mnode', 'TwoMNodeController');
    Route::post('updateTwoMNode', 'TwoMNodeController@update');
    Route::resource('configuresinknode', 'SinkNodeController');
    Route::post('updateSinkNode', 'SinkNodeController@update');
    Route::resource('configuregroundnode', 'GroundNodeController');
    Route::post('updateGroundNode', 'GroundNodeController@update');
    Route::resource('configureproblem', 'ProblemConfigurationsController');
    Route::resource('editProblemConfigurations', 'ProblemsController');
    Route::post('updateProblemConfigurations', 'ProblemsController@update');
    Route::resource('viewStationStatus', 'StationStatusController');
    Route::get('selectedStationStatus/{id}', 'StationStatusController@show');
    Route::resource('googlemaps','GoogleMapsController');
    //Route::get('/analyserdata','AnalyserController@index');
    Route::get('selected_aws/{id}', 'AnalyticController@show');
     
    Route::get('archivedProblems/{id}', 'StationStatusController@archivedProblems')->name('archivedProblems');

    Route::resource('analyser','AnalyserController');
    Route::resource('analytic','AnalyticController');
    Route::get('/node10m_report','TenMNodeController@report1');
    Route::get('/node2m_report','TwoMNodeController@report1');
    Route::get('/nodesink_report','SinkNodeController@report1');
    Route::get('/nodegnd_report','GroundNodeController@report1');

    Route::get('/general_reports','GeneralReportsController@index');
    Route::post('/plot_reports','GeneralReportsController@plotGraphs');

    Route::post('/reports10m','TenMNodeController@get10mStationReports');
    Route::post('/reportsGnd','GroundNodeController@getGndStationReports');
    Route::post('/reportsSink','SinkNodeController@getSinkStationReports');
    Route::post('/reports2m','TwoMNodeController@get2mStationReports');
    Route::get('/report_problems','ReportController@report');
  
    Route::get('/hello','MakerereController@index');
    Route::get('/send_test_email', function(){
        Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
        {
            $message->subject('Mailgun and Laravel are awesome!');
            $message->from('byarus90@gmail.com', 'Website Name');
            $message->to('kibsysapps@gmail.com');
        });
    });
    Route::get('/probTbData', 'ViewAnalyzerData@showProbTable');

    Route::resource('users', 'UserController');
    Route::get('edit_users/{id}', 'UserController@edit');
    Route::get('delete_users/{id}', 'UserController@destroy');
    Route::get('/logs', function(){
        return view('layouts.logs');
    });

    Route::resource('maillisttable', 'maillistcontroller');
    Route::get('delete_mail/{id}', 'maillistcontroller@destroy');

    Route::get('/viewProblemLogFile', 'ViewAnalyzerData@viewProblemLogFile');

    Route::get('/downLoadUserLogFile', 'ViewAnalyzerData@downLoadUserLogFile');

    Route::get('/downloadProblemLogFile', 'ViewAnalyzerData@downloadProblemLogFile');

});



/*
Route::get('/', function () {
    return view('/auth/welcome');
});
*/
Auth::routes();
/*
Route::get('/', function () {
        return view('welcome');
    })->middleware('auth');

    Route::get('/welcome', 'welcomeController@index');*/


 Route::get('/welcome', 'welcomeController@index')->name('welcome');

 Route::get('/', 'welcomeController@index')->name('welcome');


//Routes for file downloads
Route::get('buyende1file', function(){
    $file = public_path()."/stationsData/buyende_1.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "buyende_1.dat", $headers);
});

Route::get('buyende2file', function(){
    $file = public_path()."/stationsData/buyende_2.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "buyende_2.dat", $headers);
});

Route::get('entebbefile', function(){
    $file = public_path()."/stationsData/entebbe.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "entebbe.dat", $headers);
});

Route::get('jinjafile', function(){
    $file = public_path()."/stationsData/jinja.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "jinja.dat", $headers);
});

Route::get('kamulifile', function(){
    $file = public_path()."/stationsData/kamuli.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "kamuli.dat", $headers);
});

Route::get('makererefile', function(){
    $file = public_path()."/stationsData/makerere.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "makerere.dat", $headers);
});

Route::get('mayugefile', function(){
    $file = public_path()."/stationsData/mayuge.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "mayuge.dat", $headers);
});

Route::get('testfile', function(){
    $file = public_path()."/stationsData/test.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "test.dat", $headers);
});

Route::get('kalirofile', function(){
    $file = public_path()."/stationsData/kaliro.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "kaliro.dat", $headers);
});

Route::get('mubendefile', function(){
    $file = public_path()."/stationsData/mubende.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "mubende.dat", $headers);
});

Route::get('lwengofile', function(){
    $file = public_path()."/stationsData/lwengo.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "lwengo.dat", $headers);
});

Route::get('fosfile', function(){
    $file = public_path()."/stationsData/fos.dat";

    $headers = array(
        'Content-Type: application/dat',
    );

    return Response::download($file, "fos.dat", $headers);
});

Route::get('Jinja','BenchmarkingController@jinja_adcon_aws');
Route::get('Kamuli','BenchmarkingController@kamuli_adcon_aws');
Route::get('Entebbe','BenchmarkingController@entebbe_adcon_aws');

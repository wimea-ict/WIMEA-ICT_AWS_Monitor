<?php

namespace station\Http\Controllers;


use App\layouts;
use station\maillist;
use station\User;
use DB;
use station\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\maillist;
use \Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class maillistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | maillist  Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles addition of new maillist recipients to "contacts.txt"
    |
    */
    public function index(){
                
        $mail = array();
        $user_email = array();
        //find how to do joins in laravel 
        //find how to write to text files in laravel

        //SELECT userID, users.id as userid,users.name as name, stationID as stationID, stations.station_id as station_id,stations.Location as location FROM maillist m LEFT JOIN users ON m.userID = users.id LEFT JOIN stations ON m.stationID = stations.station_id


        $user_email = maillist::leftJoin('users','maillist.userID', '=', 'users.id')->leftJoin('stations','maillist.stationID','=','stations.station_id')->select('users.email','users.Name','stations.Location','maillist.id','status')->get();


        $mail = maillist::all()->toArray();


        
        $user = DB::table('maillist')->get();
        return view('layouts.maillisttable', ['maillist'=>$user_email], compact('mail','user_email'));
       // return view('layouts.maillisttable', compact('mail','user_email'));
    }



   // use maillist;
   public function showmaillistForm()
   {
       return view('auth.maillist');
   }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/addstation';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \station\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
        
        ]);
    }
    

    public function show(){
        return view('layouts.maillisttable')->with('success','Information has been  deleted');
    }

    public function destroy($id)
    {
        //
        $userdel = maillist::find($id);
        $status = 0 ;

       // $userdel->update(array('status'=>$status));

        $userdel = DB::table('maillist')->where('id','=',$id)->update(['status' => 0]);
        $user_emails = DB::table('maillist')->get();
        //$user_email = [];
        return redirect('/maillisttable');
        //return view('layouts.maillisttable', compact('user_email'))->with('success','Information has been  deleted');
    }

 
}


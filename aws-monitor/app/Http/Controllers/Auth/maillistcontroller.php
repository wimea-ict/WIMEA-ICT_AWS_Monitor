<?php
namespace station\Http\Controllers\Auth;


use App\layouts;
use station\maillist;
use station\User;
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


        $user_email = maillist::leftJoin('users','maillist.userID', '=', 'users.id')->leftJoin('stations','maillist.stationID','=','stations.station_id')->select('users.email','users.Name','stations.Location','maillist.id')->get();

        $mail = maillist::all()->toArray();

        return view('layouts.maillisttable', compact('mail','user_email'));
    }



   // use maillist;
   public function showmaillistForm()
   {
       return view('auth/maillist');
   }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/layouts/maillisttable';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function maillist(Request $request)
    {
      //  SELECT maillist.Name as Name, users.email as email FROM maillist INNER JOIN users ON maillist.Name = users.name ORDER BY id DESC
        
        $mail = array();
        $user_email = array();
        //find how to do joins in laravel 
        //find how to write to text files in laravel

       

        $user_email = maillist::leftJoin('users','maillist.userID', '=', 'users.id')->leftJoin('stations','maillist.stationID','=','stations.station_id')->select('users.email','users.Name','stations.Location','maillist.id')->get();


        $mail = maillist::all()->toArray();

        return view('auth.maillist', compact('mail','user_email'));
       
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
            redirect('/maillisttable'),
        ]);
            }

}


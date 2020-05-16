<?php

namespace station\Http\Controllers;

use station\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use station\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('users')->get();
        return view('layouts.display_users', ['users'=>$users]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$users = DB::table('users')->where('id', $id)->first();
        $users = User::find($id);
        if(count($users)>0){
            return view('auth.editUser', compact('users', 'id'));
        }
        else
            return view(layouts.display_users);
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
        //
        $user= User::find($id);
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->phone=$request->get('phone');
        $user->password=bcrypt($request->get('password'));
        $user->save();
        $users = User::orderByDesc('updated_at')->get();
        return view('layouts.display_users', ['users'=>$users])->with('successEdit', 'Information has been edited successfully');
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
        $user = User::find($id);
        $user->delete();
        $users = DB::table('users')->get();
        return view('layouts.display_users', ['users'=>$users])->with('success','Information has been  deleted');
    }
}

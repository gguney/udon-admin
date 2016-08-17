<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('user.index',compact('users'));
    }
    public function get()
    {
        $users = User::all();
        return Datatables::of($users)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("user/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'user.destroy\', $id))) }}
                                    {{ Form::submit(\'DELETE\', array(\'class\' => \'w-button button-bad little\')) }}
                                    {{ Form::close() }}
                                    '
            )
            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return View('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
            'username'       => 'required',
            'email'         =>  'required',
            'password'      =>  'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new User();
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->save();
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('user');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user->roles = $user->roles()->get();
        $roles = Role::all();
        $usersRoles = array();
        for($i=0;$i<sizeof($user->roles);$i++)
        {
            $usersRoles[] = $user->roles[$i]->id;
        }
        return View('user.edit',compact('user','roles','usersRoles'));
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

        $rules = array(
            'username'       => 'required',
            'email'         =>  'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $user = User::find($id);
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->save();
            DB::table('users-roles')->where('user_id', '=', $user->id)->delete();
            $selectedRoles = Input::get('roles');
            for($i = 0; $i<sizeof($selectedRoles);$i++)
                $data[] = array('user_id' => $user->id, 'role_id' => $selectedRoles[$i]);
            DB::table('users-roles')->insert($data);
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('user');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'Successfully deleted the user!');
        return Redirect::to('user');

    }
}

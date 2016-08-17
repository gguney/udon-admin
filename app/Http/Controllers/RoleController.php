<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
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

        return View('role.index',compact('roles'));
    }

    public function get()
    {
        $roles = Role::all();
        return Datatables::of($roles)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("role/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'role.destroy\', $id))) }}
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
       return View('role.create');
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('role/create')
                ->withErrors($validator);
        } else {
            // store
            $role = new Role();
            $role->name = Input::get('name');
            $role->description = Input::get('description');
            $role->save();
            Session::flash('message', 'Successfully created role!');
            return Redirect::to('role');
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
        $role = Role::find($id);
        return View('role.edit',compact('role'));
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('role/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $role = Role::find($id);
            $role->name = Input::get('name');
            $role->description = Input::get('description');
            $role->save();
            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('role');
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

        $role = Role::find($id);
        $role->delete();
        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('role');


    }
}

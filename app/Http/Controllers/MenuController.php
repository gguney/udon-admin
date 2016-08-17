<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Menu;
use App\Models\Management;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class MenuController extends Controller
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
        return View('menu.index',compact('menus'));
    }

    public function get()
    {
        $menus = Menu::with('management')->orderBy('id')->get();
        return Datatables::of($menus)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("menu/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'menu.destroy\', $id))) }}
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
        $managements = Management::orderBy('id')->get();
        return View('menu.create',compact('managements'));
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
            'management' => 'required',
            'name'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('menu/create')
                ->withErrors($validator);
        } else {
            // store
            $menu = new Menu();
            $menu->ref_management_id = Input::get('management');
            $menu->name = Input::get('name');
            $menu->description = Input::get('description');
            $menu->save();
            Session::flash('message', 'Successfully created menu!');
            return Redirect::to('menu');
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
        $managements = Management::orderBy('id')->get();
        $menu = Menu::find($id);
        return View('menu.edit',compact('managements','menu'));
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
            'management' => 'required',
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('menu/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $menu = Menu::find($id);
            $menu->ref_management_id = Input::get('management');
            $menu->name = Input::get('name');
            $menu->description = Input::get('description');
            $menu->save();
            Session::flash('message', 'Successfully updated menu!');
            return Redirect::to('menu');
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

        $menu = Menu::find($id);
        $menu->delete();
        Session::flash('message', 'Successfully deleted the menu!');
        return Redirect::to('menu');

    }
}

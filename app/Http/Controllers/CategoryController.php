<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Menu;
use App\Models\Category;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
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
        return View('category.index',compact('categories'));
    }

    public function get()
    {
        $categories = Category::with('menu')->orderBy('id')->get();
        return Datatables::of($categories)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("category/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'category.destroy\', $id))) }}
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
        $menus = Menu::orderBy('id')->get();
        return View('category.create',compact('menus'));
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
            'menu' => 'required',
            'name'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('menu/create')
                ->withErrors($validator);
        } else {
            // store
            $category = new Category();
            $category->ref_menu_id = Input::get('menu');
            $category->name = Input::get('name');
            $category->description = Input::get('description');
            $category->save();
            Session::flash('message', 'Successfully created menu!');
            return Redirect::to('category');
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
        $menus = Menu::orderBy('id')->get();
        $category = Category::find($id);
        return View('category.edit',compact('menus','category'));
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
            'menu' => 'required',
            'name'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('category/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $category = Category::find($id);
            $category->ref_menu_id = Input::get('menu');
            $category->name = Input::get('name');
            $category->description = Input::get('description');
            $category->save();
            Session::flash('message', 'Successfully updated category!');
            return Redirect::to('category');
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

        $category = Category::find($id);
        $category->delete();
        Session::flash('message', 'Successfully deleted the category!');
        return Redirect::to('category');

    }
}

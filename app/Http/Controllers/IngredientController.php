<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ingredient;
use App\Models\File;
use App\Http\Controllers\FileController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class IngredientController extends Controller
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

        return View('ingredient.index',compact('ingredients'));
    }


    public function get()
    {

        $ingredients =Ingredient::orderBy('ingredients.id')

            ->leftJoin(DB::raw('(SELECT ref_id,file_name,path FROM files where type_name=\'ingredient\' ) files'), function($join)
            {
                $join->on('ingredients.id', '=', 'files.ref_id');
            })->get();


        return Datatables::of($ingredients)
            ->addColumn('image','<a href="#"onclick="openLightbox(event)" ><img src ="/images/ingredient/{{$file_name}}" alt="{{$description}}" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("ingredient/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'ingredient.destroy\', $id))) }}
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
       return View('ingredient.create');
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
            return Redirect::to('ingredient/create')
                ->withErrors($validator);
        } else {
            // store
            $ingredient = new Ingredient();
            $ingredient->name = Input::get('name');
            $ingredient->description = Input::get('description');
            $ingredient->save();

            $fileController = new FileController();
            $fileController->store($request, 'ingredient',$ingredient->id);

            Session::flash('message', 'Successfully created ingredient!');
            return Redirect::to('ingredient');
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
        $ingredient = Ingredient::find($id);
        return View('ingredient.edit',compact('ingredient'));
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

        if ($validator->fails()) {
            return Redirect::to('ingredient/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $ingredient = Ingredient::find($id);
            $ingredient->name = Input::get('name');
            $ingredient->description = Input::get('description');
            $ingredient->save();

            $fileController = new FileController();
            $fileController->store($request, 'ingredient',$ingredient->id);

            Session::flash('message', 'Successfully updated ingredient!');
            return Redirect::to('ingredient');
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
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        Session::flash('message', 'Successfully deleted the ingredient!');
        return Redirect::to('ingredient');
    }
}

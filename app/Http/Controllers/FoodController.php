<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Food;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Content;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class FoodController extends Controller
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

        return View('food.index',compact('foods'));
    }

    public function get()
    {
        $foods = Food::with('category')->orderBy('foods.id')

            ->leftJoin(DB::raw('(SELECT ref_id,file_name,path FROM files where type_name=\'food\' AND is_default=\'1\' ) files'), function($join)
            {
                $join->on('foods.id', '=', 'files.ref_id');
            })->get();
        return Datatables::of($foods)

            ->addColumn('image','<a href="#" onclick="openLightbox(event)" ><img src ="/images/food/{{$file_name}}" alt="{{$description}}" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("food/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'food.destroy\', $id))) }}
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
        $categories = Category::orderBy('id')->get();
        $ingredients = Ingredient::all();
        $contents = Content::all();
        return View('food.create',compact('categories','ingredients','contents'));
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
            'category' => 'required',
            'name'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('menu/create')
                ->withErrors($validator);
        } else {
            // store
            $food = new Food();
            $food->ref_category_id = Input::get('category');
            $food->name = Input::get('name');
            $food->description = Input::get('description');
            $food->save();

            $fileController = new FileController();
            $fileController->store($request, 'food',$food->id);

            DB::table('foods-contents')->where('food_id', '=', $food->id)->delete();
            $selectedContents = Input::get('contents');
            $data = array();
            for($i = 0; $i<sizeof($selectedContents);$i++)
                $data[] = array('food_id' => $food->id, 'content_id' => $selectedContents[$i]);
            DB::table('foods-contents')->insert($data);
                $data = array();
            DB::table('foods-ingredients')->where('food_id', '=', $food->id)->delete();
            $selectedIngredients = Input::get('ingredients');
            for($i = 0; $i<sizeof($selectedIngredients);$i++)
                $data[] = array('food_id' => $food->id, 'ingredient_id' => $selectedIngredients[$i]);
            DB::table('foods-ingredients')->insert($data);

            Session::flash('message', 'Successfully created food!');
            return Redirect::to('food');
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
        $categories = Category::orderBy('id')->get();
        $food = Food::find($id);
        $ingredients = Ingredient::all();
        $contents = Content::all();

        $dataIngredients = DB::table('foods-ingredients')->where('food_id','=',$id)->get();
        $foodsIngredients = array();
        for($i=0;$i<sizeof($dataIngredients);$i++)
        {
            $foodsIngredients[] = $dataIngredients[$i]->ingredient_id;
        }

        $dataContents = DB::table('foods-contents')->where('food_id','=',$id)->get();
        $foodsContents = array();
        for($i=0;$i<sizeof($dataContents);$i++)
        {
            $foodsContents[] = $dataContents[$i]->content_id;
        }
        return View('food.edit',compact('categories','food','ingredients','contents','foodsContents','foodsIngredients'));
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
            'category' => 'required',
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('food/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $food = Food::find($id);
            $food->ref_category_id = Input::get('category');
            $food->name = Input::get('name');
            $food->description = Input::get('description');
            $food->save();

            $fileController = new FileController();
            $fileController->store($request, 'food',$food->id);

            DB::table('foods-contents')->where('food_id', '=', $food->id)->delete();
            $selectedContents = Input::get('contents');
            $data = array();
            for($i = 0; $i<sizeof($selectedContents);$i++)
                $data[] = array('food_id' => $food->id, 'content_id' => $selectedContents[$i]);
            DB::table('foods-contents')->insert($data);
            $data = array();
            DB::table('foods-ingredients')->where('food_id', '=', $food->id)->delete();
            $selectedIngredients = Input::get('ingredients');
            for($i = 0; $i<sizeof($selectedIngredients);$i++)
                $data[] = array('food_id' => $food->id, 'ingredient_id' => $selectedIngredients[$i]);
            DB::table('foods-ingredients')->insert($data);

            Session::flash('message', 'Successfully updated food!');
            return Redirect::to('food');
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

        $food = Food::find($id);
        $food->delete();
        Session::flash('message', 'Successfully deleted the food!');
        return Redirect::to('food');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class CityController extends Controller
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
        return View('city.index',compact('cities'));
    }
    public function get()
    {

        $cities = City::with('country')->orderBy('id')->get();
        return Datatables::of($cities)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("city/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'city.destroy\', $id))) }}
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
        $countries = Country::orderBy('id')->get();
       return View('city.create',compact('countries'));
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
            'country' => 'required',
            'code'      => 'required',
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('city/create')
                ->withErrors($validator);
        } else {
            // store
            $city = new City();
            $city->ref_country_id = Input::get('country');
            $city->name = Input::get('name');
            $city->code = Input::get('code');
            $city->description = Input::get('description');
            $city->save();
            Session::flash('message', 'Successfully created city!');
            return Redirect::to('city');
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
        $countries = Country::orderBy('id')->get();
        $city = City::find($id);
        return View('city.edit',compact('countries','city'));
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
            'country' => 'required',
            'code'      => 'required',
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('city/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $city = City::find($id);
            $city->ref_country_id = Input::get('country');
            $city->name = Input::get('name');
            $city->code = Input::get('code');
            $city->description = Input::get('description');
            $city->save();
            Session::flash('message', 'Successfully updated city!');
            return Redirect::to('city');
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

        $city = City::find($id);
        $city->delete();
        Session::flash('message', 'Successfully deleted the city!');
        return Redirect::to('city');


    }
}

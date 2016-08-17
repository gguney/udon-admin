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

class RegionController extends Controller
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
        return View('region.index',compact('regions'));
    }

    public function get()
    {

        $regions = Region::with('city')->orderBy('id')->get();
        return Datatables::of($regions)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("region/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'region.destroy\', $id))) }}
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
        $cities = City::orderBy('id')->get();
        return View('region.create',compact('cities'));
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
            'city'=> 'required',
            'postal_code'      => 'required',
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('region/create')
                ->withErrors($validator);
        } else {
            // store
            $region = new City();
            $region->name = Input::get('name');
            $region->postal_code = Input::get('postal_code');
            $region->ref_city_id = Input::get('city');
            $region->save();
            Session::flash('message', 'Successfully created region!');
            return Redirect::to('region');
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
        $cities = City::orderBy('id')->get();
        $region = Region::find($id);
        return View('region.edit',compact('cities','region'));
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
            $city->name = Input::get('name');
            $city->code = Input::get('code');
            $city->ref_country_id = Input::get('country');
            $city->save();
            Session::flash('message', 'Successfully updated region!');
            return Redirect::to('region');
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
        Session::flash('message', 'Successfully deleted the region!');
        return Redirect::to('region');


    }
}

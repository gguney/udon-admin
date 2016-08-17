<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class CountryController extends Controller
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

        //$countries = Country::orderBy('id')->get();
        return View('country.index', compact('countries'));
    }

    public function get()
    {

        $countries = Country::orderBy('id')->get();
        return Datatables::of($countries)
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("country/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'country.destroy\', $id))) }}
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
        return View('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'code' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('country/create')
                ->withErrors($validator);
        } else {
            // store
            $country = new Country();
            $country->name = Input::get('name');
            $country->code = Input::get('code');
            $country->description = Input::get('description');
            $country->time_zone = Input::get('time_zone');
            $country->save();
            Session::flash('message', 'Successfully created country!');
            return Redirect::to('country');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return View('country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'code' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('country/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $country = Country::find($id);
            $country->name = Input::get('name');
            $country->code = Input::get('code');
            $country->description = Input::get('description');
            $country->time_zone = Input::get('time_zone');
            $country->save();
            Session::flash('message', 'Successfully updated country!');
            return Redirect::to('country');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        Session::flash('message', 'Successfully deleted the country!');
        return Redirect::to('country');
    }
}

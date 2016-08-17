<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Management;
use App\Models\Region;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ManagementController extends Controller
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

        return View('management.index',compact('managements'));
    }
    public function get()
    {
        $managements = Management::with('owner')->orderBy('managements.id')

            ->leftJoin(DB::raw('(SELECT ref_id,file_name,path FROM files where type_name=\'management\' AND is_default=\'1\' ) files'), function($join)
            {
                $join->on('managements.id', '=', 'files.ref_id');
            })->get();
        return Datatables::of($managements)
            ->addColumn('image','<a href="#"onclick="openLightbox(event)" ><img src ="/images/management/{{$file_name}}" alt="{{$company_name}}" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("management/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'management.destroy\', $id))) }}
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
        $users = User::orderBy('username')->get();
       return View('management.create',compact('users'));
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
            'owner' => 'required',
            'brand_name' => 'required',
            'company_name' => 'required',
            'tax_number' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('management/create')
                ->withErrors($validator);
        } else {
            // store
            $management = new Management();
            $management->ref_owner_id = Input::get('owner');
            $management->brand_name = Input::get('brand_name');
            $management->company_name = Input::get('company_name');
            $management->tax_number = Input::get('tax_number');
            $management->save();

            $fileController = new FileController();
            $fileController->store($request, 'management',$management->id);

            Session::flash('message', 'Successfully created management!');
            return Redirect::to('management');
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
        $users = User::orderBy('username')->get();
        $management = Management::find($id);
        return View('management.edit',compact('users','management'));
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
            'owner' => 'required',
            'brand_name' => 'required',
            'company_name' => 'required',
            'tax_number' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('city/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $management = Management::find($id);
            $management->ref_owner_id = Input::get('owner');
            $management->brand_name = Input::get('brand_name');
            $management->company_name = Input::get('company_name');
            $management->tax_number = Input::get('tax_number');
            $management->save();

            $fileController = new FileController();
            $fileController->store($request, 'management',$management->id);

            Session::flash('message', 'Successfully updated management!');
            return Redirect::to('management');
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

        $management = Management::find($id);
        $management->delete();
        Session::flash('message', 'Successfully deleted the management!');
        return Redirect::to('management');


    }
}

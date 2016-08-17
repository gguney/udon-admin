<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Content;
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

class ContentController extends Controller
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

        return View('content.index');
    }


    public function get()
    {

        $contents = Content::orderBy('contents.id')

            ->leftJoin(DB::raw('(SELECT ref_id,file_name,path FROM files where type_name=\'content\' AND is_default=\'1\' ) files'), function($join)
            {
                $join->on('contents.id', '=', 'files.ref_id');
            })->get();


        return Datatables::of($contents)
            ->addColumn('image','<a href="#"onclick="openLightbox(event)" ><img src ="/images/content/{{$file_name}}" alt="{{$description}}" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("content/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'content.destroy\', $id))) }}
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
        return View('content.create');
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
            return Redirect::to('content/create')
                ->withErrors($validator);
        } else {
            // store
            $content = new Content();
            $content->name = Input::get('name');
            $content->description = Input::get('description');
            $content->save();

            $fileController = new FileController();
            $fileController->store($request, 'content',$content->id);

            Session::flash('message', 'Successfully created content!');
            return Redirect::to('content');
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
        $content = Content::find($id);
        return View('content.edit',compact('content'));
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
            return Redirect::to('content/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $content = Content::find($id);
            $content->name = Input::get('name');
            $content->description = Input::get('description');
            $content->save();

            $fileController = new FileController();
            $fileController->store($request, 'content',$content->id);

            Session::flash('message', 'Successfully updated content!');
            return Redirect::to('content');
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
        $content = Content::find($id);
        $content->delete();
        Session::flash('message', 'Successfully deleted the content!');
        return Redirect::to('content');
    }
}

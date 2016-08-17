<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Menu;
use App\Models\File;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class FileController extends Controller
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
    public function getFoodsFiles($id)
    {
        $files = File::where('type_name','=','food')->where('ref_id','=',$id)->orderBy('id')->get();

        return Datatables::of($files)
            ->addColumn('image','<a href="#" onclick="openLightbox(event)" ><img src ="/images/food/{{$file_name}}" alt="" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("file/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'file.destroy\', $id))) }}
                                    {{ Form::submit(\'DELETE\', array(\'class\' => \'w-button button-bad little\')) }}
                                    {{ Form::close() }}
                                    '
            )
            ->make(true);
    }
    public function getContentsFiles($id)
    {
        $files = File::where('type_name','=','content')->where('ref_id','=',$id)->orderBy('id')->get();

        return Datatables::of($files)
            ->addColumn('image','<a href="#" onclick="openLightbox(event)" ><img src ="/images/content/{{$file_name}}" alt="" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("file/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'file.destroy\', $id))) }}
                                    {{ Form::submit(\'DELETE\', array(\'class\' => \'w-button button-bad little\')) }}
                                    {{ Form::close() }}
                                    '
            )
            ->make(true);
    }
    public function getManagementsFiles($id)
    {
        $files = File::where('type_name','=','management')->where('ref_id','=',$id)->orderBy('id')->get();

        return Datatables::of($files)
            ->addColumn('image','<a href="#" onclick="openLightbox(event)" ><img src ="/images/management/{{$file_name}}" alt="" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("file/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'file.destroy\', $id))) }}
                                    {{ Form::submit(\'DELETE\', array(\'class\' => \'w-button button-bad little\')) }}
                                    {{ Form::close() }}
                                    '
            )
            ->make(true);
    }
    public function getIngredientsFiles($id)
    {
        $files = File::where('type_name','=','ingredient')->where('ref_id','=',$id)->orderBy('id')->get();

        return Datatables::of($files)
            ->addColumn('image','<a href="#" onclick="openLightbox(event)" ><img src ="/images/ingredient/{{$file_name}}" alt="" width="24px" height="24px" /></a>')
            ->addColumn('actions',
                '<a class="w-button button little" href="{{ URL::to("file/$id/edit") }}" >EDIT</a>
                                    {{ Form::open(array(\'method\' => \'DELETE\', \'route\' => array(\'file.destroy\', $id))) }}
                                    {{ Form::submit(\'DELETE\', array(\'class\' => \'w-button button-bad little\')) }}
                                    {{ Form::close() }}
                                    '
            )
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type_name, $id)
    {
        if($request->file('image') != null)
        {
            $imageName = $type_name . $id . '_' . md5(microtime()) . '.' .
                $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                base_path() . '/public/images/'.$type_name.'/', $imageName
            );
            $file = new File();
            $file->ref_id = $id;
            $file->file_name = $imageName;
            $file->path = base_path() . '/public/images/'.$type_name.'/' . $imageName;
            $file->type_name = $type_name;
            $file->is_default = true;
            $file->save();
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

        $file = File::find($id);
        $type_name = $file->type_name;
        $file->delete();
        unlink($file->path);

        Session::flash('message', 'Successfully deleted the file!');
        return Redirect::to($type_name);

    }
}

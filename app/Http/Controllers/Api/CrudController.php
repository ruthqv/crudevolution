<?php

namespace App\Http\Controllers\Api;

use App\Crud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CrudController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  DB::collection('cruds')->paginate(5);
        return $items;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'industry' => 'required',
        ]);

        // print_r($request->all());

        $create = Crud::create($request->all());  
        $items =  DB::collection('cruds')->get();
        return $items;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud $crud)
    {
        // print_r($crud['_id']); die();
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $data=$request->except(['_id']);

        $crud = Crud::where( '_id','=' ,$crud['_id'])->first();

        $datakeys = [];

        foreach($data as $key=>$value){
            $datakeys [] = $key;
        }


        foreach ($datakeys as $field) {

            $crud->{$field} = $data[$field];

 
        }

        $res=  $crud->save();
        // print_r($res);die();

        $items =  DB::collection('cruds')->get();
        return $items;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crud $crud)
    {
        Crud::find($crud['_id'])->delete();
        
        $items =  DB::collection('cruds')->get();
        return $items;

    }
}

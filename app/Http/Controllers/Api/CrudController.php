<?php

namespace App\Http\Controllers\Api;

use App\Crud;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class CrudController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::collection('cruds')->get();
        // Log::info($items);
        return $items;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $items = DB::collection('cruds')->get();
        // echo '<pre>' ;print_r($items); echo '</pre>' ;
        $newarray = [];

        foreach($items as $item) {
            $newarray[] = array(
                "name"              => $item['name'],
                "industry"          => $item['industry'],
                "inversion_recived" => $this->getArrayYears($item['years'], 'inversion_recived') ,
                "capital"           => $this->getArrayYears($item['years'], 'capital') ,
                "employees"         => $this->getArrayYears($item['years'], 'employees') ,
            );
        };

       // echo '<pre>' ; print_r(json_encode($newarray) ); echo '</pre>' ;
        // $final = '[{"name":"company1","industry":"myindustry","inversion_recived":[[2000,372.11],[2001,10000]],"capital":[[2000,12420276],[2001,1270546]],"employees":[[2000,19.8],[2001,22.98]]},{"name":"dos","industry":"myindustry2","inversion_recived":[[2000,4427.59],[2001,8000]],"capital":[[2000,8990237],[2001,899927]],"employees":[[2000,31.5],[2001,32.5]]}]';
        // Log::info($items);
         return response()->json($newarray);
    }

    public function getArrayYears($years, $type)
    {
        $array = [];

        // print_r($type);
        foreach($years as $key=>$value){
            $array[] = 
              [ $key , (int)$value[$type] ] ;
            
        }

        return $array;
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
            'name'     => 'required',
            'industry' => 'required',
        ]);

        // print_r($request->all());

        $create = Crud::create($request->all());
        // Log::info($create);
        $items = DB::collection('cruds')->get();
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
        // $this->validate($request, [
        //     'name' => 'required'
        // ]);

        $data = $request->except(['_id']);

        $crud = Crud::where('_id', '=', $crud['_id'])->first();

        $datakeys = [];

        foreach ($data as $key => $value) {
            $datakeys[] = $key;
        }

        foreach ($datakeys as $field) {

            $crud->{$field} = $data[$field];

        }

        $res = $crud->save();
        // print_r($res);die();

        $items = DB::collection('cruds')->get();
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

        $items = DB::collection('cruds')->get();
        return $items;

    }
}

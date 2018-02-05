<?php

namespace App\Http\Controllers\Api;
use DB;
use App\CrudEvolution;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrudEvolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  DB::collection('crudevolutions')->get();
        return view('main')->with('items');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $create = CrudEvolution::create($request->all());  
        $items =  DB::collection('crudevolutions')->get();
        return $items;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrudEvolution  $crudevolution
     * @return \Illuminate\Http\Response
     */
    public function show(CrudEvolution $crudevolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrudEvolution  $crudevolution
     * @return \Illuminate\Http\Response
     */
    public function edit(CrudEvolution $crudevolution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrudEvolution  $crudevolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrudEvolution $crudevolution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrudEvolution  $crudevolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrudEvolution $crudevolution)
    {
        //
    }
}

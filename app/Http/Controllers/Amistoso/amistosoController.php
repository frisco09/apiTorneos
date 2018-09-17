<?php

namespace App\Http\Controllers\Amistoso;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Amistoso;

class amistosoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partidos = Amistoso::all();
        //return $this->showAll($partidos);
        return $partidos;
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
        $rules = [
            'id_user1'=>'required',
            'id_user2'=>'required',
            'formatoJuego'=>'required',
            'id_videojuego'=>'required',
            'id_videoconsola'=>'required'
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $partido = Amistoso::create($campos);
        return $this->showOne($partido);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partido = Amistoso::findOrFail($id);
        //return $this->showOne($partido);
        return $this->$partido;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

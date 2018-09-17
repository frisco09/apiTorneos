<?php

namespace App\Http\Controllers\Videoconsola;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Videoconsola;

class videoconsolaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consolas = Videoconsola::all();
        //return $this->showAll($consolas);
        return $consolas;
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
            'name'=>'required',
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $consola = Videoconsola::create($campos);
        return $this->showOne($consola);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consola = Videoconsola::findOrFail($id);
        //return $this->showOne($consola);
		return $consola;
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

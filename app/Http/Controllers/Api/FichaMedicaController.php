<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FichaMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FIchaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichaMedica = FichaMedica::all();
        return $fichaMedica;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fichaMedica = new FichaMedica();
        $fichaMedica->nombre = $request->nombre;
        $fichaMedica->ficha = json_encode($request->ficha);
        $fichaMedica->save();
        return $fichaMedica;
    }

    public function imageStore(Request $request)
    {
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $imageName);
            return ("" . $imageName);
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

<?php

namespace App\Http\Controllers;

use App\Models\articule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class ArticuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $articule=articule::all();
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
        $articules = new Articule();
        //dd($request->code);
        $articules->code = $request->code;
        $articules->name = $request->name;
        $articules->salePrice = $request->salePrice;
        $articules->codePostal = $request->codePostal;
        $articules->stock = $request->stock;
        $articules->description = $request->description;
        $articules->img = "paola.jpg";
        $articules->save();
        //dd($request->code);
        return response()->json([
            'data' => $articules,
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '201'
            ]], 201);
    }

    public function get($id){
        $data = Articule::find($id);
        return response()->json($data, 200);
      }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\articule  $articule
     * @return \Illuminate\Http\Response
     */
    public function show(Articule $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\articule  $articule
     * @return \Illuminate\Http\Response
     */
    public function edit(Articule $articule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\articule  $articule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articule $articules,$id)
    {
        $articules=Articule::find($id);
        $articules->code=$request->get("code");
        $articules->name=$request->get("name");
        $articules->salePrice=$request->get("salePrice");
        $articules->codePostal=$request->get("codePostal");
        $articules->stock=$request->get("stock");
        $articules->description=$request->get("description");
        $articules->img = "pao.jpg";
        $articules->save();
        return $articules;
        if($articules){
            echo "editar con exito"; 
         }
         else{
           echo "nel pastel";
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\articule  $articule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articule $articules, $id)
    {
        $articules=Articule::find($id);
        $articules->delete();
        return "eliminado con exito";
    }
}

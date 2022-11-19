<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicacione;
use App\Models\Publicacione;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones=Publicacione::included()
                            ->filter()
                            ->sort()
                            ->get();
        return $publicaciones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {

        $publicacione = new Publicacione();
        // $publicacione['imagen'] = time() . '_' . $request->file(key: 'imagen')->getClientOriginalName();
        // $request->file(key: 'imagen')->storeAs(path:'multimedia_folder', name: $publicacione['imagen']);
        $publicacione->descripcion = $request->descripcion;
        $publicacione->emprendimiento_id = $request->emprendimiento_id;
        $publicacione->save();
        return $publicacione;
        
    }

    public function crear(Request $request, $id)
    {

        if($id == 0){

            $publicacione = new Publicacione();
            $publicacione['imagen'] = time() . '_' . $request->file(key: 'imagen')->getClientOriginalName();
            $request->file(key: 'imagen')->storeAs(path:'public/multimedia_folder', name: $publicacione['imagen']);
            $publicacione->descripcion = $request->descripcion;
            $publicacione->emprendimiento_id = $request->emprendimiento_id;
            $publicacione->save();
            return redirect('http://localhost/bizsett/public/publicaciones');
        }
        else{

            $user = User::included()->findOrFail($id);

            $publicacione = new Publicacione();
            $publicacione['imagen'] = time() . '_' . $request->file(key: 'imagen')->getClientOriginalName();
            $request->file(key: 'imagen')->storeAs(path:'public/multimedia_folder', name: $publicacione['imagen']);
            $publicacione->descripcion = $request->descripcion;
            $publicacione->emprendimiento_id = $user->emprendimiento->id;
            $publicacione->save();
            return redirect("http://localhost/bizsett/public/");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publicacione  $publicacione
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publicacione = Publicacione::included()->findOrFail($id);
        return $publicacione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publicacione  $publicacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacione $publicacione)
    {
        
        $publicacione['imagen'] = time() . '_' . $request->file(key: 'imagen')->getClientOriginalName();
        $request->file(key: 'imagen')->storeAs(path:'public/multimedia_folder', name: $publicacione['imagen']);
        $publicacione->descripcion = $request->descripcion;
        $publicacione->emprendimiento_id = $request->emprendimiento_id;
        $publicacione->save();
            
        return redirect('http://localhost/bizsett/public/publicaciones');
    }


    public function editar(Request $request, Publicacione $publicacione, $id)
    {
        
            $user = User::included()->findOrFail($id);
            $publicacione['imagen'] = time() . '_' . $request->file(key: 'imagen')->getClientOriginalName();
            $request->file(key: 'imagen')->storeAs(path:'public/multimedia_folder', name: $publicacione['imagen']);
            $publicacione->descripcion = $request->descripcion;
            $publicacione->emprendimiento_id = $user->emprendimiento->id;
            $publicacione->save();
            return redirect("http://localhost/bizsett/public/");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publicacione  $publicacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacione $publicacione)
    {
        
        $publicacione->delete();
        return $publicacione;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleo;
use App\Models\Emprendimiento;
use Illuminate\Http\Request;

class EmpleoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleo=Empleo::included()
                            ->filter()
                            ->sort()
                            ->get();
        return $empleo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleo = new Empleo();
        $empleo['evidencia'] = time() . '_' . $request->file(key: 'evidencia')->getClientOriginalName();
        $request->file(key: 'evidencia')->storeAs(path:'public/pdf_folder', name: $empleo['evidencia']);
        $empleo->mensaje_trabajo = $request->mensaje_trabajo;
        $empleo->emprendimiento_id = $request->emprendimiento_id;
        $empleo->user_id = $request->user_id;
        $empleo->save();

        return redirect('http://localhost/bizsett/public/empleos');
    }

    public function crear(Request $request, $user, $emprendimiento)
    {
        
        $empleo = new Empleo();
        $empleo['evidencia'] = time() . '_' . $request->file(key: 'evidencia')->getClientOriginalName();
        $request->file(key: 'evidencia')->storeAs(path:'public/pdf_folder', name: $empleo['evidencia']);
        $empleo->mensaje_trabajo = $request->mensaje_trabajo;
        $empleo->emprendimiento_id = $emprendimiento;
        $empleo->user_id = $user;
        $empleo->save();

        return redirect('http://localhost/bizsett/public/cuenta/'.$emprendimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleo  $empleo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleo = Empleo::included()->findOrFail($id);
        return $empleo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleo  $empleo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleo $empleo)
    {
        $empleo['evidencia'] = time() . '_' . $request->file(key: 'evidencia')->getClientOriginalName();
        $request->file(key: 'evidencia')->storeAs(path:'public/pdf_folder', name: $empleo['evidencia']);
        $empleo->mensaje_trabajo = $request->mensaje_trabajo;
        $empleo->emprendimiento_id = $request->emprendimiento_id;
        $empleo->user_id = $request->user_id;
        $empleo->save();

        return redirect('http://localhost/bizsett/public/empleos');
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleo  $empleo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleo $empleo)
    {
        $empleo->delete();
        return $empleo;
    }
}

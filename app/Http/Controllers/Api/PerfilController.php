<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
   
    public function foto(Request $request, User $user){

        $user->foto_perfil = $request['foto_perfil'];
        $user->save();

        return $request['foto_perfil'];

    }

    
}

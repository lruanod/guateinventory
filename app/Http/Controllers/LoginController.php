<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // formulario
    public function  form(){
        return view('logins.form');
    }
    // logout
    public function  logout( Request $request){

    $request->session()->invalidate();

    return redirect('/formlogin')->with('login', 'cerro sesión correctamente');

    }
    // login
    public function login(Request $request){

        $validator = $this->validate($request,[
            'tienda_id'=> 'required|integer',
            'usuario'=> 'required|string|max:45',
            'pass'=> 'required|string|max:45',
        ]);
        $tienda_id= $request->input('tienda_id');
        $usuario2= $request->input('usuario');
        $pass= $request->input('pass');

        if( Usuario::where('tienda_id','=',$tienda_id)->where('usuario','=',$usuario2)->where('pass','=',$pass)->count() > 0){

           $usuario= Usuario::where('tienda_id','=',$tienda_id)->where('usuario','=',$usuario2)->where('pass','=',$pass)->get();
           foreach ( $usuario as $user){
               session(['usuario'=>$user->usuario]);
               session(['tienda_id'=>$user->tienda_id]);
               session(['nombre'=>$user->nombre]);
               session(['email'=>$user->email]);
               session(['usuario_id'=>$user->id]);
               session(['cui'=>$user->cui]);
               session(['rol'=>$user->rol]);
           }


            return redirect('/formlogin')->with('login', 'usuario  encontrado');
        } else {
            return redirect('/formlogin')->with('nologin', 'usuario no encontrado');
        }
    }


}

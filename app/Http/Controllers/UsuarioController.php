<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Producto;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //// formulario
    public function  form(){
        return view('usuarios.form');
    }

    // guardar 'namec'=> 'required|string|max:45|usuario|unique:usuarios'
    public function save(Request $request){
        $validator = $this->validate($request,[
            'usuario'=> 'required|string|max:45',
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'email'=> 'required|string|max:100|',
            'rol'=> 'required|string|max:45',
            'cui'=> 'required|string|max:20',
            'tel'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $tienda_id=$request->input('tienda_id');
        $usuario= $request->input('usuario');
        $nombre= $request->input('nombre');
        $direccion= $request->input('direccion');
        $email= $request->input('email');
        $rol= $request->input('rol');
        $cui= $request->input('cui');
        $tel= $request->input('tel');
        $estado= $request->input('estado');
        $pass='guateinventory';

        if( Usuario::where('tienda_id','=',$tienda_id)->where('usuario','=',$usuario)->count() > 0){

              /// error de usuario
                return back()->with('error', $usuario.' <--el usuario ya se encuentra registrado');
            }
        if( Usuario::where('tienda_id','=',$tienda_id)->where('email','=',$email)->count() > 0){

            /// error de usuario
            return back()->with('error', $email.' <--el email ya se encuentra registrado con otro usuario');
        }

        $usuariodata = new Usuario(); /*instanciar el modelo*/
        $usuariodata->usuario = $usuario;
        $usuariodata->nombre = $nombre;
        $usuariodata->direccion = $direccion;
        $usuariodata->email = $email;
        $usuariodata->rol = $rol;
        $usuariodata->cui = $cui;
        $usuariodata->tel = $tel;
        $usuariodata->estado = $estado;
        $usuariodata->pass = $pass;
        $usuariodata->tienda_id = $tienda_id;
        $usuariodata ->save();
        return back()->with('exito', 'usuario guardada');
     //
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['usuarios'] = Usuario::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orwhere('cui','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['usuarios']= Usuario::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('usuarios.list',$data);
    }

    // form editar categoria
    public  function editform($id){
        $usuario = Usuario::findOrFail($id);
        return  view('usuarios.edit',compact('usuario'));
    }
    // editar categoria
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'usuario'=> 'required|string|max:45',
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'email'=> 'required|string|max:100|email',
            'rol'=> 'required|string|max:45',
            'cui'=> 'required|string|max:20',
            'tel'=> 'required|string|max:45',
            'pass'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $usuariodata= request()->except('_token','estado', '_method');

        Usuario::where('id','=',$id)->update($usuariodata);
        return back()->with('exito', 'usuario modificado');
    }

    // form deshabilitar
    public  function editforme($id){
        $usuario = Usuario::findOrFail($id);
        return  view('usuarios.deshabilitar',compact('usuario'));
    }
    // deshabilitar
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'usuario'=> 'required|string|max:45',
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'email'=> 'required|string|max:100|email',
            'rol'=> 'required|string|max:45',
            'cui'=> 'required|string|max:20',
            'tel'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $usuariodata= request()->except('_token', '_method','pass');

        Usuario::where('id','=',$id)->update($usuariodata);
        return back()->with('exito', 'Usuario deshabilitado');
    }


    // cambiar contrasena
    public function updatepass(Request $request){
        $validator = $this->validate($request,[
            'actual'=> 'required|string|min:5',
            'nueva'=> 'required|string|min:5',
            'tienda_id'=> 'required|integer',
            'usuario_id'=> 'required|integer'
        ]);
        $tienda_id=$request->input('tienda_id');
        $usuario_id=$request->input('usuario_id');
        $actual=$request->input('actual');
        $nueva=$request->input('nueva');

        $usuarios = Usuario::where('tienda_id', '=', $tienda_id)->where('id', '=', $usuario_id)->get();
        foreach ($usuarios as $us) {
          if($us->pass==$actual){
              /// actualizar contrasena
              $usuariodata = Usuario::findOrFail($usuario_id);
              $usuariodata->pass = ($nueva);
              $usuariodata->save();
              //fin
          } else{
              return back()->with('exito2', 'La cotraseña  acutal no coincide');
          }
        }

        return back()->with('exito', 'cotraseña actualizada');
    }

    //// formulario
    public function  formupdatepass(){
        return view('usuarios.updatepass');
    }
}

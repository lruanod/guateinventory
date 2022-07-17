<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //// formulario
    public function  form(){
        return view('clientes.form');
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'nit'=> 'required|string|max:12',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $clientedata= request()->except('_token');
        Cliente::insert($clientedata);
        return back()->with('exito', 'cliente guardado');
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['clientes'] = Cliente::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('nit','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['clientes']= Cliente::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('clientes.list',$data);
    }

    // form editar categoria
    public  function editform($id){
        $cliente = Cliente::findOrFail($id);
        return  view('clientes.edit',compact('cliente'));
    }
    // editar categoria
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'nit'=> 'required|string|max:12',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);
        $clientedata= request()->except('_token', '_method');

        Cliente::where('id','=',$id)->update($clientedata);
        return back()->with('exito', 'cliente modificado');
    }


}

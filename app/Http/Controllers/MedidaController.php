<?php

namespace App\Http\Controllers;

use App\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    //// formulario
    public function  form(){
        return view('medidas.form');
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'medida'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $medidadata= request()->except('_token');
        Medida::insert($medidadata);
        return back()->with('exito', 'medida guardada');
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['medidas'] = Medida::where('tienda_id','=',$tienda_id)->where('medida','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['medidas']= Medida::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('medidas.list',$data);
    }

    // form editar medida
    public  function editform($id){
        $medida = Medida::findOrFail($id);
        return  view('medidas.edit',compact('medida'));
    }
    // editar medida
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'medida'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);
        $medidadata= request()->except('_token','estado', '_method');

        Medida::where('id','=',$id)->update($medidadata);
        return back()->with('exito', 'medida modificada');
    }

    // form deshabilitar medida
    public  function editforme($id){
        $medida = Medida::findOrFail($id);
        return  view('medidas.deshabilitar',compact('medida'));
    }
    // deshabilitar medida
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'medida'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);
        $medidadata= request()->except('_token', '_method');

        Medida::where('id','=',$id)->update($medidadata);
        return back()->with('exito', 'medida modificada');
    }
}

<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //// formulario
    public function  form(){
        return view('categorias.form');
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'categoria'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $categoriadata= request()->except('_token');
        Categoria::insert($categoriadata);
        return back()->with('exito', 'categoría guardada');
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['categorias'] = Categoria::where('tienda_id','=',$tienda_id)->where('categoria','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['categorias']= Categoria::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('categorias.list',$data);
    }

    ///listar
    public function  listbuscar(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $categorias = Categoria::where('tienda_id','=',$tienda_id)->where('categoria','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->get();
        }
        if (empty($request->input('buscar'))){
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->get();
        }
        return response()->json($categorias,200);
    }


    // form editar categoria
    public  function editform($id){
        $categoria = Categoria::findOrFail($id);
        return  view('categorias.edit',compact('categoria'));
    }
    // editar categoria
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'categoria'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);
        $categoriadata= request()->except('_token','estado', '_method');

        Categoria::where('id','=',$id)->update($categoriadata);
        return back()->with('exito', 'categoría modificada');
    }

    // form deshabilitar categoria
    public  function editforme($id){
        $categoria = Categoria::findOrFail($id);
        return  view('categorias.deshabilitar',compact('categoria'));
    }
    // deshabilitar categoria
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'categoria'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);
        $categoriadata= request()->except('_token', '_method');

        Categoria::where('id','=',$id)->update($categoriadata);
        return back()->with('exito', 'categoría modificada');
    }
}

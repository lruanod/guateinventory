<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use App\Medida;
use App\Usuario;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //// formulario
    public function  form( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $categorias=Categoria::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $medidas=Medida::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        return view('productos.form',compact('categorias','medidas'));
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'codigo'=> 'required|string|max:75',
            'nombre'=> 'required|string|max:100',
            'precio'=> 'required',
            'precioventa'=> 'required',
            'descripcion'=> 'required|string|max:100',
            'marca'=> 'required|string|max:100',
            'stock'=> 'required|integer',
            'estado'=> 'required|string|max:45',
            'medida_id'=> 'required|integer',
            'categoria_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer',
            'descuento'=> 'required'
        ]);

        $productodata= request()->except('_token');
        Producto::insert($productodata);
        return back()->with('exito', 'producto guardada');
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['productos'] = Producto::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['productos']= Producto::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('productos.list',$data);
    }

    // form editar
    public  function editform($id, Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $categorias=Categoria::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $medidas=Medida::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $producto = Producto::findOrFail($id);
        return  view('productos.edit',compact('producto','categorias','medidas'));
    }
    // editar producto
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'codigo'=> 'required|string|max:75',
            'nombre'=> 'required|string|max:100',
            'precio'=> 'required',
            'precioventa'=> 'required',
            'descripcion'=> 'required|string|max:100',
            'marca'=> 'required|string|max:100',
            'stock'=> 'required|integer',
            'medida_id'=> 'required|integer',
            'categoria_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer',
            'decuento'=> 'required',
        ]);
        $productodata= request()->except('_token','estado', '_method');

        Producto::where('id','=',$id)->update($productodata);
        return back()->with('exito', 'prducto modificado');
    }

    // form deshabilitar
    public  function editforme($id, Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $categorias=Categoria::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $medidas=Medida::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $producto = Producto::findOrFail($id);
        return  view('productos.deshabilitar',compact('producto','categorias','medidas'));
    }
    // deshabilitar producto
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'codigo'=> 'required|string|max:75',
            'nombre'=> 'required|string|max:100',
            'precio'=> 'required',
            'precioventa'=> 'required',
            'descripcion'=> 'required|string|max:100',
            'marca'=> 'required|string|max:100',
            'stock'=> 'required|integer',
            'estado'=> 'required|string|max:45',
            'medida_id'=> 'required|integer',
            'categoria_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer',
            'descuento'=>'required'
        ]);
        $productodata= request()->except('_token', '_method');

        Producto::where('id','=',$id)->update($productodata);
        return back()->with('exito', 'producto modificado');
    }

    // form descuento
    public  function formdescuento($id, Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $categorias=Categoria::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $medidas=Medida::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->get();
        $producto = Producto::findOrFail($id);
        return  view('productos.descuento',compact('producto','categorias','medidas'));
    }
    // descuento producto
    public function editdescuento(Request $request, $id){
        $validator = $this->validate($request,[
            'codigo'=> 'required|string|max:75',
            'nombre'=> 'required|string|max:100',
            'precio'=> 'required',
            'precioventa'=> 'required',
            'descripcion'=> 'required|string|max:100',
            'marca'=> 'required|string|max:100',
            'stock'=> 'required|integer',
            'estado'=> 'required|string|max:45',
            'medida_id'=> 'required|integer',
            'categoria_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer',
            'descuento'=>'required'
        ]);
        $productodata= request()->except('_token', '_method');

        Producto::where('id','=',$id)->update($productodata);
        return back()->with('exito', 'descuento aplicado');
    }

}

<?php

namespace App\Http\Controllers;



use App\Detalle;
use App\Detalleproveedore;
use App\Entrada;
use App\Factura;
use App\Medida;
use App\Producto;
use App\Proveedore;
use App\Usuario;
use PDF;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    //// formulario
    public function  form( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $modal='';
        $modal2='';
        // producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $productos = Producto::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
            $modal='true';
        }
        if (empty($request->input('buscar'))){
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->paginate(6);
            $modal='true';
        }
        if (!empty($request->input('buscarproducto'))){
            $buscarproducto= $request->input('buscarproducto');
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$buscarproducto)->paginate(6);
            foreach ($productos as $pro) {
                session(['producto_id' => $pro->id]);
                session(['precio' => $pro->precio]);
                session(['stock' => $pro->stock]);
                session(['nombre' => $pro->nombre]);
                session(['medida' => $pro->medida->medida]);
                session(['codigo' => $pro->codigo]);
                session(['precioventa' => $pro->precioventa]);
            }

            $modal='';
        }
       // proveedor
        if (!empty($request->input('buscarp'))){
            $buscarp= $request->input('buscarp');
            $proveedores = Proveedore::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('nombre','LIKE','%' . $buscarp . '%')->orderBy("created_at", "desc")->paginate(6);
            $modal2='true';
        }
        if (empty($request->input('buscarp'))){
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->paginate(6);
            $modal2='true';
        }
        if (!empty($request->input('buscarproveedor'))){
            $buscarproveedor= $request->input('buscarproveedor');
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('id','=',$buscarproveedor)->paginate(6);

            foreach ($proveedores as $prov) {
                session(['proveedor_id' => $prov->id]);
                session(['nombrep' => $prov->nombre]);
            }

            $modal2='';
        }
        $detalleproveedores=Detalleproveedore::where('tienda_id','=',$tienda_id)->get();
        return view('entradas.form',compact('productos','proveedores','modal2','modal','detalleproveedores'));
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'fechaentrada'=> 'required|date',
            'precio'=> 'required',
            'precioventa'=> 'required',
            'stock'=> 'required|integer',
            'precioentrada'=> 'required',
            'precioentradaven'=> 'required',
            'stockentrada'=> 'required|integer',
            'descripcion'=> 'required|string|max:100',
            'producto_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'proveedore_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $entradadata= request()->except('_token','codigo','nombre','medida','proveedor');
        Entrada::insert($entradadata);

        $producto_id=$request->input('producto_id');
        $tienda_id=$request->input('tienda_id');
        $stockentrada=$request->input('stockentrada');
        $precioentrada=$request->input('precioentrada');
        $precioentradaven=$request->input('precioentradaven');


        $producto= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$producto_id)->get();
        foreach ( $producto as $pro){
            //// podriamos hacer un promedio del precio
            $stocktotal=$pro->stock+$stockentrada;
            $precio=$precioentrada;
            $precioventa=$precioentradaven;
        }

        $producto= Producto::findOrFail($producto_id);
        $producto->stock=$stocktotal;
        $producto->precio=$precio;
        $producto->precioventa=$precioventa;
        $producto->save();

        session(['producto_id' => null]);
        session(['precio' => null]);
        session(['stock' => null]);
        session(['nombre' => null]);
        session(['medida' => null]);
        session(['codigo' => null]);
        session(['precioventa' => null]);
        session(['proveedor_id' => null]);
        session(['nombrep' => null]);
        return redirect('/form_entrada')->with('exito', 'entrada registrada');
    }

    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('inicio'))||!empty($request->input('fin'))){
            $inicio= $request->input('inicio');
            $final= $request->input('final');
            $data['entradas'] = Entrada::where('tienda_id','=',$tienda_id)->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->paginate(10);
        } else{
            $data['entradas']= Entrada::where('tienda_id','=',$tienda_id)->paginate(10);
        }

        return view('entradas.list',$data);
    }

    // form editar
    public  function editform($id, Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $modal='';
        $modal2='';
        $entrada = Entrada::findOrFail($id);
        // proveedor
        if (!empty($request->input('buscarp'))){
            $buscarp= $request->input('buscarp');
            $proveedores = Proveedore::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('nombre','LIKE','%' . $buscarp . '%')->orderBy("created_at", "desc")->paginate(6);
            $modal2='true';
        }
        if (empty($request->input('buscarp'))){
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->paginate(6);
            $modal2='true';
        }
        if (!empty($request->input('buscarproveedor'))){
            $buscarproveedor= $request->input('buscarproveedor');
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('id','=',$buscarproveedor)->paginate(6);

            foreach ($proveedores as $prov) {
                session(['proveedor_id' => $prov->id]);
                session(['nombrep' => $prov->nombre]);
            }

            $modal2='';
        }
        $detalleproveedores=Detalleproveedore::where('tienda_id','=',$tienda_id)->get();
        return  view('entradas.edit',compact('entrada','proveedores','detalleproveedores'));
    }
    // editar producto
    public function edit(Request $request, $id)
    {
        $validator = $this->validate($request, [
            'fechaentrada' => 'required|date',
            'precio' => 'required',
            'precioventa' => 'required',
            'stock' => 'required|integer',
            'precioentrada' => 'required',
            'precioentradaven' => 'required',
            'stockentrada' => 'required|integer',
            'descripcion' => 'required|string|max:100',
            'producto_id' => 'required|integer',
            'usuario_id' => 'required|integer',
            'proveedore_id' => 'required|integer',
            'tienda_id' => 'required|integer'
        ]);
       //stock aneterior de entrada
        $tienda_id = $request->input('tienda_id');
        $entrada = Entrada::where('tienda_id', '=', $tienda_id)->where('id', '=', $id)->get();
        foreach ($entrada as $en) {
            $stockanterior = $en->stockentrada;
        }
        // final
        /// actualizar
        $entradadata = request()->except('_token', 'codigo', 'nombre', 'medida', '_method','proveedor');
        Entrada::where('id', '=', $id)->update($entradadata);
        //fin

        $producto_id = $request->input('producto_id');
        $stockentrada = $request->input('stockentrada');
        $precioentrada = $request->input('precioentrada');
        $precioentradaven = $request->input('precioentradaven');
        /// actualizar stock, precio y precioventa en la tabla producto
        $producto = Producto::where('tienda_id', '=', $tienda_id)->where('id', '=', $producto_id)->get();
        foreach ($producto as $pro) {
            //// podriamos hacer un promedio del precio
            $stocktotal = ($pro->stock + $stockentrada) - $stockanterior;
            $precio = $precioentrada;
            $precioventa = $precioentradaven;
        }
        $producto = Producto::findOrFail($producto_id);
        $producto->stock = $stocktotal;
        $producto->precio = $precio;
        $producto->precioventa = $precioventa;
        $producto->save();
        session(['proveedor_id' => null]);
        session(['nombrep' => null]);

        return back()->with('exito', 'entrada modificada');

    }

    //vista  entrada
    public function  vistapdf(Request $request,$id){
        $tienda_id=$request->session()->get('tienda_id');
        $entradas  = Entrada::where('id', '=', $id)->where('tienda_id', '=', $tienda_id)->get();
        return view('entradas.pdf',compact('entradas'));
    }

    //PDF vista entrada
    public function  imprimirpdf(Request $request,$id){
        $tienda_id=$request->session()->get('tienda_id');
        $entradas  = Entrada::where('id', '=', $id)->where('tienda_id', '=', $tienda_id)->get();
        $pdf=PDF::loadView('entradas.pdf',compact('entradas'));
        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        return $pdf->stream('entrada.pdf');
    }

    ///imprimir rago vista
    public function  vistafecha(Request $request){
        $validator = $this->validate($request, [
            'iniciopdf' => 'required|date',
            'finalpdf' => 'required|date'

        ]);

        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('iniciopdf'))||!empty($request->input('finpdf'))){
            $inicio= $request->input('iniciopdf');
            $final= $request->input('finalpdf');
            $totalprecioentrada=0;
            $totalprecioentradaven=0;

            $entradas= Entrada::where('tienda_id','=',$tienda_id)->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->get();
            foreach ($entradas as $entra) {
                $totalprecioentrada=number_format($entra->precioentrada+$totalprecioentrada,2);

                $totalprecioentradaven=number_format($entra->precioentradaven+$totalprecioentradaven,2);


            }

        }
       //return view('entradas.pdffecha',compact('entradas','totalprecioentrada','totalprecioentradaven'));

        $pdf=PDF::loadView('entradas.pdffecha',compact('entradas','totalprecioentrada','totalprecioentradaven','inicio','final'));
        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        return $pdf->stream('entrada.pdffecha');

    }
}

<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Cliente;
use App\Detalle;
use App\Detalleproveedore;
use App\Entrada;
use App\Producto;
use App\Proveedore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
Use PDF;

class ProveedoreController extends Controller
{
    //// formulario
    public function  form( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $modal='';
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
                session(['nombrep' => $pro->nombre]);
                session(['medida' => $pro->medida->medida]);
                session(['codigo' => $pro->codigo]);
                session(['precioventa' => $pro->precioventa]);
            }

            $modal='';
        }
        return view('proveedores.form',compact('productos','modal'));
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:75',
            'direccion'=> 'required|string|max:75',
            'estado'=> 'required|string|max:45',
            'tel'=> 'required|string|max:45',
            'producto_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $proveedoredata= request()->except('_token','codigo','nombrep','medida','precio','producto_id');
        Proveedore::insert($proveedoredata);

        $producto_id=$request->input('producto_id');
        $tienda_id=$request->input('tienda_id');
        $nombre=$request->input('nombre');
        $direccion=$request->input('direccion');
        $proveedore_id='';

        $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('nombre','=',$nombre)->where('direccion','=',$direccion)->get();
        foreach ( $proveedores as $pro){
            //// podriamos hacer un promedio del precio
            $proveedore_id=$pro->id;
        }

        $detalledata = new Detalleproveedore();
        $detalledata->producto_id = $producto_id;
        $detalledata->proveedore_id = $proveedore_id;
        $detalledata->tienda_id = $tienda_id;
        $detalledata->save();

        session(['producto_id' => null]);
        session(['precio' => null]);
        session(['medida' => null]);
        session(['codigo' => null]);
        session(['nombrep' => null]);
        return redirect('/form_proveedore')->with('exito', 'Proveedor registrado');
    }

    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $proveedores = Proveedore::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->paginate(10);
        }

        $detalleproveedores=Detalleproveedore::where('tienda_id','=',$tienda_id)->get();

        return view('proveedores.list',compact('proveedores','detalleproveedores'));
    }

    // form editar proveedore
    public  function editform($id){
        $proveedore = Proveedore::findOrFail($id);
        return  view('proveedores.edit',compact('proveedore'));
    }
    // editar proveedores
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:75',
            'direccion'=> 'required|string|max:75',
            'tel'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $proveedordata= request()->except('_token','estado', '_method');

        Proveedore::where('id','=',$id)->update($proveedordata);
        return back()->with('exito', 'proveedor modificado');
    }

    //// formulario
    public function  formasig( Request $request, $id){
        $tienda_id=$request->session()->get('tienda_id');
        $modal='';
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
                session(['nombrep' => $pro->nombre]);
                session(['medida' => $pro->medida->medida]);
                session(['codigo' => $pro->codigo]);
                session(['precioventa' => $pro->precioventa]);
            }

            $modal='';
        }
        $proveedore = Proveedore::findOrFail($id);
        return view('proveedores.formasig',compact('productos','modal','proveedore'));
    }

    // guardar
    public function saveasig(Request $request){
        $validator = $this->validate($request,[
            'producto_id'=> 'required|integer',
            'proveedore_id' => 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $producto_id=$request->input('producto_id');
        $proveedore_id=$request->input('proveedore_id');
        $tienda_id=$request->input('tienda_id');

        $detalledata = new Detalleproveedore();
        $detalledata->producto_id = $producto_id;
        $detalledata->proveedore_id = $proveedore_id;
        $detalledata->tienda_id = $tienda_id;
        $detalledata->save();

        session(['producto_id' => null]);
        session(['precio' => null]);
        session(['medida' => null]);
        session(['codigo' => null]);
        session(['nombrep' => null]);
        return redirect('/form_productoasig/'.$proveedore_id)->with('exito', 'Producto asignado');
    }

    // eliminar
    public  function delete($id){

        /// eliminar
        Detalleproveedore::destroy($id);


        return redirect('/list_proveedore')->with('eliminado','el producto fue desasignado');
    }

    // form deshabilitar
    public  function editforme($id){
        $proveedore = Proveedore::findOrFail($id);
        return  view('proveedores.deshabilitar',compact('proveedore'));
    }
    // deshabilitar
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:75',
            'direccion'=> 'required|string|max:75',
            'tel'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $provedoredata= request()->except('_token', '_method','nombre','direccion','tel');

        Proveedore::where('id','=',$id)->update($provedoredata);
        return back()->with('exito', 'proveedor modificado');
    }

    ///Reporte de proveedores en pdf
    public function  reporteproveedorpdf(Request $request){

        $tienda_id=$request->session()->get('tienda_id');

            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->orderBy("created_at", "desc")->get();
            $detalleproveedores=Detalleproveedore::where('tienda_id','=',$tienda_id)->get();



        $pdf=PDF::loadView('proveedores.pdfproveedor',compact('proveedores','detalleproveedores'));
        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        return $pdf->stream('Reporte_Proveedores.pdf');

    }
}

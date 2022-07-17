<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Detalle;
use App\Entrada;
use App\Factura;
use App\Fpago;
use App\Producto;
use App\Venta;
use App\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;
use App\Http\Controllers\Datetime;
use Symfony\Component\Console\Input\Input;
use PDF;

class FacturaController extends Controller
{
    //// formulario
    public function  form( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $total=0;
        $modal='';
        $modal2='';
        $con=0;
    /// producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $productos = Producto::where('tienda_id','=',$tienda_id)->where('stock','>',0)->where('estado','=','Habilitado')->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
            $modal='true';
        }

        if (empty($request->input('buscar'))){
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('stock','>',0)->paginate(6);
            $modal='';
        }

     /// cliente
        if (!empty($request->input('buscarc'))){
            $buscar= $request->input('buscarc');
            $clientes = Cliente::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('nit','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(2);
            $modal2='true';
        }
        if (empty($request->input('buscarc'))){
            $clientes= Cliente::where('tienda_id','=',$tienda_id)->paginate(2);
            $modal2='true';
        }

        if (!empty($request->input('buscarcliente'))){
            $buscarcliente= $request->input('buscarcliente');
            $clientes= Cliente::where('tienda_id','=',$tienda_id)->where('id','=',$buscarcliente)->paginate(10);
            $modal2='';
            foreach ($clientes as $cli){
                session(['cliente_id' => $cli->id]);
                session(['nombre' => $cli->nombre]);
                session(['direccion' => $cli->direccion]);
                session(['nit' => $cli->nit]);
            }

        }

      ///  registro de primer producto ingresado al detalle
        if ($request->session()->get('venta_id')==null) {
            $con = 1;
            if (!empty($request->input('producto_id')) || !empty($request->input('codigo'))){
                // registro tabla venta
                $ventadata = new Venta();
                $ventadata->fechaventa = now();
                $ventadata->impuesto = 0;
                $ventadata->descuento = 0;
                $ventadata->total = 0;
                $ventadata->efectivo = 0;
                $ventadata->cambio = 0;
                $ventadata->usuario_id = $usuario_id;
                $ventadata->tienda_id = $tienda_id;
                $ventadata->save();
                // fin

                // sesionar varible venta_id
                $venta = Venta::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->latest()->take(1)->get();
                foreach ($venta as $ven) {
                    session(['venta_id' => $ven->id]);
                }
                //

                $producto = Producto::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->where('id', '=', $request->input('producto_id'))->orwhere('codigo', '=', $request->input('codigo'))->get();
                foreach ($producto as $pro) {
                    $pro_id = $pro->id;
                    $nombreproducto2 = $pro->nombre;
                    $precio = $pro->precio;
                    $descuento = $pro->descuento;
                    $precioventa = $pro->precioventa;
                    $stockactual=$pro->stock;
                }

                if($stockactual>0) {
                    // insertar en detalle inicial
                    $detalledata = new Detalle();
                    $detalledata->cantidad = 1;
                    $detalledata->preciodetalle = $precio;
                    $detalledata->preciodetalleven = $precioventa;
                    $detalledata->descuentodetalle = $descuento;
                    $detalledata->subtotal = $precioventa-$descuento;
                    $detalledata->producto_id = $pro_id;
                    $detalledata->venta_id = $request->session()->get('venta_id');
                    $detalledata->tienda_id = $tienda_id;
                    $detalledata->fechadetalle = now();
                    $detalledata->save();
                    //

                    /// actualizar stock producto
                    $productodata = Producto::findOrFail($pro_id);
                    $productodata->stock = ($stockactual-1);
                    $productodata->save();
                    //fin
                 //   $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
                }
                if($stockactual<1){
                    return redirect('/form_factura')->with('eliminado','el producto'.$nombreproducto2.'no tiene suficiente stock');
                }

            }
        }
        /// fin de primer producto ingresado al detalle

        // registrar mas productos al detalle
        if($con==0) {
            if (!empty($request->session()->get('venta_id'))) {
                if (!empty($request->input('producto_id')) ||!empty($request->input('codigo'))) {
                    $producto =Producto::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->where('id', '=', $request->input('producto_id'))->orwhere('codigo', '=', $request->input('codigo'))->get();
                    foreach ($producto as $pro) {
                        $pro_id = $pro->id;
                        $nombreproducto = $pro->nombre;
                        $precio = $pro->precio;
                        $descuento = $pro->descuento;
                        $precioventa = $pro->precioventa;
                        $stockactual2=$pro->stock;
                    }
                    if($stockactual2>0) {
                        // insertar producto al detalle
                        $detalledata = new Detalle();
                        $detalledata->cantidad = 1;
                        $detalledata->preciodetalle = $precio;
                        $detalledata->preciodetalleven = $precioventa;
                        $detalledata->descuentodetalle = $descuento;
                        $detalledata->subtotal = $precioventa-$descuento;
                        $detalledata->producto_id = $pro_id;
                        $detalledata->venta_id = $request->session()->get('venta_id');
                        $detalledata->tienda_id = $tienda_id;
                        $detalledata->fechadetalle = now();
                        $detalledata->save();
                        //
                        /// actualizar stock producto
                        $productodata = Producto::findOrFail($pro_id);
                        $productodata->stock = ($stockactual2 - 1);
                        $productodata->save();
                        //
                     //   $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
                    }
                    if($stockactual2<1){
                        return redirect('/form_factura')->with('eliminado','el producto'.$nombreproducto.'no tiene suficiente stock');
                    }
                }
            }
        } // fin registrar mas productos al detalle

        $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
        $total=0;
        $descuentod=0;
        $descuentod2=0;
        $total0=0;
        foreach ($detalles as $dtl) {
            $total0 = $dtl->subtotal;
            $total=$total0+$total;
            $descuentod2=$dtl->descuentodetalle;
            $descuentod=$descuentod2+$descuentod;

        }
        $fpagos= Fpago::where('tienda_id','=',$tienda_id)->where('estado','=','habilitado')->orderBy("created_at", "desc")->get();
        return view('facturas.form',compact('productos','clientes','fpagos','modal','modal2','detalles','total','descuentod'));
    }

    //// formulario
    public function  detallesjquery( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $total=0;
        $modal='';
        $modal2='';
        $con=0;


        ///  registro de primer producto ingresado al detalle
        if ($request->session()->get('venta_id')==null) {
            $con = 1;
            if (!empty($request->input('codigo'))){
                // registro tabla venta
                $ventadata = new Venta();
                $ventadata->fechaventa = now();
                $ventadata->impuesto = 0;
                $ventadata->descuento = 0;
                $ventadata->total = 0;
                $ventadata->efectivo = 0;
                $ventadata->cambio = 0;
                $ventadata->usuario_id = $usuario_id;
                $ventadata->tienda_id = $tienda_id;
                $ventadata->save();
                // fin

                // sesionar varible venta_id
                $venta = Venta::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->latest()->take(1)->get();
                foreach ($venta as $ven) {
                    session(['venta_id' => $ven->id]);
                }
                //

                $producto = Producto::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->where('codigo', '=', $request->input('codigo'))->get();
                foreach ($producto as $pro) {
                    $pro_id = $pro->id;
                    $nombreproducto2 = $pro->nombre;
                    $precio = $pro->precio;
                    $descuento = $pro->descuento;
                    $precioventa = $pro->precioventa;
                    $stockactual=$pro->stock;
                }

                if($stockactual>0) {
                    // insertar en detalle inicial
                    $detalledata = new Detalle();
                    $detalledata->cantidad = 1;
                    $detalledata->preciodetalle = $precio;
                    $detalledata->preciodetalleven = $precioventa;
                    $detalledata->descuentodetalle = $descuento;
                    $detalledata->subtotal = $precioventa-$descuento;
                    $detalledata->producto_id = $pro_id;
                    $detalledata->venta_id = $request->session()->get('venta_id');
                    $detalledata->tienda_id = $tienda_id;
                    $detalledata->fechadetalle = now();
                    $detalledata->save();
                    //

                    /// actualizar stock producto
                    $productodata = Producto::findOrFail($pro_id);
                    $productodata->stock = ($stockactual-1);
                    $productodata->save();
                    //fin
                    //   $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
                }
                if($stockactual<1){
                    return redirect('/form_factura')->with('eliminado','el producto'.$nombreproducto2.'no tiene suficiente stock');
                }

            }
        }
        /// fin de primer producto ingresado al detalle

        // registrar mas productos al detalle
        if($con==0) {
            if (!empty($request->session()->get('venta_id'))) {
                if (!empty($request->input('producto_id')) ||!empty($request->input('codigo'))) {
                    $producto =Producto::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->where('codigo', '=', $request->input('codigo'))->get();
                    foreach ($producto as $pro) {
                        $pro_id = $pro->id;
                        $nombreproducto = $pro->nombre;
                        $precio = $pro->precio;
                        $descuento = $pro->descuento;
                        $precioventa = $pro->precioventa;
                        $stockactual2=$pro->stock;
                    }
                    if($stockactual2>0) {
                        // insertar producto al detalle
                        $detalledata = new Detalle();
                        $detalledata->cantidad = 1;
                        $detalledata->preciodetalle = $precio;
                        $detalledata->preciodetalleven = $precioventa;
                        $detalledata->descuentodetalle = $descuento;
                        $detalledata->subtotal = $precioventa-$descuento;
                        $detalledata->producto_id = $pro_id;
                        $detalledata->venta_id = $request->session()->get('venta_id');
                        $detalledata->tienda_id = $tienda_id;
                        $detalledata->fechadetalle = now();
                        $detalledata->save();
                        //
                        /// actualizar stock producto
                        $productodata = Producto::findOrFail($pro_id);
                        $productodata->stock = ($stockactual2 - 1);
                        $productodata->save();
                        //
                        //   $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
                    }
                    if($stockactual2<1){
                        return redirect('/form_factura')->with('eliminado','el producto'.$nombreproducto.'no tiene suficiente stock');
                    }
                }
            }
        } // fin registrar mas productos al detalle

     //   $detalles = Detalle::where('tienda_id', '=', $tienda_id)->where('venta_id', '=', $request->session()->get('venta_id'))->get();
         $detalles= Detalle::query()->join('productos','detalles.producto_id','productos.id')->join('medidas','productos.medida_id','medidas.id')->where('detalles.tienda_id', '=', $tienda_id)->where('detalles.venta_id', '=', $request->session()->get('venta_id'))->select('detalles.id','productos.codigo','productos.nombre','medidas.medida','detalles.cantidad','detalles.preciodetalleven','detalles.descuentodetalle','detalles.subtotal')->get();

        $total=0;
        $total0=0;
        foreach ($detalles as $dtl) {
            $total0 = $dtl->subtotal;
            $total=$total0+$total;
        }
       // return view('facturas.form',compact('productos','clientes','fpagos','modal','modal2','detalles','total'));
        return response()->json($detalles,200);
    }



    //// formulario
    public function  clientesjquery( Request $request){
        $tienda_id=$request->session()->get('tienda_id');

        /// cliente
        if (!empty($request->input('buscarc'))){
            $buscar= $request->input('buscarc');
            $clientes = Cliente::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('nit','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->get();
        }

        return response()->json($clientes,200);
    }

    //// formulario
    public function  productosjquery( Request $request){
        $tienda_id=$request->session()->get('tienda_id');

        /// producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
           // $productos = Producto::where('tienda_id','=',$tienda_id)->where('stock','>',0)->where('estado','=','Habilitado')->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->get();
            $productos=Producto::query()->join('medidas','productos.medida_id','medidas.id')->where('productos.tienda_id','=',$tienda_id)->where('productos.estado','=','Habilitado')->where('productos.stock','>',0)->where('productos.nombre','LIKE','%' . $buscar . '%')->orwhere('productos.codigo','LIKE','%' . $buscar . '%')->select("productos.id","productos.codigo","productos.nombre","productos.nombre","medidas.medida","productos.precioventa")->get();

        }

        if (empty($request->input('buscar'))){
          //  $productos= Producto::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('stock','>',0)->get();
            $productos=Producto::query()->join('medidas','productos.medida_id','medidas.id')->where('productos.tienda_id','=',$tienda_id)->where('productos.estado','=','Habilitado')->where('productos.stock','>',0)->select("productos.id","productos.codigo","productos.nombre","productos.nombre","medidas.medida","productos.precioventa")->get();
            // Producto::where('tienda_id','=',$tienda_id)->where('estado','=','Habilitado')->where('stock','>',0)->get();
        }

        return response()->json($productos,200);
    }

    //// formulario agregar cliente  al detalle
    public function  clientesdjquery( Request $request){
        $tienda_id=$request->session()->get('tienda_id');

        if (!empty($request->input('buscarcliente'))) {
            $buscarcliente = $request->input('buscarcliente');
            $clientes = Cliente::where('tienda_id', '=', $tienda_id)->where('id', '=', $buscarcliente)->get();
            $modal2 = '';
            foreach ($clientes as $cli) {
                session(['cliente_id' => $cli->id]);
                session(['nombre' => $cli->nombre]);
                session(['direccion' => $cli->direccion]);
                session(['nit' => $cli->nit]);
            }
        }
        return response()->json($clientes,200);
    }

    // guardar
    public function savecliente(Request $request){
        $validator = $this->validate($request,[
            'nombre'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'nit'=> 'required|string|max:12',
            'usuario_id'=> 'required|integer',
            'tienda_id'=> 'required|integer'
        ]);

        $clientedata= request()->except('_token');
        Cliente::insert($clientedata);
        return redirect('/form_factura')->with('exito', 'cliente guardado');
    }

    // guardar factura
    public function savefactura(Request $request){
        $validator = $this->validate($request,[
            'fpago_id'=>  'required|integer',
            'cliente_id'=>  'required|integer',
            'venta_id'=>  'required|integer',
            'tienda_id'=> 'required|integer',
            'usuario_id'=> 'required|integer',
            'impuesto'=> 'required',
            'descuento'=> 'required',
            'cambio'=> 'required|numeric|min:0',
            'efectivo'=> 'required',
            'total'=> 'required|numeric|min:0'
        ]);
        $tienda_id = $request->input('tienda_id');
        $venta_id = $request->input('venta_id');
        $usuario_id = $request->input('usuario_id');
        $facturadata = new Factura(); /*instanciar el modelo*/
        $facturadata->fechafactura = now();
        $facturadata->firma = time(); //firma electronica
        $facturadata->fpago_id = $request->input('fpago_id');
        $facturadata->cliente_id = $request->input('cliente_id');
        $facturadata->venta_id = $request->input('venta_id');
        $facturadata->usuario_id = $request->input('usuario_id');
        $facturadata->tienda_id = $request->input('tienda_id');
        $facturadata->numero =time(); //numero de factura
        $facturadata->fautorizacion =now(); //fecha de autorizacion
        $facturadata->save();

        /// actualizar
        $ventadata = Venta::findOrFail($request->input('venta_id'));
        $ventadata->impuesto = $request->input('impuesto');
        $ventadata->descuento = $request->input('descuento');
        $ventadata->total = $request->input('total');
        $ventadata->cambio = $request->input('cambio');
        $ventadata->efectivo = $request->input('efectivo');
        $ventadata->save();
        //fin

        session(['venta_id'=>'']);
        session(['cliente_id'=>'']);
        session(['nombre'=>'']);
        session(['direccion'=>'']);
        session(['nit'=>'']);


       return redirect('/form_factura')->with('exito', 'registro de factura');
    }

    public function  imprimirfactura(Request $request){
        /// imprimir factura
        // buscar ultima factura
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $facturas = Factura::where('tienda_id', '=', $tienda_id)->where('usuario_id', '=', $usuario_id)->where('fechafactura', '=',now()->format('y.m.d'))->latest()->take(1)->get();
        foreach ($facturas as $facu) {
            $venta_id=$facu->venta_id;
        }
        $detalles = Detalle::where('venta_id', '=', $venta_id)->where('tienda_id', '=', $tienda_id)->get();

        $pdf=PDF::loadView('facturas.facturapdf',compact('facturas','detalles'));
        set_time_limit(600);
        //  return $pdf->download('factura.pdf');
         return  $pdf->stream('factura.pdf');
    }
    // eliminar
    public  function delete($id){

        /// actualizar stock producto
       // $detalledata = Detalle::findOrFail($id);
        $detalles2 = Detalle::where('id', '=', $id)->get();
        foreach ( $detalles2 as $dtle) {
            $producid =$dtle->producto_id;
            $stockac = $dtle->producto->stock;
            $cantidade=$dtle->cantidad;
        }

        /// actualizar stock producto
        $productodata = Producto::findOrFail($producid);
        $productodata->stock = ($stockac+$cantidade);
        $productodata->save();
        //fin

        /// eliminar
        Detalle::destroy($id);

        return redirect('/form_factura')->with('eliminado','Eliminado');
    }

    // eliminar
    public  function cancelar(Request $request){

        /// actualizar stock producto
        // $detalledata = Detalle::findOrFail($id);
        if(!empty($request->session()->get('venta_id'))){
            $detalles2 = Detalle::where('venta_id', '=', $request->session()->get('venta_id'))->get();
            foreach ( $detalles2 as $dtle) {
                $producid =$dtle->producto_id;
                $detalleid=$dtle->id;
                $stockac = $dtle->producto->stock;
                $cantidade=$dtle->cantidad;
                /// actualizar stock producto
                $productodata = Producto::findOrFail($producid);
                $productodata->stock = ($stockac+$cantidade);
                $productodata->save();
                //fin
                /// eliminar
                Detalle::destroy($detalleid);

            }
            /// eliminar
            Venta::destroy($request->session()->get('venta_id'));
            session(['venta_id'=>'']);
            session(['cliente_id'=>'']);
            session(['nombre'=>'']);
            session(['direccion'=>'']);
            session(['nit'=>'']);
            return redirect('/form_factura')->with('eliminado','FACTURA CANCELADA');
        }
        if($request->session()->get('venta_id')==null){
            session(['venta_id'=>'']);
            session(['cliente_id'=>'']);
            session(['nombre'=>'']);
            session(['direccion'=>'']);
            session(['nit'=>'']);
            return redirect('/form_factura')->with('eliminado','FACTURA NO TIENEN ASIGNADO NINGUN PRODUCTO');
        }






    }

    // editar producto
    public function edit(Request $request, $id)
    {
        $validator = $this->validate($request, [
            'cantidad' => 'required|integer|min:0'
        ]);
        $cantidad=$request->input('cantidad');

        $detalle = Detalle::where('id', '=', $id)->get();
        foreach ($detalle as $deta) {
            $descuento=$deta->producto->descuento*$cantidad;
            $subtotal=($cantidad*$deta->preciodetalleven)-$descuento;
            $cantidadactual=$deta->cantidad;
            $producto_id=$deta->producto_id;
            $nombreproducto=$deta->producto->nombre;
            $stockactual3=$deta->producto->stock;
        }
        if($stockactual3>=$cantidad){
            $productodata2 = Producto::findOrFail($producto_id);
            $productodata2->stock = (($stockactual3+$cantidadactual)-$cantidad);
            $productodata2->save();
            //fin
            /// actualizar
            $inventa = Detalle::findOrFail($id);
            $inventa->cantidad = $cantidad;
            $inventa->descuentodetalle=$descuento;
            $inventa->subtotal = $subtotal;
            $inventa->save();
            //fin
            return redirect('/form_factura')->with('exito', 'cantidad modificada');
        }
        if($stockactual3<$cantidad){
            return redirect('/form_factura')->with('eliminado','el producto'.$nombreproducto.'no tiene suficiente stock');
        }
    }


    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
            $finicio= $request->input('finicio');
            $ffinal= $request->input('ffinal');
          //  $data['facturas'] = Factura::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
            $data['facturas'] = Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($finicio,$ffinal))->orderBy("created_at", "desc")->paginate(10);

        }
        if (empty($request->input('finicio'))||empty($request->input('ffinal'))){
            $data['facturas']= Factura::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('facturas.list',$data);
    }

    //vista  imprimir factura
    public function  vistafactura(Request $request,$id){
        $tienda_id=$request->session()->get('tienda_id');
        $facturas  = Factura::where('id', '=', $id)->where('tienda_id', '=', $tienda_id)->get();
        foreach ($facturas as $fac) {
            $venta_id=$fac->venta_id;
        }

        $detalles = Detalle::where('venta_id', '=', $venta_id)->where('tienda_id', '=', $tienda_id)->get();

        return view('facturas.facturapdf',compact('facturas','detalles'));
    }

    //PDF imprimir factura
    public function  facturapdf(Request $request,$id){
        $tienda_id=$request->session()->get('tienda_id');
        $facturas  = Factura::where('id', '=', $id)->where('tienda_id', '=', $tienda_id)->get();
        foreach ($facturas as $fac) {
            $venta_id=$fac->venta_id;
        }

        $detalles = Detalle::where('venta_id', '=', $venta_id)->where('tienda_id', '=', $tienda_id)->get();

        $pdf=PDF::loadView('facturas.facturapdf',compact('facturas','detalles'));
        set_time_limit(600);
        return $pdf->stream('factura.pdf');
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
            $impuesto=0;
            $descuento=0;
            $total=0;

            $facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
            foreach ($facturas as $fac) {
                $total = number_format($fac->venta->total + $total, 2);
                $descuento = number_format($fac->venta->descuento + $descuento, 2);
                $impuesto = number_format($fac->venta->impuesto + $impuesto, 2);
            }
            $detalles = Detalle::where('tienda_id', '=', $tienda_id)->whereBetween('fechadetalle',array($inicio,$final))->get();

        }
       // return view('facturas.pdffecha',compact('facturas','detalles','total','descuento','impuesto'));

         $pdf=PDF::loadView('facturas.pdffecha',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
         $pdf->setPaper('letter','landscape');
         set_time_limit(600);
         return $pdf->stream('facturafecha.pdf');

    }
}

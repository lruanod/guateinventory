<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Cliente;
use App\Detalle;
use App\Entrada;
use App\Exports\DetallescategoriaExport;
use App\Exports\DetallesclienteExport;
use App\Exports\DetallesfpagoExport;
use App\Exports\DetallesproductoExport;
use App\Exports\DetallessinfiltroExport;
use App\Exports\DetallesusuarioExport;
use App\Exports\EntradascatgoriaExport;
use App\Exports\EntradasExport;
use App\Exports\EntradasproveedorExport;
use App\Exports\EntradassinfiltroExport;
use App\Exports\EntradasusuarioExport;
use App\Exports\ProductoscategoriaExport;
use App\Exports\ProductosExport;
use App\Exports\ProductossinExport;
use App\Factura;
use App\Fpago;
use App\Producto;
use App\Proveedore;
use App\Usuario;


Use PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    //// formulario
    public function  form( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $modal='';
        $modal2='';
        $modal3='';
        $modal4='';

        /// producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $productos = Producto::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscar'))){
            $productos= Producto::where('tienda_id','=',$tienda_id)->paginate(6);

        }

        /// categoria
        if (!empty($request->input('buscarca'))){
            $buscar= $request->input('buscarca');
            $categorias = Categoria::where('tienda_id','=',$tienda_id)->where('categoria','LIKE','%' . $buscar . '%')->orwhere('id','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscarca'))){
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->paginate(6);

        }
        /// cliente
        if (!empty($request->input('buscarc'))){
            $buscar= $request->input('buscarc');
            $clientes = Cliente::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('nit','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(2);
        }
        if (empty($request->input('buscarc'))){
            $clientes= Cliente::where('tienda_id','=',$tienda_id)->paginate(2);

        }
        /// usuarios
        if (!empty($request->input('buscarus'))){
            $buscar= $request->input('buscarus');
            $usuarios = Usuario::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('cui','LIKE','%' . $buscar . '%')->orwhere('usuario','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(2);
        }
        if (empty($request->input('buscarus'))){
            $usuarios= Usuario::where('tienda_id','=',$tienda_id)->paginate(2);

        }

        /// fpagos
        if (!empty($request->input('buscarf'))){
            $buscar= $request->input('buscarf');
            $fpagos = Fpago::where('tienda_id','=',$tienda_id)->where('formapago','LIKE','%' . $buscar . '%')->orwhere('id','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscarf'))){
            $fpagos= Fpago::where('tienda_id','=',$tienda_id)->paginate(6);
        }

        if (!empty($request->input('cliente_id'))){
            $buscarcliente= $request->input('cliente_id');
            $clientes= Cliente::where('tienda_id','=',$tienda_id)->where('id','=',$buscarcliente)->paginate(6);

            foreach ($clientes as $cli){
                session(['nit' => $cli->nit]);
                session(['cliente_id' => $cli->id]);
            }
        }
        if (!empty($request->input('usuario_id'))){
            $buscarusuario= $request->input('usuario_id');
            $usuarios= Usuario::where('tienda_id','=',$tienda_id)->where('id','=',$buscarusuario)->paginate(6);

            foreach ($usuarios as $usu){
                session(['usuario2' => $usu->usuario]);
                session(['usuario_id2' => $usu->id]);
            }
        }

        if (!empty($request->input('producto_id'))){
            $producto_id= $request->input('producto_id');
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$producto_id)->paginate(6);

            foreach ($productos as $pro){
                session(['codigo' => $pro->codigo]);
                session(['producto_id' => $pro->id]);
            }
        }
        if (!empty($request->input('fpago_id'))){
            $fpago_id= $request->input('fpago_id');
            $fpagos= Fpago::where('tienda_id','=',$tienda_id)->where('id','=',$fpago_id)->paginate(6);

            foreach ($fpagos as $fpag){
                session(['formapago' => $fpag->formapago]);
                session(['fpago_id' => $fpag->id]);
            }
        }
        if (!empty($request->input('categoria_id'))){
            $categoria_id= $request->input('categoria_id');
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->where('id','=',$categoria_id)->paginate(6);

            foreach ($categorias as $cate){
                session(['categoria' => $cate->categoria]);
                session(['categoria_id' => $cate->id]);
            }
        }

        return view('reportes.form',compact('productos','clientes','usuarios','fpagos','categorias'));
    }

    ///imprimir rago vista
    public function  vistafecha(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');

        if(!empty($request->input('nit'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $impuesto=0;
                $descuento=0;
                $total=0;

                $facturas= Factura::where('tienda_id','=',$tienda_id)->where('cliente_id','=',$request->session()->get('cliente_id'))->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($facturas as $fac) {
                    $total = number_format($fac->venta->total + $total, 2);
                    $descuento = number_format($fac->venta->descuento + $descuento, 2);
                    $impuesto = number_format($fac->venta->impuesto + $impuesto, 2);
                }
                $detalles = Detalle::where('tienda_id', '=', $tienda_id)->whereBetween('fechadetalle',array($inicio,$final))->get();

            }
            $pdf=PDF::loadView('Reportes.pdffecha',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
        }

        if(!empty($request->input('usuario'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $impuesto=0;
                $descuento=0;
                $total=0;

                $facturas= Factura::where('tienda_id','=',$tienda_id)->where('usuario_id','=',$request->session()->get('usuario_id'))->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($facturas as $fac) {
                    $total = number_format($fac->venta->total + $total, 2);
                    $descuento = number_format($fac->venta->descuento + $descuento, 2);
                    $impuesto = number_format($fac->venta->impuesto + $impuesto, 2);
                }
                $detalles = Detalle::where('tienda_id', '=', $tienda_id)->whereBetween('fechadetalle',array($inicio,$final))->get();

            }
            $pdf=PDF::loadView('Reportes.pdffecha',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
        }

        if(!empty($request->input('formapago'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $impuesto=0;
                $descuento=0;
                $total=0;

                $facturas= Factura::where('tienda_id','=',$tienda_id)->where('fpago_id','=',$request->session()->get('fpago_id'))->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($facturas as $fac) {
                    $total = number_format($fac->venta->total + $total, 2);
                    $descuento = number_format($fac->venta->descuento + $descuento, 2);
                    $impuesto = number_format($fac->venta->impuesto + $impuesto, 2);
                }
                $detalles = Detalle::where('tienda_id', '=', $tienda_id)->whereBetween('fechadetalle',array($inicio,$final))->get();

            }
            $pdf=PDF::loadView('Reportes.pdffecha',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
        }

        if(!empty($request->input('categoria'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $impuesto=0;
                $descuento=0;
                $total=0;

                $facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
                foreach ($facturas as $factura) {
                    foreach ($detalles as $detalle) {
                        if($detalle->venta_id==$factura->venta_id){
                            $total = number_format($detalle->subtotal + $total,2);
                        }


                } }
                $impuesto = number_format($total-($total/1.12), 2);


            }
            $pdf=PDF::loadView('Reportes.pdffecha2',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
        }

        if(!empty($request->input('codigo'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $impuesto=0;
                $descuento=0;
                $total=0;

                $facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.codigo', '=', $request->session()->get('codigo'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
                foreach ($facturas as $factura) {
                    foreach ($detalles as $detalle) {
                        if($detalle->venta_id==$factura->venta_id){
                            $total = number_format($detalle->subtotal + $total,2);
                        }


                    } }
                $impuesto = number_format($total-($total/1.12), 2);


            }
            $pdf=PDF::loadView('Reportes.pdffecha2',compact('facturas','detalles','total','descuento','impuesto','inicio','final'));
        }


        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        session(['categoria' => '']);
        session(['categoria_id' => '']);
        session(['formapago' => '']);
        session(['fpago_id' => '']);
        session(['codigo' => '']);
        session(['producto_id' => '']);
        session(['nit' => '']);
        session(['cliente_id' => '']);
        session(['usuario2' => '']);
        session(['usuario_id2' => '']);
       return $pdf->stream('facturafecha.pdf');

    }

    //// formulario stock
    public function  formstock( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $modal='';
        $modal2='';
        $modal3='';
        $modal4='';

        /// producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $productos = Producto::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscar'))){
            $productos= Producto::where('tienda_id','=',$tienda_id)->paginate(6);

        }

        /// categoria
        if (!empty($request->input('buscarca'))){
            $buscar= $request->input('buscarca');
            $categorias = Categoria::where('tienda_id','=',$tienda_id)->where('categoria','LIKE','%' . $buscar . '%')->orwhere('id','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscarca'))){
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->paginate(6);

        }


        if (!empty($request->input('producto_id'))){
            $producto_id= $request->input('producto_id');
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$producto_id)->paginate(6);

            foreach ($productos as $pro){
                session(['codigo' => $pro->codigo]);
                session(['producto_id' => $pro->id]);
            }
        }

        if (!empty($request->input('categoria_id'))){
            $categoria_id= $request->input('categoria_id');
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->where('id','=',$categoria_id)->paginate(6);

            foreach ($categorias as $cate){
                session(['categoria' => $cate->categoria]);
                session(['categoria_id' => $cate->id]);
            }
        }

        return view('reportes.formstock',compact('productos','categorias'));
    }

    ///imprimir rago vista
    public function  vistafechastock(Request $request){
        $tienda_id=$request->session()->get('tienda_id');


        if(!empty($request->input('categoria'))){
                $precioventa=0;
                $preciocompra=0;
                $stock=0;

                //$facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
                $productos= Producto::where('tienda_id','=',$tienda_id)->where('categoria_id','=',$request->session()->get('categoria_id'))->orderBy("created_at", "desc")->get();
               // $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
                foreach ($productos as $pro) {
                           // $precioventa = number_format(($pro->precioventa * $pro->stock)+$precioventa,2);
                              $precioventa = ($pro->precioventa * $pro->stock)+$precioventa;
                           // $preciocompra = number_format(($pro->precio * $pro->stock)+$preciocompra,2);
                              $preciocompra = ($pro->precio * $pro->stock)+$preciocompra;
                            $stock = $pro->stock + $stock;

                     }


            $pdf=PDF::loadView('Reportes.pdffechastock',compact('productos','preciocompra','precioventa','stock'));
        }

        if(!empty($request->input('codigo'))){
            $precioventa=0;
            $preciocompra=0;
            $stock=0;

            //$facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$request->session()->get('producto_id'))->orderBy("created_at", "desc")->get();
            // $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
            foreach ($productos as $pro) {
                $precioventa = ($pro->precioventa * $pro->stock)+$precioventa;
                $preciocompra = ($pro->precio * $pro->stock)+$preciocompra;
                $stock = $pro->stock + $stock;
            }


            $pdf=PDF::loadView('Reportes.pdffechastock',compact('productos','preciocompra','precioventa','stock'));
        }

        if(empty($request->input('codigo'))&&empty($request->input('categoria'))){
            $precioventa=0;
            $preciocompra=0;
            $stock=0;

            //$facturas= Factura::where('tienda_id','=',$tienda_id)->whereBetween('fechafactura',array($inicio,$final))->orderBy("created_at", "desc")->get();
            $productos= Producto::where('tienda_id','=',$tienda_id)->orderBy("created_at", "desc")->get();
            // $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
            foreach ($productos as $pro) {
                $precioventa = ($pro->precioventa * $pro->stock)+$precioventa;
                $preciocompra =($pro->precio * $pro->stock)+$preciocompra;
                $stock = $pro->stock + $stock;
            }


            $pdf=PDF::loadView('Reportes.pdffechastock',compact('productos','preciocompra','precioventa','stock'));
        }


        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        session(['categoria' => '']);
        session(['categoria_id' => '']);
        session(['codigo' => '']);
        session(['producto_id' => '']);
        return $pdf->stream('Reporte_stock.pdf');

    }

    //// formulario
    public function  formentrada( Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id');
        $modal='';
        $modal2='';
        $modal3='';
        $modal4='';

        /// producto
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $productos = Producto::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('codigo','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscar'))){
            $productos= Producto::where('tienda_id','=',$tienda_id)->paginate(6);

        }

        /// categoria
        if (!empty($request->input('buscarca'))){
            $buscar= $request->input('buscarca');
            $categorias = Categoria::where('tienda_id','=',$tienda_id)->where('categoria','LIKE','%' . $buscar . '%')->orwhere('id','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }

        if (empty($request->input('buscarca'))){
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->paginate(6);

        }

        /// usuarios
        if (!empty($request->input('buscarus'))){
            $buscar= $request->input('buscarus');
            $usuarios = Usuario::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orwhere('cui','LIKE','%' . $buscar . '%')->orwhere('usuario','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }
        if (empty($request->input('buscarus'))){
            $usuarios= Usuario::where('tienda_id','=',$tienda_id)->paginate(6);

        }

        /// proveedores
        if (!empty($request->input('buscarprov'))){
            $buscar= $request->input('buscarprov');
            $proveedores = Proveedore::where('tienda_id','=',$tienda_id)->where('nombre','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(6);
        }
        if (empty($request->input('buscarprov'))){
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->paginate(6);

        }


        if (!empty($request->input('usuario_id'))){
            $buscarusuario= $request->input('usuario_id');
            $usuarios= Usuario::where('tienda_id','=',$tienda_id)->where('id','=',$buscarusuario)->paginate(6);

            foreach ($usuarios as $usu){
                session(['usuario2' => $usu->usuario]);
                session(['usuario_id2' => $usu->id]);
            }
        }

        if (!empty($request->input('proveedore_id'))){
            $buscarprove= $request->input('proveedore_id');
            $proveedores= Proveedore::where('tienda_id','=',$tienda_id)->where('id','=',$buscarprove)->paginate(6);

            foreach ($proveedores as $prov){
                session(['proveedore' => $prov->nombre]);
                session(['proveedore_id' => $prov->id]);
            }
        }

        if (!empty($request->input('producto_id'))){
            $producto_id= $request->input('producto_id');
            $productos= Producto::where('tienda_id','=',$tienda_id)->where('id','=',$producto_id)->paginate(6);

            foreach ($productos as $pro){
                session(['codigo' => $pro->codigo]);
                session(['producto_id' => $pro->id]);
            }
        }

        if (!empty($request->input('categoria_id'))){
            $categoria_id= $request->input('categoria_id');
            $categorias= Categoria::where('tienda_id','=',$tienda_id)->where('id','=',$categoria_id)->paginate(6);

            foreach ($categorias as $cate){
                session(['categoria' => $cate->categoria]);
                session(['categoria_id' => $cate->id]);
            }
        }

        return view('reportes.formentrada',compact('productos','usuarios','categorias','proveedores'));
    }

    ///imprimir rago vista
    public function  vistafechaentrada(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');


        if(!empty($request->input('usuario'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $totalprecioentrada=0;
                $totalprecioentradaven=0;

                $entradas= Entrada::where('tienda_id','=',$tienda_id)->where('usuario_id','=',$request->session()->get('usuario_id2'))->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($entradas as $entra) {
                    $totalprecioentrada=number_format($entra->precioentrada+$totalprecioentrada,2);

                    $totalprecioentradaven=number_format($entra->precioentradaven+$totalprecioentradaven,2);

                }

            }
            $pdf=PDF::loadView('Reportes.pdffechaentrada',compact('entradas','totalprecioentradaven','totalprecioentrada','inicio','final'));
        }

        if(!empty($request->input('proveedor'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $totalprecioentrada=0;
                $totalprecioentradaven=0;

                $entradas= Entrada::where('tienda_id','=',$tienda_id)->where('proveedore_id','=',$request->session()->get('proveedore_id'))->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($entradas as $entra) {
                    $totalprecioentrada=number_format($entra->precioentrada+$totalprecioentrada,2);

                    $totalprecioentradaven=number_format($entra->precioentradaven+$totalprecioentradaven,2);

                }

            }
            $pdf=PDF::loadView('Reportes.pdffechaentrada',compact('entradas','totalprecioentradaven','totalprecioentrada','inicio','final'));
        }


        if(!empty($request->input('categoria'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $totalprecioentrada=0;
                $totalprecioentradaven=0;
               // $detalles = Detalle::join('productos','producto_id','productos.id')->where('detalles.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('detalles.fechadetalle',array($inicio,$final))->get();
               // $entradas= Entrada::where('tienda_id','=',$tienda_id)->where('usuario_id','=',$request->session()->get('usuario_id'))->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->get();
                $entradas =Entrada::join('productos','producto_id','productos.id')->where('entradas.tienda_id', '=', $tienda_id)->where('productos.categoria_id', '=', $request->session()->get('categoria_id'))->whereBetween('entradas.fechaentrada',array($inicio,$final))->get();
                foreach ($entradas as $entra) {
                    $totalprecioentrada=number_format($entra->precioentrada+$totalprecioentrada,2);
                    $totalprecioentradaven=number_format($entra->precioentradaven+$totalprecioentradaven,2);
                }

            }
            $pdf=PDF::loadView('Reportes.pdffechaentrada',compact('entradas','totalprecioentradaven','totalprecioentrada','inicio','final'));
        }

        if(!empty($request->input('codigo'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');
                $totalprecioentrada=0;
                $totalprecioentradaven=0;

                $entradas= Entrada::where('tienda_id','=',$tienda_id)->where('producto_id','=',$request->session()->get('producto_id'))->whereBetween('fechaentrada',array($inicio,$final))->orderBy("created_at", "desc")->get();
                foreach ($entradas as $entra) {
                    $totalprecioentrada=number_format($entra->precioentrada+$totalprecioentrada,2);
                    $totalprecioentradaven=number_format($entra->precioentradaven+$totalprecioentradaven,2);

                }

            }
            $pdf=PDF::loadView('Reportes.pdffechaentrada',compact('entradas','totalprecioentradaven','totalprecioentrada','inicio','final'));
        }


        $pdf->setPaper('letter','landscape');
        set_time_limit(600);
        session(['categoria' => '']);
        session(['categoria_id' => '']);
        session(['codigo' => '']);
        session(['producto_id' => '']);
        session(['usuario2' => '']);
        session(['usuario_id2' => '']);
        session(['proveedor' => '']);
        session(['proveedore_id' => '']);
        return $pdf->stream('entradafecha.pdf');

    }

    ///producto stock excel
    public function  vistafechastockex(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');
        $producto_id=$request->session()->get('producto_id');

        if(!empty($request->input('codigo'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))){
                $inicio= $request->input('finicio');
                $final= $request->input('ffinal');

            session(['codigo' => '']);
            session(['producto_id' => '']);
           return (new EntradasExport($producto_id,$tienda_id,$inicio,$final))->download('Reporte de entradas.xlsx');
            }

        }
    }

    ///reporte entrda categoria
    public function  vistafechastockcaex(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');
        $categoria_id=$request->session()->get('categoria_id');

        if(!empty($request->input('categoria'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');

                session(['categoria' => '']);
                session(['categoria_id' => '']);

                return (new EntradascatgoriaExport($categoria_id, $tienda_id, $inicio, $final))->download('Reporte de entradas.xlsx');
            }

        }
    }
   // reporte entrada usuario
    public function  vistafechastockusex(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');
        $usuario_id=$request->session()->get('usuario_id2');

        if(!empty($request->input('usuario'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');

                session(['usuario2' => '']);
                session(['usuario_id2' => '']);

                return (new EntradasusuarioExport($usuario_id, $tienda_id, $inicio, $final))->download('Reporte de entradas.xlsx');
            }

        }
    }

    // reporte entrada proveedor
    public function  vistafechastockprex(Request $request){
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');
        $proveedore_id=$request->session()->get('proveedore_id');

        if(!empty($request->input('proveedor'))){
            if (!empty($request->input('finicio'))||!empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');

                session(['proveedor' => '']);
                session(['proveedore_id' => '']);

                return (new EntradasproveedorExport($proveedore_id, $tienda_id, $inicio, $final))->download('Reporte de entradas.xlsx');
            }

        }
    }

    // reporte entrada sin filtro
    public function  vistafechastocksiex(Request $request){
        $validator = $this->validate($request, [
            'iniciopdf' => 'required|date',
            'finalpdf' => 'required|date'

        ]);
        $tienda_id=$request->session()->get('tienda_id');

            if (!empty($request->input('iniciopdf'))||!empty($request->input('finalpdf'))) {
                $inicio = $request->input('iniciopdf');
                $final = $request->input('finalpdf');


                return (new EntradassinfiltroExport($tienda_id, $inicio, $final))->download('Reporte de entradas.xlsx');
            }

    }


    ///reporte excel detalle venta cliente
    public function  vistafechaclex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $cliente_id = $request->session()->get('cliente_id');

        if (!empty($request->input('nit'))) {
            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['cliente_id' => '']);
                session(['nit' => '']);
                return (new DetallesclienteExport($cliente_id,$tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }

        }
    }

    ///reporte excel detalle  formapago
    public function  vistafechafpex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $fpago_id = $request->session()->get('fpago_id');

        if (!empty($request->input('formapago'))) {
            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['fpago_id' => '']);
                session(['formapago' => '']);
                return (new DetallesfpagoExport($fpago_id,$tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }

        }
    }

    ///reporte excel detalle  producto
    public function  vistafechaprex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $producto_id = $request->session()->get('producto_id');

        if (!empty($request->input('codigo'))) {
            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['producto_id' => '']);
                session(['codigo' => '']);
                return (new DetallesproductoExport($producto_id,$tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }

        }
    }

    ///reporte excel detalle  producto
    public function  vistafechacaex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $categoria_id = $request->session()->get('categoria_id');

        if (!empty($request->input('categoria'))) {
            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['categoria_id' => '']);
                session(['categoria' => '']);
                return (new DetallescategoriaExport($categoria_id,$tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }

        }
    }

    ///reporte excel detalle  usuario
    public function  vistafechausex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $usuario_id = $request->session()->get('usuario_id2');

        if (!empty($request->input('usuario'))) {
            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['usuario_id2' => '']);
                session(['usuario2' => '']);
                return (new DetallesusuarioExport($usuario_id,$tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }

        }
    }

    ///reporte excel detalle  usuario
    public function  vistafechasiex(Request $request)
    {
        $validator = $this->validate($request, [
            'finicio' => 'required|date',
            'ffinal' => 'required|date'

        ]);
        $tienda_id = $request->session()->get('tienda_id');


            if (!empty($request->input('finicio')) || !empty($request->input('ffinal'))) {
                $inicio = $request->input('finicio');
                $final = $request->input('ffinal');
                session(['usuario_id2' => '']);
                session(['usuario2' => '']);
                return (new DetallessinfiltroExport($tienda_id, $inicio, $final))->download('Reporte de ventas.xlsx');
            }


    }

    ///reporte excel stock  producto
    public function  reporteproductosex(Request $request)
    {
        $validator = $this->validate($request, [
            'codigo' => 'required|string'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $producto_id = $request->session()->get('producto_id');


            session(['codigo' => '']);
            session(['producto_id' => '']);
            return (new ProductosExport($producto_id,$tienda_id))->download('Reporte de stock.xlsx');


    }

    ///reporte excel stock categoria
    public function  reportecategoriasex(Request $request)
    {
        $validator = $this->validate($request, [
            'categoria' => 'required|string'

        ]);
        $tienda_id = $request->session()->get('tienda_id');
        $categoria_id = $request->session()->get('categoria_id');


        session(['categoria' => '']);
        session(['categoria_id' => '']);
        return (new ProductoscategoriaExport($categoria_id,$tienda_id))->download('Reporte de stock.xlsx');

    }

    ///reporte excel stock sinfiltro
    public function  reportesinsex(Request $request)
    {

        $tienda_id = $request->session()->get('tienda_id');

        return (new ProductossinExport($tienda_id))->download('Reporte de stock.xlsx');

    }

}

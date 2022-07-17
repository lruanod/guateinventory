<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//formulario login
Route::get('/formlogin', 'LoginController@form');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');


//categoria
//formulario categoria
    Route::get('/form_categoria', 'CategoriaController@form');
//guardar categoria
    Route::post('/savecategoria', 'CategoriaController@save');
//listar categorias
    Route::get('/list_categoria', 'CategoriaController@list');
//listar categorias jquery
    Route::get('/list_categoriabuscar', 'CategoriaController@listbuscar')->name('rest.list_categoriabuscar');
//formulario categoria
    Route::get('/form_edit_categoria/{id}', 'CategoriaController@editform')->name('form_edit_categoria');
//guardar categoria
    Route::patch('/edit_categoria/{id}', 'CategoriaController@edit')->name('edit_categoria');
//formulario des categoria
    Route::get('/form_des_categoria/{id}', 'CategoriaController@editforme')->name('form_des_categoria');
//guardar  des categoria
    Route::patch('/des_categoria/{id}', 'CategoriaController@edite')->name('des_categoria');

//medida
//formulario
    Route::get('/form_medida', 'MedidaController@form');
//guardar
    Route::post('/savemedida', 'MedidaController@save');
//listar
    Route::get('/list_medida', 'MedidaController@list');
//formulario
    Route::get('/form_edit_medida/{id}', 'MedidaController@editform')->name('form_edit_medida');
//guardar
    Route::patch('/edit_medida/{id}', 'MedidaController@edit')->name('edit_medida');
//formulario des
    Route::get('/form_des_medida/{id}', 'MedidaController@editforme')->name('form_des_medida');
//guardar  des
    Route::patch('/des_medida/{id}', 'MedidaController@edite')->name('des_medida');

//producto
//formulario
    Route::get('/form_producto', 'ProductoController@form');
//guardar
    Route::post('/saveproducto', 'ProductoController@save');
//listar
    Route::get('/list_producto', 'ProductoController@list');
//formulario
    Route::get('/form_edit_producto/{id}', 'ProductoController@editform')->name('form_edit_producto');
//guardar
    Route::patch('/edit_producto/{id}', 'ProductoController@edit')->name('edit_producto');
//formulario des
    Route::get('/form_des_producto/{id}', 'ProductoController@editforme')->name('form_des_producto');
//guardar  des
    Route::patch('/des_producto/{id}', 'ProductoController@edite')->name('des_producto');
//formulario des
    Route::get('/form_descuento_producto/{id}', 'ProductoController@formdescuento')->name('form_descuento_producto');
//guardar  des
    Route::patch('/descuento_producto/{id}', 'ProductoController@editdescuento')->name('descuento_producto');


//cliente
//formulario
    Route::get('/form_cliente', 'ClienteController@form');
//guardar
    Route::post('/savecliente', 'ClienteController@save');
//listar
    Route::get('/list_cliente', 'ClienteController@list');
//formulario
    Route::get('/form_edit_cliente/{id}', 'ClienteController@editform')->name('form_edit_cliente');
//guardar
    Route::patch('/edit_cliente/{id}', 'ClienteController@edit')->name('edit_cliente');

//usuario
//formulario
    Route::get('/form_usuario', 'UsuarioController@form');
//guardar
    Route::post('/saveusuario', 'UsuarioController@save');
//listar
    Route::get('/list_usuario', 'UsuarioController@list');
//formulario
    Route::get('/form_edit_usuario/{id}', 'UsuarioController@editform')->name('form_edit_usuario');
//guardar
    Route::patch('/edit_usuario/{id}', 'UsuarioController@edit')->name('edit_usuario');
//formulario des
    Route::get('/form_des_usuario/{id}', 'UsuarioController@editforme')->name('form_des_usuario');
//guardar  des
    Route::patch('/des_usuario/{id}', 'UsuarioController@edite')->name('des_usuario');
//formulario updatepass
    Route::get('/form_updatepass', 'UsuarioController@formupdatepass');
// updatepass
    Route::post('/updatepass', 'UsuarioController@updatepass');

//fpago
//formulario
    Route::get('/form_fpago', 'FpagoController@form');
//guardar
    Route::post('/savefpago', 'FpagoController@save');
//listar
    Route::get('/list_fpago', 'FpagoController@list');
//formulario
    Route::get('/form_edit_fpago/{id}', 'FpagoController@editform')->name('form_edit_fpago');
//guardar
    Route::patch('/edit_fpago/{id}', 'FpagoController@edit')->name('edit_fpago');
//formulario des
    Route::get('/form_des_fpago/{id}', 'FpagoController@editforme')->name('form_des_fpago');
//guardar  des
    Route::patch('/des_fpago/{id}', 'FpagoController@edite')->name('des_fpago');

//entrada
//formulario
    Route::get('/form_entrada', 'EntradaController@form');
//guardar
    Route::post('/saveentrada', 'EntradaController@save');
//listar
    Route::get('/list_entrada', 'EntradaController@list')->name('/list_entrada');
//formulario
    Route::get('/form_edit_entrada/{id}', 'EntradaController@editform')->name('form_edit_entrada');
//guardar
    Route::patch('/edit_entrada/{id}', 'EntradaController@edit')->name('edit_entrada');
//vista entrada pdf
    Route::get('/entrada_vista/{id}', 'EntradaController@vistapdf')->name('entrada_vista');
//vista entrada pdf
    Route::get('/imprimir_pdf/{id}', 'EntradaController@imprimirpdf')->name('imprimir_pdf');
//vista pdf rago fecha
    Route::get('/vista_fechas_entrada', 'EntradaController@vistafecha')->name('/vista_fechas_entrada');


//factura
//formulario
    Route::get('/form_factura', 'FacturaController@form');
//guardar cliente
    Route::post('/savecliente2', 'FacturaController@savecliente');
//eliminar detalle
    Route::delete('/deleteproducto/{id}', 'FacturaController@delete')->name('deleteproducto');
//eliminar detalle
    Route::get('/cancelar', 'FacturaController@cancelar')->name('cancelar');
//guardar
    Route::patch('/edit_detalle/{id}', 'FacturaController@edit')->name('edit_detalle');
//guardar factura
    Route::post('/savefactura', 'FacturaController@savefactura');
//listar
    Route::get('/list_factura', 'FacturaController@list');
//vista factura
    Route::get('/factura_vista/{id}', 'FacturaController@vistafactura')->name('factura_vista');
// factura pdf
    Route::get('/factura_pdf/{id}', 'FacturaController@facturapdf')->name('factura_pdf');

//imprimir pdf despues de factura
    Route::get('/imprimir_factura', 'FacturaController@imprimirfactura')->name('imprimir_factura');

    Route::get('/vista_fechas_factura', 'FacturaController@vistafecha')->name('/vista_fechas_factura');
//listar clientes en factura jquery
    Route::get('/list_clientesbuscar', 'FacturaController@clientesjquery')->name('rest.list_clientesbuscar');
//listar clientes en agregar al detalle de facturajquery
    Route::get('/sesionarcliente', 'FacturaController@clientesdjquery')->name('rest.sesionarcliente');

//listar productos en factura jquery
    Route::get('/list_productosbuscar', 'FacturaController@productosjquery')->name('rest.list_productosbuscar');
//listar detalles en factura jquery
    Route::get('/list_detallesbuscar', 'FacturaController@detallesjquery')->name('rest.list_detallesbuscar');

//reporte
//formulario
    Route::get('/form_reporte', 'ReporteController@form');
    Route::get('/vista_fechas_factura2', 'ReporteController@vistafecha')->name('/vista_fechas_factura2');
// formulario stock
    Route::get('/form_reportestock', 'ReporteController@formstock');
    Route::get('/vista_fechas_facturastock', 'ReporteController@vistafechastock')->name('/vista_fechas_facturastock');
//formulario entrada
    Route::get('/form_reporte_entrada', 'ReporteController@formentrada');
    Route::get('/vista_fechas_entrada2', 'ReporteController@vistafechaentrada')->name('/vista_fechas_entrada2');

// excel
    Route::get('/vista_fechas_facturastockex', 'ReporteController@vistafechastockex')->name('/vista_fechas_facturastockex');
    Route::get('/vista_fechas_facturastockcaex', 'ReporteController@vistafechastockcaex')->name('/vista_fechas_facturastockcaex');
    Route::get('/vista_fechas_facturastockusex', 'ReporteController@vistafechastockusex')->name('/vista_fechas_facturastockusex');
    Route::get('/vista_fechas_facturastockprex', 'ReporteController@vistafechastockprex')->name('/vista_fechas_facturastockprex');
    Route::get('/vista_fechas_facturastocksiex', 'ReporteController@vistafechastocksiex')->name('/vista_fechas_facturastocksiex');
    Route::get('/vista_fechas_factura2clex', 'ReporteController@vistafechaclex')->name('/vista_fechas_factura2clex');
    Route::get('/vista_fechas_factura2fpex', 'ReporteController@vistafechafpex')->name('/vista_fechas_factura2fpex');
    Route::get('/vista_fechas_factura2prex', 'ReporteController@vistafechaprex')->name('/vista_fechas_factura2prex');
    Route::get('/vista_fechas_factura2caex', 'ReporteController@vistafechacaex')->name('/vista_fechas_factura2caex');
    Route::get('/vista_fechas_factura2usex', 'ReporteController@vistafechausex')->name('/vista_fechas_factura2usex');
    Route::get('/vista_fechas_factura2siex', 'ReporteController@vistafechasiex')->name('/vista_fechas_factura2siex');
    Route::get('/productosex', 'ReporteController@reporteproductosex')->name('/productosex');
    Route::get('/stockcategoriaex', 'ReporteController@reportecategoriasex')->name('/stockcategoriaex');
    Route::get('/stocksinex', 'ReporteController@reportesinsex')->name('/stocksinex');


//proveedore
//formulario
    Route::get('/form_proveedore', 'ProveedoreController@form');
//guardar
    Route::post('/saveproveedore', 'ProveedoreController@save');
//listar
    Route::get('/list_proveedore', 'ProveedoreController@list');
//formulario
    Route::get('/form_edit_proveedore/{id}', 'ProveedoreController@editform')->name('form_edit_proveedore');
//guardar
    Route::patch('/edit_proveedore/{id}', 'ProveedoreController@edit')->name('edit_proveedore');
// formulario asignar producto
    Route::get('/form_productoasig/{id}', 'ProveedoreController@formasig')->name('form_productoasig');
//guardar
    Route::post('/savedetap', 'ProveedoreController@saveasig')->name('savedetap');
//eliminar detalle
    Route::delete('/deletedetalleproveedore/{id}', 'ProveedoreController@delete')->name('deletedetalleproveedore');
//formulario des
    Route::get('/form_des_proveedore/{id}', 'ProveedoreController@editforme')->name('form_des_proveedore');
//guardar  des
    Route::patch('/des_proveedore/{id}', 'ProveedoreController@edite')->name('des_proveedore');
/// imprimir reporte de proveedores
    Route::get('/reporteproveedorpdf', 'ProveedoreController@reporteproveedorpdf');




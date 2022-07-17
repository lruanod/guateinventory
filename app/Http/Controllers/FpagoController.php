<?php

namespace App\Http\Controllers;

use App\Fpago;
use Illuminate\Http\Request;

class FpagoController extends Controller
{
    //// formulario
    public function  form(){
        return view('fpagos.form');
    }

    // guardar
    public function save(Request $request){
        $validator = $this->validate($request,[
            'formapago'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);

        $fpagodata= request()->except('_token');
        Fpago::insert($fpagodata);
        return back()->with('exito', 'forma de pago guardada');
    }
    ///listar
    public function  list(Request $request){
        $tienda_id=$request->session()->get('tienda_id');
        if (!empty($request->input('buscar'))){
            $buscar= $request->input('buscar');
            $data['fpagos'] = Fpago::where('tienda_id','=',$tienda_id)->where('formapago','LIKE','%' . $buscar . '%')->orwhere('estado','LIKE','%' . $buscar . '%')->orderBy("created_at", "desc")->paginate(10);
        }
        if (empty($request->input('buscar'))){
            $data['fpagos']= Fpago::where('tienda_id','=',$tienda_id)->paginate(10);
        }
        return view('fpagos.list',$data);
    }

    // form editar
    public  function editform($id){
        $fpago = Fpago::findOrFail($id);
        return  view('fpagos.edit',compact('fpago'));
    }
    // editar medida
    public function edit(Request $request, $id){
        $validator = $this->validate($request,[
            'formapago'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $fpagodata= request()->except('_token','estado', '_method');

        Fpago::where('id','=',$id)->update($fpagodata);
        return back()->with('exito', 'forma de pago modificada');
    }

    // form deshabilitar
    public  function editforme($id){
        $fpago = Fpago::findOrFail($id);
        return  view('fpagos.deshabilitar',compact('fpago'));
    }
    // deshabilitar
    public function edite(Request $request, $id){
        $validator = $this->validate($request,[
            'formapago'=> 'required|string|max:45',
            'estado'=> 'required|string|max:45',
            'tienda_id'=> 'required|integer'
        ]);
        $fpagodata= request()->except('_token', '_method');

        Fpago::where('id','=',$id)->update($fpagodata);
        return back()->with('exito', 'forma de pago modificada');
    }
}

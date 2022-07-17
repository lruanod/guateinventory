@extends('layouts.base2')
@section('title', 'login')
@section('content')
    <div class="col-md-6 mt-3">
        <!-- mesajes de confirmacion -->
        @if(session('nologin'))
            <div class="alert alert-danger">
                {{session('nologin')}}
            </div>
        @endif

    <!-- mesajes de confirmacion -->
        @if(session('login'))
            <div class="alert alert-success">
                {{session('login')}}
            </div>
        @endif

    <!-- errores de validaciones -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors-> all() as $errors)
                        <li>{{$errors}}</li>
                    @endforeach

                </ul>
            </div>
    @endif
    <!--fin error -->
    <div class=" row justify-content-center">
              <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                  <form action="{{url('/login')}}" method="post">
                      @csrf
                      <div class="card-header text-center text-white">
                   Iniciar sesión
                       </div>
                      <div class="card-body">

                          <div class="row form-group">
                              <label for="tienda_id" class="col-5 text-white">Codigo de tienda</label>
                              <input type="number" name="tienda_id" class="form-control col-md-7">
                          </div>
                           <div class="row form-group">
                              <label for="" class="col-5 text-white">Usuario</label>
                              <input type="text" name="usuario" class="form-control col-md-7">
                           </div>


                           <div class="row form-group">
                              <label for="pass" class="col-5 text-white">Contraseña</label>
                              <input type="password" name="pass" class="form-control col-md-7">
                           </div>

                           <br>
                           <div class="row form-group">
                              <button type="submit" class="btn btn-danger col-md-4 ">Ingresar</button>
                           </div>
                      </div>
                  </form>
              </div>
          </div>
          <a href="">Reinicio de contraseña</a>

</div>
@endsection

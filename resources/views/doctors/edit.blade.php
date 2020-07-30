@extends('layouts.panel')

@section('content')

     
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Edit doctor</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <div class="card-body">
              <!-- Atrapamos los errores y los iteramos para mostrar cada uno de ellos dentro de un elemento html -->
              @if ($errors->any())
                
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                  @foreach ($errors->all() as $error)
                  <li> {{$error}}</li>
                  @endforeach
                  
                </div>
              @endif
                  <form action="{{ url('doctors/'.$doctor->id) }}" method="post">
                    @csrf
                    <!-- Para poder editar el registro indicamos el método PUT para que al enviar el formulario se atienda esa petición en el controlador  -->
                    @method('PUT')
                  <div class="form-group">
                    <label for="name"> Nombre</label>
                    <input type="text" name="name"  class="form-control" required value="{{ old('name', $doctor->name)}}" >
                  </div>
                
                  <div class="form-group">
                    <label for="email"> Email</label>
                    <input type="text" name="email" class="form-control" required value="{{ old('email', $doctor->email)}}" >
                  </div>

                  <div class="form-group">
                    <label for="cedula"> DNI</label>
                    <input type="text" name="cedula" class="form-control"  value="{{ old('cedula', $doctor->cedula)}}" >
                  </div>

                  <div class="form-group">
                    <label for="address"> Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address)}}" >
                  </div>

                  <div class="form-group">
                    <label for="phone"> Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone)}}" >
                  </div>

                  <div class="form-group">
                    <label for="password"> Contraseña </label>
                    <input type="text" name="password" class="form-control" value="" >
                    <p>Ingrese un valor solo si desea modificar la contraseña</p>
                  </div>

                  <button type="submit" class="btn btn-primary"> Guardar</button>
                  </form>
                
             </div>
            </div>
          </div>
    
        
    

@endsection

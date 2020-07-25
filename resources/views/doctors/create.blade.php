@extends('layouts.panel')

@section('content')

     
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">New doctor</h3>
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
                  <form action="{{ url('doctors') }}" method="post">
                    @csrf
                  <div class="form-group">
                    <label for="name"> Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name')}}" >
                  </div>
                
                  <div class="form-group">
                    <label for="nadescription"> Email</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description')}}" >
                  </div>

                  <div class="form-group">
                    <label for="nadescription"> DNI</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description')}}" >
                  </div>

                  <div class="form-group">
                    <label for="nadescription"> Dirección</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description')}}" >
                  </div>

                  <div class="form-group">
                    <label for="nadescription"> Teléfono</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description')}}" >
                  </div>

                  <button type="submit" class="btn btn-primary"> Guardar</button>
                  </form>
                
             </div>
            </div>
          </div>
    
        
    

@endsection

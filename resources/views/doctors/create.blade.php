@extends('layouts.panel')

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection

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
                    <input type="text" name="name"  class="form-control" required value="{{ old('name')}}" >
                  </div>
                
                  <div class="form-group">
                    <label for="email"> Email</label>
                    <input type="text" name="email" class="form-control" required value="{{ old('email')}}" >
                  </div>

                  <div class="form-group">
                    <label for="cedula"> DNI</label>
                    <input type="text" name="cedula" class="form-control"  value="{{ old('cedula')}}" >
                  </div>

                  <div class="form-group">
                    <label for="address"> Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address')}}" >
                  </div>

                  <div class="form-group">
                    <label for="phone"> Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone')}}" >
                  </div>

                  <div class="form-group">
                    <label for="specialties"> Especialidad</label>
                    <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-outline-success" multiple title="Seleccione una o varias">
                      @foreach($specialties as $specialty)
                      <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="password"> Contraseña</label>
                    <input type="text" name="password" class="form-control" value="{{  Str::random(6) }}" >
                  </div>

                  <button type="submit" class="btn btn-primary"> Guardar</button>
                  </form>
                
             </div>
            </div>
          </div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@endsection

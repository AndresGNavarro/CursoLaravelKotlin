@extends('layouts.panel')

@section('content')

     
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Doctors</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors/create') }}" class="btn btn-sm btn-success">Add doctor</a>
                </div>
              </div>
            </div>
              <div class="card-body">
                @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{session('notification') }}
                </div>
                @endif
              </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($doctors as $doctor)
                  <tr>
                    <th scope="row">
                      {{ $doctor->name }}
                    </th>
                    <td>
                      {{ $doctor->email }}
                    </td>
                     <td>
                      {{ $doctor->cedula }}
                    </td>
                    <td>
                      <form action="{{ url('/doctors/'.$doctor->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                      <a href=" {{ url('/doctors/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary"> Editar</a>

                      <!-- Por seguridad para  las peticiones DELETE utilizamos un FORM ya que interactuamos directamente con la base de datos e intentaremos borrar registros-->
                      <button class="btn btn-sm btn-danger" type="submit"> Eliminar</button>
                      </form>
                      
                    </td>
                    
                  </tr>
                  @endforeach
               
                
                </tbody>
              </table>
            </div>
          </div>
    
        
    

@endsection

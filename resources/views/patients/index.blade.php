@extends('layouts.panel')

@section('content')

     
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Patients</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients/create') }}" class="btn btn-sm btn-success">Add patient</a>
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
                  @foreach ($patients as $patient)
                  <tr>
                    <th scope="row">
                      {{ $patient->name }}
                    </th>
                    <td>
                      {{ $patient->email }}
                    </td>
                     <td>
                      {{ $patient->cedula }}
                    </td>
                    <td>
                      <form action="{{ url('/patients/'.$patient->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                      <a href=" {{ url('/patients/'.$patient->id.'/edit') }}" class="btn btn-sm btn-primary"> Editar</a>

                      <!-- Por seguridad para  las peticiones DELETE utilizamos un FORM ya que interactuamos directamente con la base de datos e intentaremos borrar registros-->
                      <button class="btn btn-sm btn-danger" type="submit"> Delete</button>
                      </form>
                      
                    </td>
                    
                  </tr>
                  @endforeach
               
                
                </tbody>
              </table>
            </div>
            <div class="card-body">
              <!-- De esta manera podemos paginar  a traves de LARAVEL-->
              {{ $patients->links() }}
            </div>
          </div>
    
        
    

@endsection

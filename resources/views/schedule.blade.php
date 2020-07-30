@extends('layouts.panel')

@section('content')
  
  <form action="{{ url('/schedule') }}" method="post">
    @csrf
    <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Admin Schedule</h3>
                </div>
                <button type="submit" class="btn btn-sm btn-success">
                  Save changes
                </button>
                
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
                    <th scope="col">Día</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Turno mañana</th>
                    <th scope="col">Turno tarde</th>
                  </tr>
                </thead>
                <tbody>

                 @foreach ($days as $key => $day)
                 <tr>
                   <th>{{ $day }}</th>
                   <td>
                     <label class="custom-toggle">
                       <input type="checkbox" name="active[]" value="{{$key}}">
                       <span class="custom-toggle-slider rounded-circle"></span>
                     </label>
                   </td>
                   <td>
                     <div class="row">
                       <div class="col">
                         <select class="form-control" name="morning_start[]">
                           @for($i=5;$i<=11;$i++)
                           <option value="{{$i}}:00">{{$i}}:00 a.m.</option>
                           <option value="{{$i}}:30">{{$i}}:30 a.m.</option>
                           @endfor
                         </select>
                       </div>
                       <div class="col">
                         <select class="form-control" name="morning_end[]">
                           @for($i=5;$i<=11;$i++)
                           <option value="{{$i}}:00">{{$i}}:00 a.m.</option>
                           <option value="{{$i}}:30">{{$i}}:30 a.m.</option>
                           @endfor
                         </select> 
                       </div>
                     </div>
                   </td>
                   <td>
                     <div class="row">
                       <div class="col">
                         <select class="form-control" name="afternoon_start[]">
                           @for($i=1;$i<=11;$i++)
                           <option value="{{$i+11}}:00">{{$i}}:00 p.m.</option>
                           <option value="{{$i+11}}:30">{{$i}}:30 p.m.</option>
                           @endfor
                         </select>
                       </div>
                       <div class="col">
                         <select class="form-control" name="afternoon_end[]">
                           @for($i=1;$i<=11;$i++)
                           <option value="{{$i+11}}:00">{{$i}}:00 p.m.</option>
                           <option value="{{$i+11}}:30">{{$i}}:30 p.m.</option>
                           @endfor
                         </select> 
                       </div>
                     </div> 
                   </td>
                 </tr>
                 @endforeach

                </tbody>
              </table>
            </div>
    </div>  
  </form>
  

@endsection

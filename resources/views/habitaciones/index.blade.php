@extends('layouts.app')

@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/motels/motels.js')}}" type="module"></script>
@endpush
@section('content')

<div class="container">
    <div class="row justify-content-center shadow-sm bg-white">
        <h1 class="display-4">Habitaciones {{$mo_nombre}}</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="col">
            <a class="btn btn-primary w-25 mb-2" href="{{route('user.habitacion.create',["id"=>$id])}}" role="button">Agregar nuevo</a>
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.motels.index')}}" role="button">Volver</a>
            <table id="datatable" class="display">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Numero</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Tiempo</th>
                        <th>Tipo</th>
                        <th>estado</th>
                        <th>acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td>
                           {{$habitacion->ha_nombre_habitacion}}
                            </td>
                        <td>{{$habitacion->ha_numero_habitacion}}</td>
                        <td>{{$habitacion->ha_descripcion}}</td>
                        <td>{{$habitacion->ha_precio}}</td>
                        <td>{{$habitacion->ha_tiempo}}</td>
                        <td>{{$habitacion->tipo->tipo}}</td>
                        <td>{{$habitacion->estado->est_estado}}</td>
                        {{-- <td>{{$habitacion->mo_foto_portada}}</td> --}}
                        <td><!-- Example single danger button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bi bi-gear" aria-hidden="true"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    @can('user.habitacion.edit')
                                    <li><a class="dropdown-item" href="{{ route('user.habitacion.edit',["id"=>$habitacion->ha_id]) }}">Editar</a>
                                    </li>
                                    @endcan
                                  
                                    @can('admin.fotos.index')
                                        <li><a class="dropdown-item" href="{{ route('admin.fotos.index',["id"=>$habitacion->ha_id,'tipo'=>'habitaciones']) }}">Agregar fotos</a>
                                        </li>
                                    @endcan
                                 
                                    @can('user.habitacion.destroy')
                                    <form class="form-delete" motel='{{$habitacion->ha_id}}' action="{{ route('user.habitacion.destroy',["id"=>$habitacion->ha_id]) }}" method="POST">
                                        @csrf

                                        <li><button class="dropdown-item" href="#">Eliminar</button></li>

                                    </form>
                                    @endcan

                                </ul>
                                </div></td>
                    </tr>
                    @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

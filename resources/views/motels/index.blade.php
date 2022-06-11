@extends('layouts.app')

@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/motels/motels.js')}}" type="module"></script>
@endpush
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-4">Moteles</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="col">
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.motels.create')}}" role="button">Agregar nuevo</a>

            <table id="datatable" class="display">
                <thead>
                    <tr>
                        <th>Portada</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Coordenadas</th>
                        {{-- <th>estado</th> --}}
                        <th>acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moteles as $motel)
                    <tr>
                        <td>
                            <a class="venobox"  href="{{ url('public/moteles/'.$motel->mo_foto_portada) }}">
                            <img src="{{ url('public/moteles/'.$motel->mo_foto_portada) }}"
 style="height: 100px; width: 150px;"></a>
                            </td>
                        <td>{{$motel->mo_nombre}}</td>
                        <td>{{$motel->mo_direccion}}</td>
                        <td>{{$motel->mo_latitud}} {{$motel->mo_longitud}}</td>
                        {{-- <td>{{$motel->mo_foto_portada}}</td> --}}
                        <td><!-- Example single danger button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bi bi-gear" aria-hidden="true"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    @can('admin.motels.edit')
                                    <li><a class="dropdown-item" href="{{ route('admin.motels.edit',["id"=>$motel->mo_id]) }}">Editar</a>
                                    </li>
                                    @endcan
                                  
                                    @can('admin.fotos.index')
                                        <li><a class="dropdown-item" href="{{ route('admin.fotos.index',["id"=>$motel->mo_id]) }}">Agregar fotos</a>
                                        </li>
                                    @endcan
                                    @can('admin.motels.destroy')
                                    <form class="form-delete" motel='{{$motel->mo_id}}' action="{{ route('admin.motels.destroy',["id"=>$motel->mo_id]) }}" method="POST">
                                        @csrf

                                        <li><button class="dropdown-item" href="#">Eliminar</button></li>

                                    </form>
                                    @endcan
{{--    
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
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

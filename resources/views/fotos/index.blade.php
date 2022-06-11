@extends('layouts.app')

@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/motels/motels.js')}}" type="module"></script>
@endpush
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-4">Fotos {{$mo_nombre}}</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="col">
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.fotos.create',["id"=>$id])}}" role="button">Agregar nuevo</a>
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.motels.index')}}" role="button">Volver</a>

            <table id="datatable" class="display">
                <thead>
                    <tr>
                        <th>foto</th>
                        <th>Descripcion</th>
                    
                        <th>acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fotos as $foto)
                    <tr>
                        <td>
                            <a class="venobox"  href="{{ url('public/moteles/'.$foto->fh_foto) }}">
                            <img src="{{ url('public/moteles/'.$foto->fh_foto) }}"
 style="height: 100px; width: 150px;"></a>
                            </td>
                        <td>{{$foto->fh_descripcion}}</td>
                       
                        <td><!-- Example single danger button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bi bi-gear" aria-hidden="true"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    @can('admin.fotos.edit')
                                    <li><a class="dropdown-item" href="{{ route('admin.fotos.edit',["id"=>$foto->fot_id]) }}">Editar</a>
                                    </li>
                                    @endcan
                                    @can('admin.fotos.destroy')

                                    <form class="form-delete"  action="{{ route('admin.fotos.destroy',["id"=>$foto->fot_id]) }}" method="POST">
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

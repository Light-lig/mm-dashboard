@extends('layouts.app')
<style>
    #map { height: 180px; }
</style>
@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/motels/edit/edit.js')}}" type="module"></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center shadow-sm bg-white">
        <h1 class="display-4">Editar motel</h1>

        <div class="col-md-8">
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.motels.index')}}" role="button">Volver</a>

            <form action="{{route('admin.motels.update')}}" method="POST" enctype="multipart/form-data">
              @csrf

                <div class="mb-3">
                  <label for="mo_nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="mo_nombre" name="mo_nombre" value="{{$motel->mo_nombre}}" aria-describedby="emailHelp" required>
                </div>
               
                <div class="mb-3">
                  <img id="blah" class='img-thumbnail' src="{{ url('public/moteles/'.$motel->mo_foto_portada) }}" alt="your image" />

                  <label for="mo_foto_portada" class="form-label">Foto portada</label>
                  <input type="file" class="form-control" id="mo_foto_portada" name="mo_foto_portada" />
                </div>
                <div class="mb-3">
                  <label for="cat_id" class="form-label">Categoria</label>
                  <select name="cat_id" id="cat_id" class="form-select"  aria-label="Default select example" required>
                    <option value=''>Seleccione una categoria</option>
                    @foreach ($categorias as $item)
                    <option value="{{$item['cat_id']}}" {{ ($item->cat_id == $motel->cat_id) ? 'selected="selected"' : '' }}>{{$item['cat_tipo']}}</option>

                    @endforeach
                  </select>
                </div>
                <div id="map"></div>
                <input type="hidden" name="mo_old_image" id="mo_old_image" value="{{$motel->mo_foto_portada}}"/>
                <input type="hidden" name="mo_id" id="mo_id" value="{{$motel->mo_id}}"/>

                <input type="hidden" name="mo_latitud" id="mo_latitud" value="{{$motel->mo_latitud}}"/>
                <input type="hidden" name="mo_longitud" id="mo_longitud" value="{{$motel->mo_longitud}}"/>
                <div class="mb-3">
                    <label for="mo_direccion" class="form-label">Direccion</label>
                    <textarea class="form-control" id="mo_direccion" rows="3" name="mo_direccion" required>{{$motel->mo_direccion}}</textarea>
                  </div>
                  <div class="mb-3">
                    <label for="dep_id" class="form-label">Departamento</label>
                    <select name="dep_id" id="dep_id" class="form-select" aria-label="Default select example" required>
                      <option value=''>Seleccione un departemento</option>
                    
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="mun_id" class="form-label">Municipio</label>
                    <select id="mun_id" name="mun_id" class="form-select" aria-label="Default select example" municipio="{{$motel->mun_id}}" required>
                      <option value=''>Seleccione un municipio</option>

                    </select>
                  </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    
</div>

@endsection

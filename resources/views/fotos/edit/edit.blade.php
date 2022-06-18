@extends('layouts.app')
<style>
    #map { height: 180px; }
</style>
@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/fotos/edit/index.js')}}" type="module"></script>
@endpush 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-4">Editar foto</h1>

        <div class="col-md-8">
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.fotos.index',["id"=>($tipo=='moteles')?$foto->mo_id:$foto->ha_id,'tipo'=>$tipo])}}" role="button">Volver</a>

            <form action="{{route('admin.fotos.update')}}" method="POST" enctype="multipart/form-data">
              @csrf

                <input type="hidden" name="mo_id" value="{{$foto->mo_id}}">
                <input type="hidden" name="ha_id" value="{{$foto->ha_id}}">

                <input type="hidden" name="fh_old_foto" value="{{$foto->fh_foto}}">
                <input type="hidden" name="fot_id" value="{{$foto->fot_id}}">
                <input type="hidden" name="tipo" value="{{$tipo}}">

                <div class="mb-3">
                  <img id="blah" class='img-thumbnail' src="{{ url('public/'.$tipo.'/'.$foto->fh_foto) }}"  alt="your image" />

                  <label for="fh_foto" class="form-label">Foto portada</label>
                  <input type="file" class="form-control" id="fh_foto" name="fh_foto"  >
                </div>
             
               
                <div class="mb-3">
                    <label for="fh_descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control" id="fh_descripcion" rows="3" name="fh_descripcion" required>{{$foto->fh_descripcion}}</textarea>
                  </div>
                 
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    
</div>

@endsection

@extends('layouts.app')

@push('head')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/views/fotos/add/index.js')}}" type="module"></script>
@endpush 
@section('content')
<div class="container">
    <div class="row justify-content-center shadow-sm bg-white p-2">
        <h1 class="display-4">Agregar foto</h1>

        <div class="col-md-8">
            <a class="btn btn-primary w-25 mb-2" href="{{route('admin.fotos.index',["id"=>$id,'tipo'=>$tipo])}}" role="button">Volver</a>

            <form action="{{route('admin.fotos.store')}}" method="POST" enctype="multipart/form-data">
              @csrf

                <input type="hidden" name="mo_id" value="{{$id}}">
                <input type="hidden" name="ha_id" value="{{$id}}">

                <input type="hidden" name="tipo" value="{{$tipo}}">
                <div class="mb-3">
                  <img id="blah" class='img-thumbnail' src="#" alt="your image" />

                  <label for="fh_foto" class="form-label">Foto portada</label>
                  <input type="file" class="form-control" id="fh_foto" name="fh_foto" required>
                </div>
             
               
                <div class="mb-3">
                    <label for="fh_descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control" id="fh_descripcion" rows="3" name="fh_descripcion" required></textarea>
                  </div>
                 
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    
</div>

@endsection

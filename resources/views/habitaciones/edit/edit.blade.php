@extends('layouts.app')
<style>
    #map { height: 180px; }
</style>
@push('head')
<!-- Styles -->
<!-- Scripts -->
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center shadow-sm bg-white">
        <h1 class="display-4">Editar habitacion</h1>

        <div class="col-md-8">
            <a class="btn btn-primary w-25 mb-2" href="{{route('user.habitacion.index',['id'=>$habitacion->mo_id])}}" role="button">Volver</a>

            <form action="{{route('user.habitacion.update')}}" method="POST" enctype="multipart/form-data">
              @csrf

                <div class="mb-3">
                  <label for="ha_nombre_habitacion" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="ha_nombre_habitacion" name="ha_nombre_habitacion" value="{{$habitacion->ha_nombre_habitacion}}" required>
                </div>
                <div class="mb-3">
                    <label for="ha_numero_habitacion" class="form-label">Numero</label>
                    <input type="number" class="form-control" id="ha_numero_habitacion" name="ha_numero_habitacion" value="{{$habitacion->ha_numero_habitacion}}" required>
                  </div>
                 
                <div class="mb-3">
                    <label for="ha_precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="ha_precio" name="ha_precio" value="{{$habitacion->ha_precio}}" required>
                  </div>
                 
                <div class="mb-3">
                    <label for="ha_tiempo" class="form-label">Tiempo</label>
                    <input type="text" class="form-control" id="ha_tiempo" name="ha_tiempo"  value="{{$habitacion->ha_tiempo}}"  required>
                  </div>
                 
                  <div class="mb-3">
                    <label for="ha_descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control" id="ha_descripcion" rows="3" name="ha_descripcion" required> {{$habitacion->ha_descripcion}}</textarea>
                  </div>
                <div class="mb-3">
                  <label for="ha_id_tipo_de_habitacion" class="form-label">Tipo</label>
                  <select name="ha_id_tipo_de_habitacion" id="ha_id_tipo_de_habitacion" class="form-select"  required>
                    <option value=''>Seleccione un tipo</option>
                    @foreach ($tipos as $item)
                    <option value="{{$item['id_tipo_habitacion']}}"{{ ($item->id_tipo_habitacion == $habitacion->ha_id_tipo_de_habitacion) ? 'selected="selected"' : '' }}>{{$item['tipo']}}</option>

                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="es_id" class="form-label">Estado</label>
                  <select name="es_id" id="es_id" class="form-select"  required>
                    <option value=''>Seleccione un estado</option>
                    @foreach ($estados as $item)
                    <option value="{{$item['est_id']}}" {{ ($item['est_id'] == $habitacion->es_id) ? 'selected="selected"' : '' }}>{{$item['est_estado']}}</option>

                    @endforeach
                  </select>
                </div>
                <input type="hidden" name="ha_id" id="ha_id" value="{{$habitacion->ha_id}}"/>

                <input type="hidden" name="mo_id" id="mo_id" value="{{$habitacion->mo_id}}"/>
             
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    
</div>

@endsection

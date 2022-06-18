<!DOCTYPE html>
<html>
<head>
    <title>Reporte De {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    
    <p>{{ $info }}</p>
  
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr class="thead-dark">
            <th scope="col">#</th>
            <th scope="col">Tipo</th>
            <th scope="col">Creado</th>
            <th scope="col">Actualizado</th>            
        </tr>
        </thead>
        <tbody>
        @foreach($tipoHabitacion as $th)
        <tr>
            <td>{{ $th->id_tipo_habitacion }}</td>
            <td>{{ $th->tipo }}</td>            
            <td>{{ $th->created_at }}</td>
            <td>{{ $th->updated_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
  
</body>
</html>
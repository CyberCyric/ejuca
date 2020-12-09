@extends('layouts.app')
@section('content')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div>
						<h2>Inscribir al alumno: <b>{{$alumno->nombre}} {{$alumno->apellido}}</b></h2>
					</div>
				</div>
			</div>
			<form method="POST" action="inscribir">
				@csrf
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Curso</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($cursos as $curso)
						<tr>
						<td><input type="checkbox" id="c{{$curso->id}}" name="curso_id[]" value="{{$curso->id}}"/></td>	
						<td>{{ $curso->nombre }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<input type="hidden" name="alumno_id" value="{{$alumno->id}}">
				<button id="btnSubmit" type="submit" class="btn btn-warning btn-sm" >Aceptar</button>
				<a class="btn btn-warning btn-sm" href="{{ url('alumnos/') }}">Volver</a>
			</form>
			<div class="clearfix"></div>
		</div>
	</div>        
</div>
<script>
$(document).ready(function (){
    $.ajax({                                      
	  url: '/inscripciones/{{$alumno->id}}',             
      type: "GET",          
      success: function (data) {
        var obj = JSON.parse(data);
        $.each(obj, function (key, val) {
          curso_id = val["curso_id"];
		  $("#c"+curso_id).prop('checked', true);
        });
    },
    error: function() { 
         console.log(data);
    }
   });
});
</script>
@endsection
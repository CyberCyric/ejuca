@extends('layouts.app')
@section('content')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Alumnos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Nuevo alumno</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Matrícula</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($alumnos as $alumno)
					<tr>
						<td>{{ $alumno->nombre }}</td>
						<td>{{ $alumno->apellido }}</td>
						<td>{{ $alumno->matricula }}</td>
						<td>
						<a class="btn btn-warning btn-sm" href="{{ url('cursos_alumno/'.$alumno->id) }}">Inscribir</a>
						<button id="btnEdit"class="btn btn-warning btn-sm" onClick="javascript:editar({{ $alumno->id }});">Editar</button>
							<br />
							<form action="{{ url('alumnos/'.$alumno->id) }}" class="d-inline form-delete" method="POST">
								@method('DELETE')
								@csrf
								<button id="btnDelete"class="btn btn-danger btn-sm">Borrar</button>
							</form> 
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="clearfix"></div>
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('/alumnos/')}}">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Nuevo alumno</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" required name="nombre">
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" class="form-control" name="apellido">
					</div>
					<div class="form-group">
						<label>Nro. Matrícula</label>
                        <input type="number" class="form-control" name="matricula">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Crear">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('/alumnos/')}}" id="formEdit">
				@csrf
				{{ method_field('PUT') }}
				<div class="modal-header">						
					<h4 class="modal-title">Editar alumno</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" required name="nombre" id="inpNombre">
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" class="form-control" name="apellido" id="inpApellido">
					</div>
					<div class="form-group">
						<label>Matrícula</label>
						<input type="number" class="form-control" name="matricula" id="inpMatricula">
					</div>					
				</div>
				<div class="modal-footer">
					<input type="hidden" class="form-control" name="alumno_id" id="inpalumnoId">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-info btn-save" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$("form#form-delete").onsubmit=function(){
		return confirm('¿ELiminar Registro');
		console.log("ELIMINAR!");
	}
	
	function editar(id){
		$.get( "{{ url('/alumnos/') }}/"+id, function( alumno ) {
			$("#editEmployeeModal input#inpalumnoId").val( alumno.id );
			$("#editEmployeeModal input#inpNombre").val( alumno.nombre );
			$("#editEmployeeModal input#inpApellido").val( alumno.apellido );
			$("#editEmployeeModal input#inpMatricula").val( alumno.matricula );
			$("#editEmployeeModal").modal('show');
		});			
	}

	$(document).ready(function() {
        $(".btn-save").on("click", function (e) {
			e.preventDefault();
			var id = $("#inpalumnoId").val();
            $('#formEdit').attr('action', "{{ url('/alumnos/')}}/"+id);
            $("#formEdit").submit();
        });
    });
</script>
@endsection
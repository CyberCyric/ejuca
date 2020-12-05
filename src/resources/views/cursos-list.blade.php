@extends('layouts.app')
@section('content')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Cursos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Nuevo Curso</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha de Inicio</th>
						<th>Fecha de Fin</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($cursos as $curso)
					<tr>
						<td>{{ $curso->nombre }}</td>
						<td>{{ $curso->fecha_inicio }}</td>
						<td>{{ $curso->fecha_fin }}</td>
						<td>
						<button id="btnEdit"class="btn btn-warning btn-sm" onClick="javascript:editar({{ $curso->id }});">Editar</button>
							<br />
							<form action="{{ url('cursos/'.$curso->id) }}" class="d-inline form-delete" method="POST">
								@method('DELETE')
								@csrf
								<button id="btnDelete"class="btn btn-danger btn-sm">Delete</button>
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
			<form method="POST" action="{{ url('/cursos/')}}">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Nuevo Curso</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" required name="nombre">
					</div>
					<div class="form-group">
						<label>Fecha de Inicio</label>
						<input type="text" class="form-control" name="fecha_inicio" placeholder="aaaa/mm/dd">
					</div>
					<div class="form-group">
						<label>Fecha de Fin</label>
						<input type="text" class="form-control" name="fecha_fin" placeholder="aaaa/mm/dd">
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
			<form method="POST" action="{{ url('/cursos/')}}" id="formEdit">
				@csrf
				{{ method_field('PUT') }}
				<div class="modal-header">						
					<h4 class="modal-title">Editar Curso</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" required name="nombre" id="inpNombre">
					</div>
					<div class="form-group">
						<label>Fecha de Inicio</label>
						<input type="text" class="form-control" name="fecha_inicio" id="inpFecha_inicio" placeholder="aaaa/mm/dd">
					</div>
					<div class="form-group">
						<label>Fecha de Fin</label>
						<input type="text" class="form-control" name="fecha_fin" id="inpFecha_fin" placeholder="aaaa/mm/dd">
					</div>					
				</div>
				<div class="modal-footer">
					<input type="hidden" class="form-control" name="curso_id" id="inpCursoId">
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
	}
	
	function editar(id){
		$.get( "{{ url('/cursos/') }}/"+id, function( curso ) {
			$("#editEmployeeModal input#inpCursoId").val( curso.id );
			$("#editEmployeeModal input#inpNombre").val( curso.nombre );
			$("#editEmployeeModal input#inpFecha_inicio").val( curso.fecha_inicio );
			$("#editEmployeeModal input#inpFecha_fin").val( curso.fecha_fin );
			$("#editEmployeeModal").modal('show');
		});			
	}

	$(document).ready(function() {
        $(".btn-save").on("click", function (e) {
			e.preventDefault();
			var id = $("#inpCursoId").val();
            $('#formEdit').attr('action', "{{ url('/cursos/')}}/"+id);
            $("#formEdit").submit();
        });
    });
</script>
@endsection
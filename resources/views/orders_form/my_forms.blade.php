@extends('layouts.bt4.app')
@section('title', 'Formulario de requerimiento')
@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />

<div class="row sales layout-top-spacing">
	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="row my-3">
				<div class="col">
					<h3>Listado de Ordenes</h3>
				</div>
				<div class="col text-right">
					<a href="javascript:void(0)" onclick="showModalcreate()" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-compensado" title="Nueva orden de pedido">
						<i class="fas fa-plus"></i> Orden
					</a>
				</div>
			</div>
			<div class="widget-content">
				<div class="table-responsive">
					<table id="tableCompensado" class="table table-striped mt-1">
						<thead class="text-white" style="background: #3B3F5C">
							<tr>
								<th class="table-th text-white">#</th>
								<th class="table-th text-white">CLIENT</th>
								<th class="table-th text-white ">CE</th>
								<th class="table-th text-white">ST</th>
								<th class="table-th text-white">VALOR.O</th>
								<th class="table-th text-white">UTILIDAD</th>
								<th class="table-th text-white">DATE.ORDEN</th>
								<th class="table-th text-white">DATE.ENTRE</th>
								<th class="table-th text-white">VENDEDOR</th>
								<th class="table-th text-white text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- modal -->
	<div class="modal fade" id="modal-create-compensado" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content bg-default">
				<fieldset id="contentDisable">
					<form action="" id="form-compensado-res">
						<div class="modal-header">
							<h4 class="modal-title">Crear orden de pedido</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							@include('orders_form.modal_create')
						</div>
						<div class="modal-footer">
							<button type="button" id="btnModalClose" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							<button type="submit" id="btnAddVentaDomicilio" class="btn btn-primary">Aceptar</button>
						</div>
					</form>
				</fieldset>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>








@include('request_form.partials.modals.confirm_delete')

@endsection
@section('custom_js')
<script>
	$('#confirm').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

		$('.debug-url').html('<strong>Eliminar Formulario de Requerimiento ID ' + $(e.relatedTarget).data('id') + '</strong>');
	});
</script>
@endsection
@section('custom_js_head')
<style>
	table {
		border-collapse: collapse;
	}

	.brd-l {
		border-left: solid 1px #D6DBDF;
	}

	.brd-r {
		border-right: solid 1px #D6DBDF;
	}

	.brd-b {
		border-bottom: solid 1px #D6DBDF;
	}

	.brd-t {
		border-top: solid 1px #D6DBDF;
	}


	oz {
		color: red;
		font-size: 60px;
		background-color: yellow;
		font-family: time new roman;
	}
</style>
@endsection
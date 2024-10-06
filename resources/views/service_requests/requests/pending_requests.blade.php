@extends('layouts.bt4.app')

@section('title', 'Reporte estado de firmas')

@section('content')

@include('service_requests.partials.nav')

<h3 class="mb-3">Reporte estado de firmas</h3>

<!-- <form method="GET" class="form-horizontal" action="{{ route('rrhh.service-request.report.consolidated_data') }}">
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text">Rango de fechas (Inicio de contrato)</span>
		</div>

		<input type="text" value="Todos los datos" disabled>
    <div class="input-group-append">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
    </div>
	</div>
</form> -->

<!-- <input type="date" class="form-control" id="for_dateFrom" name="dateFrom" value="2021-01-01" required >
<input type="date" class="form-control" id="for_dateTo" name="dateTo" value="2021-01-31" required> -->

<hr>

<h4>Usuarios con hojas de ruta pendientes por visar</h4>
<!-- <hr> -->
<table class="table table-sm small table-striped" >
    <thead>
        <tr>
            <th>FUNCIONARIO</th>
            <th>CANTIDAD</th>
						<th></th>
        </tr>
    </thead>
    <tbody>
      @foreach($array as $key => $data)
      @if($key != NULL)
        <tr>
          <td nowrap>{{$key}}</td>
          <td nowrap>{{count($data)}}</td>
					<td>@livewire('service-request.pending-service-request' , ['data' => $data])</td>
        </tr>
      @endif
      @endforeach
      <tr>
        <td nowrap>Total</td>
        <td nowrap><b>{{$hoja_ruta_falta_aprobar}}</b></td>
      </tr>
    </tbody>
</table>

<hr>
<h4>Cumplimientos pendientes por ingresar</h4>

<table class="table table-sm small table-striped" >
    <thead>
        <tr>
            <th>SUPERVISOR</th>
						<!-- <th>UNIDAD</th> -->
            <th>CANTIDAD</th>
        </tr>
    </thead>
    <tbody>
      @foreach($fulfillments_missing as $key => $fulfillment)

	        <tr>
	          <td nowrap>{{$key}}</td>

	          <td nowrap>{{$fulfillment}}</td>
	        </tr>

      @endforeach
			<tr>
				<td nowrap></td>
        <td nowrap>Total</td>
        <td nowrap><b>{{$cumplimiento_falta_ingresar}}</b></td>
      </tr>
    </tbody>
</table>


@endsection

@section('custom_js_head')
<script type="text/javascript">

</script>
@endsection

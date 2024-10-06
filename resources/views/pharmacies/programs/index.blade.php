@extends('layouts.bt4.app')

@section('title', 'Lista de Programas con Farmacia')

@section('content')

@include('pharmacies.nav')

<h3 class="inline">Programas
	@can('Pharmacy: create programs')
	<a href="{{ route('pharmacies.programs.create') }}" class="btn btn-primary">Crear</a>
	@endcan
</h3>

<br>
<br>

<table class="table table-striped table-sm table-bordered">
	<thead>
		<tr>
			<th scope="col">Nombre</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
	@foreach($programs as $program)
		<tr>
			<td>{{ $program->name }}</td>
			<td>
				<a href="{{ route('pharmacies.programs.edit', $program) }}"
					class="btn btn-sm btn-outline-secondary">
					<span class="fas fa-edit" aria-hidden="true"></span>
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

{{ $programs->links() }}

@endsection

@section('custom_js')

@endsection

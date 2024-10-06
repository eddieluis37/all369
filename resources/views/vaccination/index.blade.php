@extends('layouts.bt4.app')

@section('title', 'Listado de personal a vacunar')

@section('content')

@include('vaccination.partials.nav')

<h3 class="mb-3">Listado de personal a vacunar</h3>

<form method="GET" class="form-horizontal" action="{{ route('vaccination.index') }}">
    <div class="input-group mb-sm-4">
        <input class="form-control" type="text" name="search" autocomplete="off" id="for_search" style="text-transform: uppercase;" placeholder="RUN (sin dígito verificador) / NOMBRE" value="{{$request->search}}" required>
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
        </div>
    </div>
</form>


<div class="table-responsive">
<table class="table table-sm table-bordered small">
    <thead>
        <tr>
            <th>Id</th>
            <th>1°</th>
            <th>2°</th>
            <th>Estab</th>
            <th class="d-none d-md-table-cell">Unidad Organ.</th>
            <th></th>
            <th>Nombre</th>
            <th>Run</th>
            <th>Cita 1° dósis</th>
            <th>Inoc. 1°</th>
            <th>Cita 2° dósis</th>
            <th>Inoc. 2°</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vaccinations as $key => $vaccination)
            <tr>
                <td class="small">{{ $vaccination->id }}</td>
                <td>
                    @if($vaccination->first_dose_at)
                        <div class="btn btn-sm" style="color:#007bff;"><i class="fas fa-syringe"></i></div>
                    @else
                    <form method="POST" class="form-horizontal" action="{{ route('vaccination.vaccinate',['vaccination' => $vaccination, 'dose' => 'first']) }}">
                        @csrf
                        @method('PUT')
                        @if($vaccination->first_dose)
                        <button type="submit" class="btn btn-sm" onclick="return clicked('{{$vaccination->fullName()}}','primera');"><i class="fas fa-syringe"></i></button>
                        @endif
                    </form>
                    @endif
                </td>
                <td>
                    @if($vaccination->second_dose_at)
                        <div class="btn btn-sm" style="color:#007bff;"><i class="fas fa-syringe"></i></div>
                    @else
                    <form method="POST" class="form-horizontal" action="{{ route('vaccination.vaccinate',['vaccination' => $vaccination, 'dose' => 'second']) }}">
                        @csrf
                        @method('PUT')
                        @if($vaccination->second_dose)
                        <button type="submit" class="btn btn-sm" onclick="return clicked('{{$vaccination->fullName()}}','segunda');"><i class="fas fa-syringe"></i></button>
                        @endif
                    </form>
                    @endif
                </td>

                <td>{{ $vaccination->aliasEstab }}</td>
                <td class="d-none d-md-table-cell" style="width: 200px;">{{ $vaccination->organizationalUnit }}</td>
                <td>
                    @switch($vaccination->inform_method)
                        @case(1)
                            <i class="fas fa-eye" style="color:#007bff;"></i>
                            @break

                        @case(2)
                            <i class="fas fa-phone" style="color:#007bff;"></i>
                            @break
                        @case(3)
                            <i class="fas fa-envelope" style="color:#007bff;"></i>
                            @break
                        @default
                            <i class="fas fa-eye" style="color:#cccccc;"></i>
                    @endswitch
                </td>
                <td nowrap>{{ $vaccination->fullName() }}</td>
                <td nowrap class="text-right" {!! Helper::validaRut($vaccination->runFormat) ? '' : 'style="color:red;"' !!}>
                    {{ $vaccination->runFormat }}
                </td>
                <td nowrap>
                    {{ optional($vaccination->first_dose)->format('d-m-Y H:i') }}
                </td>
                <td nowrap>
                    {{ optional($vaccination->first_dose_at)->format('d-m-Y') }}
                </td>
                <td nowrap>
                    {{ optional($vaccination->second_dose)->format('d-m-Y H:i') }}
                </td>
                <td nowrap>
                    {{ optional($vaccination->second_dose_at)->format('d-m-Y') }}
                </td>
                <td> <a href="{{ route('vaccination.edit', $vaccination) }}"> <i class="fas fa-edit"></i> </a> </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $vaccinations->appends(request()->query())->links() }}
</div>


@endsection

@section('custom_js')
<script type="text/javascript">
    function clicked(user, dose) {
        return confirm('Desea registrar que se ha vacunado '+user+' para la '+dose+' dosis?');
    }
</script>
@endsection

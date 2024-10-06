@extends('layouts.bt4.app')

@section('title', 'Ley 18834')

@section('content')

@include('indicators.partials.nav')

<style media="screen">
    .label {
        width: 40%;
    }
</style>

<h3 class="mb-3">SERVICIO DE SALUD TARAPACÁ</h3>

<hr>

<h5 class="mb-3">{{ $data111['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data111['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data111['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data111['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data111['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data111['numerador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data111['numerador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data111['numerador_12'] }}</td>
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data111['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data111['denominador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data111['denominador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data111['denominador_12'] }}</td>
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $data112['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data112['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data112['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data112['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data112['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data112['numerador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data112['numerador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data112['numerador_12'] }}</td>
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data112['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data112['denominador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data112['denominador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data112['denominador_12'] }}</td>
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $data113['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data113['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data113['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data113['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data113['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data113['numerador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data113['numerador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data113['numerador_12'] }}</td>
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data113['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data113['denominador'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data113['denominador_6'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-rigth">{{ $data113['denominador_12'] }}</td>
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $data12['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data12['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data12['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data12['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data12['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data12['numerador_acumulado'] }}</td>
            @foreach($data12['numeradores'] as $mes)
                <td>{{ $mes }}</td>
            @endforeach
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data12['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data12['denominador_acumulado'] }}</td>
            @foreach($data12['denominadores'] as $mes)
                <td>{{ $mes }}</td>
            @endforeach
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $data14['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data14['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data14['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data14['meta'] }}
                <small><br>línea base: {{ $data14['meta_nacional'] }}%</small>
            </td>
            <td rowspan="2" class="align-middle">
              @if($data14['cumplimiento'] <= ($data14['meta_nacional']-8))
                100%
                <small><br>{{ $data14['cumplimiento'] }}%</small>
              @endif
            </td>
            <td class="text-rigth">{{ $data14['numerador_acumulado'] }}</td>
            @foreach($data14['numeradores'] as $mes)
                <td>{{ $mes }} </td>
            @endforeach
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data14['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data14['denominador_acumulado'] }}</td>
            @foreach($data14['denominadores'] as $mes)
                <td>{{ $mes }} </td>
            @endforeach
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $datab['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $datab['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datab['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datab['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datab['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $datab['numerador_acumulado'] }}</td>
            @foreach($datab['numeradores'] as $mes)
                <td>{{ $mes }}</td>
            @endforeach
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $datab['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $datab['denominador_acumulado'] }}</td>
            <td colspan="12">{{ $datab['denominador_acumulado'] }}</td>
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $datac['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Ponde</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $datac['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datac['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datac['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datac['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $datac['numerador_acumulado'] }}</td>
            @foreach($datac['numeradores'] as $mes)
                <td>{{ $mes }}</td>
            @endforeach
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $datac['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $datac['denominador_acumulado'] }}</td>
            <td colspan="12">{{ $datac['denominador_acumulado'] }}</td>
        </tr>
    </tbody>
</table>







<h5 class="mb-3">{{ $datad['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Ponde</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $datad['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datad['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $datad['meta'] }}</td>
            <td rowspan="2" class="align-middle">@if($datad['numerador'] <= 5)
                100%
            @endif</td>
            <td class="text-rigth">{{ number_format($datad['numerador'], 1, ',', '.') }}%</td>
            <td class="text-center" colspan="12">{{ number_format($datad['numerador'], 1, ',', '.') }}%</td>
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $datad['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $datad['denominador_acumulado'] }}%</td>
            <td class="text-center" colspan="12">{{ $datad['denominador_acumulado'] }}%</td>
        </tr>
    </tbody>
</table>







<h5 class="mb-3">{{ $data3a['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Ponde</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data3a['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3a['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3a['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3a['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data3a['numerador_acumulado'] }}</td>
            @foreach($data3a['numeradores'] as $mes)
                <td>{{ $mes }} </td>
            @endforeach
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data3a['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data3a['denominador_acumulado'] }}</td>
            @foreach($data3a['denominadores'] as $mes)
                <td>{{ $mes }} </td>
            @endforeach
        </tr>
    </tbody>
</table>




<h5 class="mb-3">{{ $data3b['label']['meta'] }}</h5>

<table class="table table-sm table-bordered small mb-4">

    <thead>
        <tr class="text-center">
            <th class="label">Indicador</th>
            <th nowrap>Pond</th>
            <th nowrap>Meta</th>
            <th nowrap>% Cump</th>
            <th>Acum</th>
            <th>Ene</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Abr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Ago</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center">
            <td class="text-left">{{ $data3b['label']['numerador'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3b['ponderacion'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3b['meta'] }}</td>
            <td rowspan="2" class="align-middle">{{ $data3b['cumplimiento'] }}%</td>
            <td class="text-rigth">{{ $data3b['numerador_acumulado'] }}</td>
            <td colspan="{{ $data3b['vigencia'] }}" class="text-center">
                {{ number_format($data3b['numerador_acumulado'],0, ',', '.') }}
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-left">{{ $data3b['label']['denominador'] }}</td>
            <td class="text-rigth">{{ $data3b['denominador_acumulado'] }}</td>
            <td colspan="12">{{ $data3b['denominador_acumulado'] }}</td>
        </tr>
    </tbody>
</table>
@endsection

@section('custom_js')
<script type="text/javascript">
    $('#myTab a[href="#IQUIQUE"]').tab('show') // Select tab by name
</script>
@endsection

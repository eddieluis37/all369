@extends('layouts.bt4.app')

@section('title', 'Ley N° 18.834')

@section('content')

@include('indicators.partials.nav')

@foreach($data2 as $nombre_comuna => $comuna)
  <h3 class="mb-3">{{ $nombre_comuna }}</h3>
@endforeach

<h6 class="mb-3">Metas Sanitarias Ley N° 18.834</h6>

<style>
    .glosa {
        width: 400px;
    }
</style>

<hr>

@foreach($data1 as $nombre_comuna => $comuna)
<h5 class="mb-3">{{ $label1['meta'] }}</h5>
<table class="table table-sm table-bordered small">
    <thead>
        <tr class="text-center">
          <!--<th>Nombre de la Meta</th>-->
          <th>Indicador</th>
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
        <tr>
          <!--<td rowspan="2">{{ $label2['meta'] }}</td>-->
          <td class="text-left glosa">{{ $label1['numerador'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ $comuna['meta'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ number_format($comuna['cumplimiento'], 2, ',', '.') }}%</td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="text-left">{{ $label1['denominador'] }}</td>
          <td class="text-right">{{ number_format($comuna['denominador'],0,',','.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador'], 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
@endforeach
<br>

@foreach($data2 as $nombre_comuna => $comuna)

<h5 class="mb-3">{{ $label2['meta'] }}</h5>
<table class="table table-sm table-bordered small">
    <thead>
        <tr class="text-center">
          <!--<th>Nombre de la Meta</th>-->
          <th>Indicador</th>
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
        <tr>
          <!--<td rowspan="2">{{ $label2['meta'] }}</td>-->
          <td class="text-left glosa">{{ $label2['numerador'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ $comuna['meta'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ number_format($comuna['cumplimiento'], 2, ',', '.') }}%</td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="text-left">{{ $label2['denominador'] }}</td>
          <td class="text-right">{{ number_format($comuna['denominador'],0,',','.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador'], 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
@endforeach
<br>

@foreach($data4 as $nombre_comuna => $comuna)

<h5 class="mb-3">{{ $label4['meta'] }}</h5>
<table class="table table-sm table-bordered small">
    <thead>
        <tr class="text-center">
          <!--<th>Nombre de la Meta</th>-->
          <th>Indicador</th>
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
        <tr>
          <!--<td rowspan="2">{{ $label2['meta'] }}</td>-->
          <td class="text-left glosa">{{ $label4['numerador'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ $comuna['meta'] }}</td>
          <td rowspan="2" class="align-middle text-center">{{ number_format($comuna['cumplimiento'], 2, ',', '.') }}%</td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['numerador'], 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="text-left">{{ $label4['denominador'] }}</td>
          <td class="text-right">{{ number_format($comuna['denominador'],0,',','.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador_6'], 0, ',', '.') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-right">{{ number_format($comuna['denominador'], 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
@endforeach

<h5 class="mb-3">{{ $data8['label'] }}</h5>

<table class="table table-sm table-bordered small">

    <thead>
        <tr class="text-center">
            <th>Indicador</th>
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
        <tr>
            <td class="text-left glosa">{{ $data8['label_numerador'] }}</td>
            <td rowspan="2" class="align-middle text-center">{{ $data8['meta'] }}</td>
            <td rowspan="2" class="align-middle text-center">{{ $data8['cumplimiento']}} %</td>
            <td class="text-right">{{ number_format($data8['numerador_acumulado'],0, ',', '.') }}</td>
            @foreach($data8['numeradores'] as $numerador)
                <td class="text-right">{{ number_format($numerador, 0, ',', '.') }}</td>
            @endforeach
        </tr>
        <tr>
            <td class="text-left">{{ $data8['label_denominador'] }}</td>
            <td class="text-right">{{ number_format($data8['denominador_acumulado'],0, ',', '.') }}</td>
            @foreach($data8['denominadores'] as $denominador)
                <td class="text-right">{{ number_format($denominador, 0, ',', '.') }}</td>
            @endforeach
        </tr>
    </tbody>
</table>



<h5 class="mb-3">{{ $data10['label'] }}</h5>

<table class="table table-sm table-bordered small">

    <thead>
        <tr class="text-center">
            <th>Indicador</th>
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
        <tr>
            <td class="text-left glosa">{{ $data10['label_numerador'] }}</td>
            <td rowspan="2" class="align-middle text-center">{{ $data10['meta'] }}</td>
            <td rowspan="2" class="align-middle text-center">{{ $data10['cumplimiento']}} %</td>
            <td class="text-right">{{ number_format($data10['numerador_acumulado'],0, ',', '.') }}</td>
            <td class="text-right" colspan="{{ $data10['vigencia'] }}">{{ number_format($data10['numerador_acumulado'],0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-left">{{ $data10['label_denominador'] }}</td>
            <td class="text-right">{{ number_format($data10['denominador_acumulado'],0, ',', '.') }}</td>
            <td class="text-right" colspan="{{ $data10['vigencia'] }}">{{ number_format($data10['denominador_acumulado'],0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
@endsection

@section('custom_js')
<script type="text/javascript">
    $('#myTab a[href="#IQUIQUE"]').tab('show') // Select tab by name
</script>
@endsection

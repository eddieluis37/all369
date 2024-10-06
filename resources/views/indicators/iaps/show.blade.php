@extends('layouts.bt4.app')
@php
    $months = array (1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
@endphp
@section('title', 'Indicadores APS '. $iaps->year . ' : ' . $iaps->name)
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('indicators.index') }}">Indicadores</a></li>
        <li class="breadcrumb-item"><a href="{{ route('indicators.iaps.index') }}">APS</a></li>
        <li class="breadcrumb-item"><a href="{{ route('indicators.iaps.list', $iaps->year) }}">{{$iaps->year}}</a></li>
        <li class="breadcrumb-item">{{$iaps->name}} / {{$iaps->establishment_type}}</li>
    </ol>
</nav>

<style>
    .glosa {
        width: 400px;
    }
</style>

@if($iaps->establishment_type == 'APS')
<h3 class="mb-3">{{$iaps->name}}.</h3>

<!-- Nav tabs -->
<ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
    @foreach($iaps->communes as $commune)
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true"
            href="#{{ str_replace(" ","_",$commune) }}">{{$commune}}
        </a>
    </li>
    @endforeach
</ul>

<!-- Tab panes -->
<div class="tab-content mt-3">
    @foreach($iaps->communes as $commune)
    <div class="tab-pane" id="{{ str_replace(" ","_",$commune) }}" role="tabpanel" >
        <h4>{{ $commune }}
            <small><button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-search-plus"></i></button>
            </small>
        </h4>
        <!-- print indicadores APS -->
        @if($iaps->indicators->isEmpty())
            <p>No existen indicadores o no se han definido aún para el indicador APS actual.</p>
        @else
            @foreach($iaps->indicators as $indicator)
            @if($indicator->hasEstablishments($iaps->establishments, $commune))
        <div class="table-responsive">
            <table class="table table-sm table-bordered small mb-4">
                <thead>
                    <tr><th colspan="100%">{{$indicator->number}}. {{$indicator->name}}.</th></tr>
                    <tr class="text-center">
                        <th class="label">Indicador</th>
                        <th>Meta</th>
                        <th>% Cump.</th>
                        <th>Acum</th>
                        @foreach($months as $month)
                        <th>{{$month}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                <!-- numerador comuna -->
                    <tr class="text-center">
                        @php($result = $indicator->getSourceAbbreviated('numerador'))
                        <td class="text-left glosa">{{$indicator->numerator}}. <span class="badge badge-secondary">{{ $result }}</span> @if($result != $indicator->numerator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->numerator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                        <td rowspan="2" class="text-center align-middle">{{$indicator->goal}}</td>
                        @php($result = $indicator->getCompliance2($commune, null))
                        <td rowspan="2" class="text-center align-middle">{{str_contains($indicator->goal ?? '%', '%') ? number_format($result, 2, ',', '.').'%' : number_format($result/100, 2, '.', ',')}}</td>
                        <td class="text-center">{{number_format($indicator->numerator_source == 'REM P' ? $indicator->getLastValueByFactor2('numerador', $commune, null) : $indicator->getValuesAcum2('numerador', $commune, null), 0, ',', '.')}}</td>
                        @foreach($months as $number => $month)
                        @php($result = $indicator->getValueByFactorAndMonth2('numerador', $number, $commune, null))
                        <td class="text-right">{{ $result != null ? number_format($result, 0, ',', '.') : ''}}</td>
                        @endforeach
                    </tr>
                <!-- denominador comuna -->
                    <tr class="text-center">
                        @php($result = $indicator->getSourceAbbreviated('denominador'))
                        <td class="text-left glosa">{{$indicator->denominator}}. <span class="badge badge-secondary">{{ $result }}</span> @if($result != $indicator->denominator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->denominator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                        <td class="text-center">{{number_format($indicator->denominator_source == 'REM P' ? $indicator->getLastValueByFactor2('denominador', $commune, null) : $indicator->getValuesAcum2('denominador', $commune, null), 0, ',', '.')}}</td>
                        @foreach($months as $number => $month)
                        @php($result = $indicator->getValueByFactorAndMonth2('denominador', $number, $commune, null))
                        <td class="text-right">{{ $result != null ? number_format($result, 0, ',', '.') : ''}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
            @foreach($iaps->establishments as $establishment)
                @if($establishment->comuna == $commune && Str::contains($indicator->establishment_cods, $establishment->Codigo))
                <strong> {{ $establishment->alias_estab }} </strong>
                <table class="table table-sm table-bordered small mb-4">
                    <thead>
                        <tr class="text-center">
                            <th class="label">Indicador</th>
                            <th>Meta</th>
                            <th>% Cump.</th>
                            <th>Acum</th>
                            @foreach($months as $month)
                            <th>{{$month}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    <!-- numerador establecimiento -->
                        <tr class="text-center">
                            <td class="text-left glosa">{{$indicator->numerator}}.</span></td>
                            <td rowspan="2" class="text-center align-middle">{{$indicator->goal}}</td>
                            <td rowspan="2" class="text-center align-middle">{{str_contains($indicator->goal ?? '%', '%') ? number_format($indicator->getCompliance2(null, $establishment->alias_estab), 2, ',', '.').'%' : number_format($indicator->getCompliance2(null, $establishment->alias_estab)/100, 2, '.', ',')}}</td>
                            <td class="text-center">{{number_format($indicator->numerator_source == 'REM P' ? $indicator->getLastValueByFactor2('numerador', null, $establishment->alias_estab) : $indicator->getValuesAcum2('numerador', null, $establishment->alias_estab), 0, ',', '.')}}</td>
                            @foreach($months as $number => $month)
                            @php($result = $indicator->getValueByFactorAndMonth2('numerador', $number, null, $establishment->alias_estab))
                            <td class="text-right">{{ $result != null ? number_format($result, 0, ',', '.') : ''}}</td>
                            @endforeach
                        </tr>
                    <!-- denominador establecimiento -->
                        <tr class="text-center">
                            <td class="text-left glosa">{{$indicator->denominator}}.</td>
                            <td class="text-center">{{number_format($indicator->denominator_source == 'REM P' ? $indicator->getLastValueByFactor2('denominador', null, $establishment->alias_estab) : $indicator->getValuesAcum2('denominador', null, $establishment->alias_estab), 0, ',', '.')}}</td>
                            @foreach($months as $number => $month)
                            @php($result = $indicator->getValueByFactorAndMonth2('denominador', $number, null, $establishment->alias_estab))
                            <td class="text-right">{{ $result != null ? number_format($result, 0, ',', '.') : ''}}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                @endif
            @endforeach
                </div>
                <br>
            </div>
        </div>
        @endif
            @endforeach
        @endif
    </div>
    @endforeach
</div>
<!-- fin print indicadores -->
{{$iaps->indicators->links()}}
@else <!-- Hospital, Hector Reyno u otro en especifico -->
    <h3 class="mb-3">{{$iaps->name}}.</h3>
    <h5 class="mb-3">{{$iaps->establishment_type}}.</h5>

    @if($iaps->indicators->isEmpty())
        <p>No existen indicadores o no se han definido aún para la meta sanitaria actual.</p>
    @else
        @foreach($iaps->indicators as $indicator)
            <!-- print indicador -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered small mb-4">
                        <thead>
                            <tr><th colspan="100%">{{$indicator->number}}. {{$indicator->name}}.</th></tr>
                            <tr class="text-center">
                                <th class="label">Indicador</th>
                                <th>Meta</th>
                                <th>% Cump.</th>
                                <th>Acum</th>
                                @foreach($months as $month)
                                <th>{{$month}}</th>
                                @endforeach
                            </tr>
                        </thead>
                            <tbody>
                            <!-- numerador -->
                            <tr class="text-center">
                                <td class="text-left glosa">{{$indicator->numerator}}. <span class="badge badge-secondary">{{ $indicator->getSourceAbbreviated('numerador') }}</span> @if($indicator->getSourceAbbreviated('numerador') != $indicator->numerator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->numerator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                                <td rowspan="2" class="text-center align-middle">{{$indicator->goal}}</td>
                                <td rowspan="2" class="text-center align-middle">{{number_format($indicator->getCompliance(), 2, ',', '.')}}%</td>
                                <td class="text-center">{{number_format($indicator->numerator_source == 'REM P' ? $indicator->getLastValueByFactor('numerador') : $indicator->getValuesAcum('numerador'), 0, ',', '.')}}</td>
                                @foreach($months as $number => $month)
                                <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('numerador', $number, null, null) != null ? number_format($indicator->getValueByFactorAndMonth2('numerador', $number, null, null), 0, ',', '.') : ''}}</td>
                                @endforeach
                            </tr>
                            <!-- denominador -->
                            <tr class="text-center">
                                <td class="text-left glosa">{{$indicator->denominator}}. <span class="badge badge-secondary">{{ $indicator->getSourceAbbreviated('denominador') }}</span> @if($indicator->getSourceAbbreviated('denominador') != $indicator->denominator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->denominator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                                <td class="text-center">{{number_format($indicator->denominator_source == 'REM P' ? $indicator->getLastValueByFactor('denominador') : $indicator->getValuesAcum('denominador'), 0, ',', '.')}}</td>
                                @foreach($months as $number => $month)                              
                                <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, null, null) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, null, null), 0, ',', '.') : ''}}</td>                           
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- fin print indicador -->
        @endforeach
    @endif
@endif
@php($commune_tab = isset($iaps->communes) && !$iaps->communes->isEmpty() && !array_search("IQUIQUE", $iaps->communes->toArray()) ? "#".str_replace(" ","_",$iaps->communes[0]) : "#IQUIQUE")
@endsection

@section('custom_js')
<script type="text/javascript">
    $('#myTab a[href=@json($commune_tab)]').tab('show') // Select tab by name
</script>
@endsection

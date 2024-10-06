@extends('layouts.bt4.app')
@php
    $months = array (1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
    $Fmonths = array (1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    if(isset($indicator)){ // law 19.813
        $healthGoal = $indicator->indicatorable;
        $communes = array('ALTO HOSPICIO', 'CAMIÑA', 'COLCHANE', 'HUARA', 'IQUIQUE', 'PICA', 'POZO ALMONTE');
        $goals = array_map('trim', explode(',', $indicator->goal)); //metas ordenadas por comuna index
    }
@endphp
@section('title', 'Metas Sanitarias Ley N° ' . $healthGoal->law . ' / '. $healthGoal->year . ' : ' . (isset($indicator) ? 'Meta N° ' . $healthGoal->number . ' - Indicador N° ' . $indicator->number : $healthGoal->name))

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('indicators.index') }}">Indicadores</a></li>
        <li class="breadcrumb-item"><a href="{{ route('indicators.health_goals.index', $healthGoal->law) }}">Ley {{number_format($healthGoal->law,0,',','.')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('indicators.health_goals.list', [$healthGoal->law, $healthGoal->year]) }}">{{$healthGoal->year}}</a></li>
        <li class="breadcrumb-item">{{$healthGoal->name}} @if(isset($indicator)) - Indicador N° {{$indicator->number}} @endif</li>
    </ol>
</nav>

<style>
    .glosa {
        width: 400px;
    }
</style>

@if(isset($indicator)) <!-- ley  19.813 -->
<h3 class="mb-3">{{$indicator->name}}.</h3>

<!-- Nav tabs -->
<ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
    @foreach($communes as $commune)
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true"
            href="#{{ str_replace(" ","_",$commune) }}">{{$commune}}
        </a>
    </li>
    @endforeach
</ul>

@if(($indicator->number != 7 && in_array($healthGoal->year, ["2022", "2023"])) || ($indicator->number != 8 && in_array($healthGoal->year, ["2024"])))
<!-- Tab panes -->
<div class="tab-content mt-3">
    @foreach($communes as $index => $commune)
    <div class="tab-pane" id="{{ str_replace(" ","_",$commune) }}" role="tabpanel" >
        <h4>{{ $commune }}</h4>
        <!-- print indicador law 19.813 -->
        <div class="table-responsive">
            <table class="table table-sm table-bordered small mb-4">
                <thead>
                    <tr class="text-center">
                        <th class="label">Indicador</th>
                        <th>Meta</th>
                        <th>% Cump.</th>
                        <th>Acum</th>
                        @if(in_array($indicator->id, [76,341,761,769]))
                        <th>Oct '{{substr($healthGoal->year-1, -2)}}</th>
                        <th>Nov '{{substr($healthGoal->year-1, -2)}}</th>
                        <th>Dic '{{substr($healthGoal->year-1, -2)}}</th>
                        @endif
                        @foreach($months as $number => $month)
                        <th class="{{ $indicator->currentMonth == $number ? 'table-secondary' : '' }}">{{$month}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                <!-- numerador comuna -->
                    <tr class="text-center">
                        @php($result = $indicator->getSourceAbbreviated('numerador'))
                        <td class="text-left glosa">{{$indicator->numerator}}. <span class="badge badge-secondary">{{ $result }}</span> @if($result != $indicator->numerator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->numerator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                        <td rowspan="2" class="text-center align-middle">{{$goals[$index] ?? ''}}</td>
                        <td rowspan="2" class="text-center align-middle">{{number_format($indicator->getCompliance2($commune, null), 2, ',', '.')}}%</td>
                        <td class="text-center">{{number_format(isset($indicator->isNumRemP) ? $indicator->getLastValueByFactor2('numerador', $commune, null) : $indicator->getValuesAcum2('numerador', $commune, null), 0, ',', '.')}}</td>
                        @if(in_array($indicator->id, [76,341,761,769]))
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        @endif
                        @foreach($months as $number => $month)
                        <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('numerador', $number, $commune, null) != null ? number_format($indicator->getValueByFactorAndMonth2('numerador', $number, $commune, null), 0, ',', '.') : ($indicator->currentMonth >= $number ? 0 : '')}}</td>
                        @endforeach
                    </tr>
                <!-- denominador comuna -->
                    <tr class="text-center">
                        <td class="text-left glosa">{{$indicator->denominator}}.
                          <span class="badge badge-{{ !in_array($commune, ['HUARA', 'CAMIÑA', 'COLCHANE']) && $indicator->denominator_source == 'FONASA.' ? 'light' : 'secondary' }}">
                            @if(in_array($commune, ['HUARA', 'CAMIÑA', 'COLCHANE']) && Str::contains($indicator->denominator_source,'FONASA'))
                              Población INE
                            @else
                            {{ $indicator->getSourceAbbreviated('denominador') }}
                            @endif
                          </span>
                          @if($indicator->getSourceAbbreviated('denominador') != $indicator->denominator_source)
                            <span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->denominator_source}}">
                              <span class="fa fa-info"></span>
                            </span>
                          @endif
                        </td>
                        <td class="text-center">{{number_format(isset($indicator->isDenRemP) ? $indicator->getLastValueByFactor2('denominador', $commune, null) : $indicator->getValuesAcum2('denominador', $commune, null), 0, ',', '.')}}</td>
                        @if(in_array($indicator->id, [76,341,761,769]))
                        @foreach([10,11,12] as $number)
                        <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, $commune, null) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, $commune, null), 0, ',', '.') : 0}}</td>
                        @endforeach
                        @endif
                        @foreach($months as $number => $month)
                        @if(in_array($indicator->id, [76,341,761,769]) && in_array($number, [10,11,12]))
                        <td class="text-right"></td>
                        @else
                        <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, $commune, null) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, $commune, null), 0, ',', '.') : ($indicator->currentMonth >= $number ? 0 : '')}}</td>
                        @endif
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5 mb-4">
            @foreach($indicator->establishments as $establishment)
                @if($establishment->comuna == $commune)
                <strong> {{ $establishment->alias_estab }} </strong>
                <table class="table table-sm table-bordered small mb-4">
                    <thead>
                        <tr class="text-center">
                            <th class="label">Indicador</th>
                            <th>Meta</th>
                            <th>% Cump.</th>
                            <th>Acum</th>
                            @if(in_array($indicator->id, [76,341,761,769]))
                            <th>Oct '{{substr($healthGoal->year-1, -2)}}</th>
                            <th>Nov '{{substr($healthGoal->year-1, -2)}}</th>
                            <th>Dic '{{substr($healthGoal->year-1, -2)}}</th>
                            @endif
                            @foreach($months as $number => $month)
                            <th class="{{ $indicator->currentMonth == $number ? 'table-secondary' : '' }}">{{$month}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    <!-- numerador establecimiento -->
                        <tr class="text-center">
                            <td class="text-left glosa">{{$indicator->numerator}}. <span class="badge badge-secondary">{{ $indicator->getSourceAbbreviated('numerador') }}</span> @if($indicator->getSourceAbbreviated('numerador') != $indicator->numerator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->numerator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                            <td rowspan="2" class="text-center align-middle">{{$goals[$index] ?? ''}}</td>
                            <td rowspan="2" class="text-center align-middle">{{number_format($indicator->getCompliance2(null, $establishment->alias_estab), 2, ',', '.')}}%</td>
                            <td class="text-center">{{number_format(isset($indicator->isNumRemP) ? $indicator->getLastValueByFactor2('numerador', null, $establishment->alias_estab) : $indicator->getValuesAcum2('numerador', null, $establishment->alias_estab), 0, ',', '.')}}</td>
                            @if(in_array($indicator->id, [76,341,761,769]))
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            @endif
                            @foreach($months as $number => $month)
                            <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('numerador', $number, null, $establishment->alias_estab) != null ? number_format($indicator->getValueByFactorAndMonth2('numerador', $number, null, $establishment->alias_estab), 0, ',', '.') : ($indicator->currentMonth >= $number ? 0 : '')}}</td>
                            @endforeach
                        </tr>
                    <!-- denominador establecimiento -->
                        <tr class="text-center">
                            <td class="text-left glosa">{{$indicator->denominator}}.
                              <span class="badge badge-{{ !in_array($commune, ['HUARA', 'CAMIÑA', 'COLCHANE']) && $indicator->denominator_source == 'FONASA.' ? 'light' : 'secondary' }}">
                                @if(($commune == 'HUARA' || $commune == 'CAMIÑA' || $commune == 'COLCHANE') && Str::contains($indicator->denominator_source,'FONASA'))
                                  Población INE
                                @else
                                {{ $indicator->getSourceAbbreviated('denominador') }}
                                @endif
                              </span> @if($indicator->getSourceAbbreviated('denominador') != $indicator->denominator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->denominator_source}}"><span class="fa fa-info"></span></span>@endif</span></td>
                            <td class="text-center">{{number_format(isset($indicator->isDenRemP) ? $indicator->getLastValueByFactor2('denominador', null, $establishment->alias_estab) : $indicator->getValuesAcum2('denominador', null, $establishment->alias_estab), 0, ',', '.')}}</td>
                            @if(in_array($indicator->id, [76,341,761,769]))
                            @foreach([10,11,12] as $number)
                            <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, null, $establishment->alias_estab) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, null, $establishment->alias_estab), 0, ',', '.') : 0}}</td>
                            @endforeach
                            @endif
                            @foreach($months as $number => $month)
                            @if(in_array($indicator->id, [76,341,761,769]) && in_array($number, [10,11,12]))
                            <td class="text-right"></td>
                            @else
                            <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, null, $establishment->alias_estab) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, null, $establishment->alias_estab), 0, ',', '.') : ($indicator->currentMonth >= $number ? 0 : '')}}</td>
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                @endif
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@else
<!-- Meta 7 -->
@php($isManager = auth()->user() && auth()->user()->can('Indicators: manager meta7'))
<!-- Tab panes -->
<div class="tab-content mt-3">
    @foreach($communes as $index => $commune)
    <div class="tab-pane" id="{{ str_replace(" ","_",$commune) }}" role="tabpanel" >
        <h4>{{ $commune }} </h4>
        <!-- print indicador law 19.813 -->
        <div class="table-responsive">
            <table class="table table-sm table-bordered small mb-4">
                <thead>
                    <tr class="text-center">
                        <th class="label">Indicador</th>
                        <th>Meta</th>
                        <th>% Cump.</th>
                        <th>Acum</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- numerador comuna -->
                    <tr class="text-center">
                        <td class="text-left glosa">Total de actividades ejecutadas</td>
                        <td rowspan="2" class="text-center align-middle">{{$goals[$index] ?? ''}}</td>
                        <td rowspan="2" class="text-center align-middle">{{number_format($indicator->getCompliance2($commune, null), 2, ',', '.')}}%</td>
                        <td class="text-center">{{number_format($indicator->getValuesAcum2('numerador', $commune, null), 0, ',', '.')}}</td>
                    </tr>
                    <!-- denominador comuna -->
                    <tr class="text-center">
                        <td class="text-left glosa">Total de actividades programadas</td>
                        <td class="text-center">{{number_format($indicator->getValuesAcum2('denominador', $commune, null), 0, ',', '.')}}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5 mb-4">
            @if($isManager)
            <form method="POST" class="form-inline" action="{{ route('indicators.health_goals.ind.import', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="commune" value="{{$commune}}">
            @if(in_array($commune, ['IQUIQUE', 'ALTO HOSPICIO']))
            <div class="form-group">
                <select class="form-control form-control-sm mb-2 mr-sm-2" name="establishment" required>
                    <option value="">Seleccione establecimiento...</option>
                @foreach($indicator->establishments as $establishment)
                    @if($establishment->comuna == $commune)
                    <option value="{{$establishment->alias_estab}}">{{$establishment->alias_estab}}</option>
                    @endif
                @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label class="sr-only" for="importFile">Example file input</label>
                <input type="file" name="file" class="form-control-file form-control-sm mb-2 mr-sm-2" id="importFile" accept=".xlsx, .xls, .csv" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2 btn-sm"><i class="fas fa-save" aria-hidden="true"></i> Importar actividades programadas</button>
            </form>
            <br>
            <form method="POST" class="form-inline" action="{{ route('indicators.health_goals.ind.saveFile', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="commune" value="{{$commune}}">
            @if(in_array($commune, ['IQUIQUE', 'ALTO HOSPICIO']))
            <div class="form-group">
                <select class="form-control form-control-sm mb-2 mr-sm-2" name="establishment" required>
                    <option value="">Seleccione establecimiento...</option>
                @foreach($indicator->establishments as $establishment)
                    @if($establishment->comuna == $commune)
                    <option value="{{$establishment->alias_estab}}">{{$establishment->alias_estab}}</option>
                    @endif
                @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <select class="form-control form-control-sm mb-2 mr-sm-2" name="section" required>
                    <option value="">Seleccione corte...</option>
                    <option value="1">Primer corte</option>
                    <option value="2">Segundo corte</option>
                    <option value="3">Tercer corte</option>
                    <option value="4">Cuarto corte</option>
                </select>
            </div>
            <div class="form-group">
                <label class="sr-only" for="saveFile">Example file input</label>
                <input type="file" name="file" class="form-control-file form-control-sm mb-2 mr-sm-2" id="saveFile" accept=".pdf, .doc, .docx" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2 btn-sm"><i class="fas fa-save" aria-hidden="true"></i> Guardar archivo al corte</button>
            </form>
            @endif
            <br>
            @php($values = $indicator->getValuesBy($commune, null))
            @if(!in_array($commune, ['IQUIQUE', 'ALTO HOSPICIO']))
                @if(!$values)
                <p class="text-center">No se han registrado actividades programadas.</p>
                @else
                <!-- archivos por corte -->
                <div class="float-right">
                    @php($ends = [1 => '1er', 2 => '2o', 3 => '3er', 4 => '4o'])
                    @foreach($indicator->getAttachedFilesBy($commune, null) as $attachedFile)
                    <a href="{{ route('indicators.health_goals.ind.show_file', $attachedFile) }}" target="_blank" class="badge badge-pill badge-primary"><i class="fas fa-file"></i> {{$ends[$attachedFile->section]}} corte</a>
                    @endforeach
                </div>
                <!-- detalle actividades por comuna -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered small mb-4 table-hover">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">#</th>
                                <th rowspan="2" class="label">Actividad</th>
                                <th rowspan="2" class="label">Total programadas</th>
                                <th rowspan="2" class="label">Total Cump.</th>
                                <th rowspan="2" class="label">% Cump.</th>
                                <th colspan="12">Frecuencia</th>
                            </tr>
                            <tr class="text-center">
                                @foreach($months as $month)
                                <th>{{$month}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @php($key = 1)
                        @forelse($values as $value)
                            <tr class="text-center">
                                <td class="text-left glosa align-middle" style="width:20px;">{{$key}}</td>
                                <td class="text-left glosa align-middle">{{$value->activity_name}}.</td>
                                @php($result = $indicator->getValuesAcumByActivityName('numerador', $value->activity_name, $commune, null))
                                <td class="align-middle">{{$value->value}}</td>
                                <td class="align-middle">{{$result}}</td>
                                <td class="align-middle">{{number_format($result != 0 ? $result/$value->value * 100 : 0, 1, ',', '.')}}%</td>
                                @foreach($months as $number => $month)
                                <td class="align-middle">
                                @php($result = $indicator->getValueByActivityNameAndMonth('numerador', $value->activity_name, $number, $commune, null))
                                    <!-- Button trigger modal -->
                                    <button class="btn btb-sm btn-link" data-toggle="modal" id="btn_{{$value->id}}-{{$number}}" data-target="#registerActivity{{$value->id}}-{{$number}}">
                                        @if($result && $result->value == 1)
                                            <i class="fas fa-circle text-success"></i>
                                        @else
                                            @if($isManager)
                                            <i class="fas fa-circle text-secondary"></i>
                                            @endif
                                        @endif
                                    </button>
                                    <!-- modal -->
                                    <div class="modal fade" id="registerActivity{{$value->id}}-{{$number}}" tabindex="-1" role="dialog" aria-labelledby="registerActivityLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerActivityLabel">Actividad #{{$key}} - {{$Fmonths[$number]}} {{$healthGoal->year}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                
                                                <form method="post" id="form-edit{{$value->id}}-{{$number}}" action="{{ $result ? route('indicators.health_goals.ind.value.update', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator->id, $result->id]) : route('indicators.health_goals.ind.value.store', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator->id, $value->id]) }}" enctype="multipart/form-data">
                                                    {{ method_field($result ? 'PUT' : 'POST') }} {{ csrf_field() }}
                                                </form>
                                                    <div class="modal-body">
                                                        <input type="hidden" class="form-control" name="month" form="form-edit{{$value->id}}-{{$number}}" value="{{$number}}">

                                                        <div class="form-row">
                                                            <fieldset class="form-group custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$value->id}}-{{$number}}" name="value" form="form-edit{{$value->id}}-{{$number}}" @if($result && $result->value == 1) checked @endif @if(!$isManager) disabled @endif>
                                                            <label class="custom-control-label" for="customSwitch{{$value->id}}-{{$number}}">Actividad ejecutada</label>
                                                            </fieldset>
                                                        </div>
                                                        @if($isManager)
                                                        <div class="form-row">
                                                            <fieldset class="form-group">
                                                                <label for="for_attachedFile" style="float: left">Cargar documento(s):</label>
                                                                <input class="form-control-file form-control-sm" id="for_attachedFile" type="file" style="padding:2px 0px 0px 2px;" name="files[]" form="form-edit{{$value->id}}-{{$number}}" multiple>
                                                            </fieldset>
                                                        </div>
                                                        @endif
                                                        @if($result)
                                                        <hr>
                                                        <div class="form-row">
                                                            <fieldset class="form-group col-sm">
                                                                <label>Documentos adjuntos:</label>
                                                                    <ul class="list-group">
                                                                    @foreach($result->attachedFiles as $file)
                                                                        <li class="list-group-item py-2">
                                                                            <div style="float: left">{{ $file->document_name }}</div>
                                                                            <a href="{{ route('indicators.health_goals.ind.show_file', $file) }}"
                                                                                class="btn btn-link btn-sm float-right" title="Ver" target="_blank"><i class="far fa-eye"></i></a>
                                                                            @if($isManager)
                                                                            <form method="POST" id="form-delete{{$file}}" class="form-horizontal" action="{{ route('indicators.health_goals.ind.value.destroy_file', $file) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" form="form-delete{{$file}}" onclick="return confirm('¿Está seguro de eliminar archivo con nombre {{$file->document_name}}?')" class="btn btn-link btn-sm float-right" title="Eliminar"><i class="far fa-trash-alt" style="color:red"></i></button>
                                                                            </form>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                    </ul>
                                                            </fieldset>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        @if($isManager)<button type="submit" class="btn btn-primary" form="form-edit{{$value->id}}-{{$number}}">Guardar</button>@endif
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @php($key++)
                        @empty
                        <tr>
                            <td colspan="100%" class="text-center">No se han registrado actividades programadas.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            @else
                @if(!$values)
                <p class="text-center">No se han registrado actividades programadas.</p>
                @else
                <!-- detalle actividades por establecimiento -->
                @foreach($indicator->establishments as $establishment)
                    @php($values = $indicator->getValuesBy($commune, $establishment->alias_estab))
                    @if($establishment->comuna == $commune && $values)
                    <strong id="{{str_replace(' ','_',$establishment->alias_estab)}}"> {{ $establishment->alias_estab }} </strong>
                    <!-- archivos por corte -->
                    <div class="float-right">
                        @php($ends = [1 => '1er', 2 => '2o', 3 => '3er', 4 => '4o'])
                        @foreach($indicator->getAttachedFilesBy($commune, $establishment->alias_estab) as $attachedFile)
                        <a href="{{ route('indicators.health_goals.ind.show_file', $attachedFile) }}" target="_blank" class="badge badge-pill badge-primary"><i class="fas fa-file"></i> {{$ends[$attachedFile->section]}} corte</a>
                        @endforeach
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered small mb-4 table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2" class="label">Actividad</th>
                                    <th rowspan="2" class="label">Total programadas</th>
                                    <th rowspan="2" class="label">Total Cump.</th>
                                    <th rowspan="2" class="label">% Cump.</th>
                                    <th colspan="12">Frecuencia</th>
                                </tr>
                                <tr class="text-center">
                                    @foreach($months as $month)
                                    <th>{{$month}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @php($key = 1)
                            @forelse($values as $value)
                                <tr class="text-center">
                                    <td class="text-left glosa align-middle" style="width:20px;">{{$key}}</td>
                                    <td class="text-left glosa align-middle">{{$value->activity_name}}.</td>
                                    @php($result = $indicator->getValuesAcumByActivityName('numerador', $value->activity_name, $commune, $establishment->alias_estab))
                                    <td class="align-middle">{{$value->value}}</td>
                                    <td class="align-middle">{{$result}}</td>
                                    <td class="align-middle">{{number_format($result != 0 ? $result/$value->value * 100 : 0, 1, ',', '.')}}%</td>
                                    @foreach($months as $number => $month)
                                    <td class="align-middle">
                                    @php($result = $indicator->getValueByActivityNameAndMonth('numerador', $value->activity_name, $number, $commune, $establishment->alias_estab))
                                        <!-- Button trigger modal -->
                                        <button class="btn btb-sm btn-link" data-toggle="modal" id="btn_{{$value->id}}-{{$number}}" data-target="#registerActivity{{$value->id}}-{{$number}}">
                                            @if($result && $result->value == 1)
                                                <i class="fas fa-circle text-success"></i>
                                            @else
                                                @if($isManager)
                                                <i class="fas fa-circle text-secondary"></i>
                                                @endif
                                            @endif
                                        </button>
                                        <!-- modal -->
                                        <div class="modal fade" id="registerActivity{{$value->id}}-{{$number}}" tabindex="-1" role="dialog" aria-labelledby="registerActivityLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="registerActivityLabel">Actividad #{{$key}} - {{$Fmonths[$number]}} {{$healthGoal->year}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    
                                                    <form method="post" id="form-edit{{$value->id}}-{{$number}}" action="{{ $result ? route('indicators.health_goals.ind.value.update', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator->id, $result->id]) : route('indicators.health_goals.ind.value.store', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator->id, $value->id]) }}" enctype="multipart/form-data">
                                                        {{ method_field($result ? 'PUT' : 'POST') }} {{ csrf_field() }}
                                                    </form>
                                                        <div class="modal-body">
                                                            <input type="hidden" class="form-control" name="month" form="form-edit{{$value->id}}-{{$number}}" value="{{$number}}">

                                                            <div class="form-row">
                                                                <fieldset class="form-group custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch{{$value->id}}-{{$number}}" name="value" form="form-edit{{$value->id}}-{{$number}}" @if($result && $result->value == 1) checked @endif @if(!$isManager) disabled @endif>
                                                                <label class="custom-control-label" for="customSwitch{{$value->id}}-{{$number}}">Actividad ejecutada</label>
                                                                </fieldset>
                                                            </div>
                                                            @if($isManager)
                                                            <div class="form-row">
                                                                <fieldset class="form-group">
                                                                    <label for="for_attachedFile" style="float: left">Cargar documento(s):</label>
                                                                    <input class="form-control-file form-control-sm" id="for_attachedFile" type="file" style="padding:2px 0px 0px 2px;" name="files[]" form="form-edit{{$value->id}}-{{$number}}" multiple>
                                                                </fieldset>
                                                            </div>
                                                            @endif
                                                            @if($result)
                                                            <hr>
                                                            <div class="form-row">
                                                                <fieldset class="form-group col-sm">
                                                                    <label>Documentos adjuntos:</label>
                                                                        <ul class="list-group">
                                                                        @foreach($result->attachedFiles as $file)
                                                                            <li class="list-group-item py-2">
                                                                                <div style="float: left">{{ $file->document_name }}</div>
                                                                                <a href="{{ route('indicators.health_goals.ind.show_file', $file) }}"
                                                                                    class="btn btn-link btn-sm float-right" title="Ver" target="_blank"><i class="far fa-eye"></i></a>
                                                                                @if($isManager)
                                                                                <form method="POST" id="form-delete{{$file}}" class="form-horizontal" action="{{ route('indicators.health_goals.ind.value.destroy_file', $file) }}">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" form="form-delete{{$file}}" onclick="return confirm('¿Está seguro de eliminar archivo con nombre {{$file->document_name}}?')" class="btn btn-link btn-sm float-right" title="Eliminar"><i class="far fa-trash-alt" style="color:red"></i></button>
                                                                                </form>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                        </ul>
                                                                </fieldset>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if($isManager)<button type="submit" class="btn btn-primary" form="form-edit{{$value->id}}-{{$number}}">Guardar</button>@endif
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                                @php($key++)
                            @empty
                            <tr>
                                <td colspan="100%" class="text-center">No se han registrado actividades programadas.</td>
                            </tr>
                            @endforelse
                            </tbody>
                            @if($values)
                            <tfoot style="font-weight:bold">
                                <tr>
                                    <td></td>
                                    <td class="text-right">TOTAL</td>
                                    <td class="text-center">{{number_format($indicator->getValuesAcum2('denominador', $commune, $establishment->alias_estab), 0, ',', '.')}}</td>
                                    <td class="text-center">{{number_format($indicator->getValuesAcum2('numerador', $commune, $establishment->alias_estab), 0, ',', '.')}}</td>
                                    <td class="text-center">{{number_format($indicator->getCompliance2($commune, $establishment->alias_estab), 1, ',', '.')}}%</td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                    @endif
                @endforeach
                @endif
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif
<!-- fin print indicador -->
@else <!-- ley 18.834 o ley 19.664 -->
    <h3 class="mb-3">{{$healthGoal->name}}. <small>- Cumplimiento : {{number_format($healthGoal->getCompliance(), 2, ',', '.')}}%</small></h3>
    <h6 class="mb-3">Metas Sanitarias Ley N° {{number_format($healthGoal->law,0,',','.')}}</h6>
    <hr>
    @if($healthGoal->indicators->isEmpty())
        <p>No existen indicadores o no se han definido aún para la meta sanitaria actual.</p>
    @else
        @foreach($healthGoal->indicators as $indicator)
            <h5 class="mb-3">{{$indicator->number}}. {{$indicator->name}}. @can('Indicators: manager')<small><a href="{{route('indicators.health_goals.ind.edit', [$healthGoal->law, $healthGoal->year, $healthGoal->number, $indicator])}}"><span class="fa fa-edit"></span></a></small> @endcan</h5>
            <!-- print indicador -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered small mb-4">
                        <thead>
                            <tr class="text-center">
                                <th class="label">Indicador</th>
                                <th>Meta</th>
                                <th>Pond.</th>
                                <th>% Cump.</th>
                                @if(isset($indicator->numerator_acum_last_year))
                                <th>Dic {{$healthGoal->year - 1}}</th>
                                @endif
                                <th>Acum</th>
                                @foreach($months as $month)
                                <th>{{$month}}</th>
                                @endforeach
                            </tr>
                        </thead>
                            <tbody>
                            <!-- numerador -->
                            <tr class="text-center">
                                @php($result = $indicator->getSourceAbbreviated('numerador'))
                                <td class="text-left glosa">{{$indicator->numerator}}. <span class="badge badge-secondary">{{ $result }}</span> @if($result != $indicator->numerator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->numerator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                                <td rowspan="2" class="text-center align-middle">{{$indicator->goal}}</td>
                                <td rowspan="2" class="text-center align-middle">{{$indicator->weighting}}%</td>
                                <td rowspan="2" class="text-center align-middle">{{number_format($indicator->getCompliance(), 2, ',', '.')}}{{Str::contains($indicator->goal, 'días') ? '' : '%'}} <br> <small>Aporte: {{number_format($indicator->getContribution(), 2, ',', '.')}}%</small></td>
                                @if(isset($indicator->numerator_acum_last_year))
                                <td class="text-right">{{number_format($indicator->numerator_acum_last_year, 0, ',', '.')}}</td>
                                @endif
                                <td class="text-center">{{number_format(isset($indicator->numerator_acum_last_year) ? $indicator->getLastValueByFactor('numerador') : $indicator->getValuesAcum('numerador'), 0, ',', '.')}}</td>
                                @if(in_array($indicator->numerator_source, ['Programación anual','Reporte RRHH']))
                                    <td colspan="12" class="text-center">{{ $indicator->getLastValueByFactor('numerador') != null ? number_format($indicator->getLastValueByFactor('numerador'), 0, ',', '.') : '' }}</td>
                                @else
                                    @foreach($months as $number => $month)
                                    <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('numerador', $number, null, null) != null ? number_format($indicator->getValueByFactorAndMonth2('numerador', $number, null, null), 0, ',', '.') : ''}}</td>
                                    @endforeach
                                @endif
                            </tr>
                            <!-- denominador -->
                            @if($indicator->denominator)
                            <tr class="text-center">
                                 @php($result = $indicator->getSourceAbbreviated('denominador'))
                                <td class="text-left glosa">{{$indicator->denominator}}. <span class="badge badge-secondary">{{ $result }}</span> @if($result != $indicator->denominator_source)<span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="bottom" title="{{$indicator->denominator_source}}"><span class="fa fa-info"></span></span>@endif</td>
                                @if(isset($indicator->denominator_acum_last_year))
                                <td class="text-right">{{number_format($indicator->denominator_acum_last_year, 0, ',', '.')}}</td>
                                @endif
                                <td class="text-center">{{number_format(isset($indicator->denominator_acum_last_year) ? $indicator->getLastValueByFactor('denominador') : $indicator->getValuesAcum('denominador'), 0, ',', '.')}}</td>
                                @if(in_array($indicator->denominator_source, ['Programación anual','Reporte RRHH']))
                                    <td colspan="12" class="text-center">{{ $indicator->getLastValueByFactor('denominador') != null ? number_format($indicator->getLastValueByFactor('denominador'), 0, ',', '.') : '' }}</td>
                                @else
                                    @foreach($months as $number => $month)
                                    <td class="text-right">{{ $indicator->getValueByFactorAndMonth2('denominador', $number, null, null) != null ? number_format($indicator->getValueByFactorAndMonth2('denominador', $number, null, null), 0, ',', '.') : ''}}</td>
                                    @endforeach
                                @endif
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            <!-- fin print indicador -->
        @endforeach
    @endif
@endif

@endsection

@section('custom_js')
<script type="text/javascript">
    $('#myTab a[href="{!! session()->has("commune") ? "#".session()->get("commune") : "#IQUIQUE" !!}"]').tab('show') // Select tab by name

    var hasEstablishment = {!! session()->has("establishment") ? 'true' : 'false' !!};
    if (hasEstablishment) {
        $('html,body').animate({
            scrollTop: $('#{!! session()->get("establishment") !!}').offset().top
        }, 'fast');
    }

    $('[data-toggle="tooltip"]').tooltip()

    $('input[type="file"]').bind('change', function(e) {
    //Validación de tamaño
    if((this.files[0].size / 1024 / 1024) > 5){
        alert('No puede cargar archivos de más de 5 MB.');
        $(this).val('');
    }
    //Validación de .xlsx, .xls, .csv
    const allowedExtensions = ["xlsx", "xls", "csv"];
    if( (this).id == 'importFile' && !allowedExtensions.includes(this.files[0]?.name.split('.').pop())){
        alert("Debe seleccionar un archivo con extensión xlsx, xls o csv.");
        $(this).val('');
    }
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).text().trim() // activated tab
        $('input[name="commune"]').val(target);
    });

    // $('#updateModalRect').on('show.bs.modal', function (event) {
    //     console.log("en modal");

    //     var button = $(event.relatedTarget) // Button that triggered the modal
    //     var modal  = $(this)

    //     modal.find('input[name="programming_id"]').val(button.data('programming_id'))
    //     modal.find('select[name="status"]').val(button.data('status'))

    //     var formaction  = button.data('formaction')
    //     modal.find("#form-edit").attr('action', formaction)
    // })
</script>
@endsection

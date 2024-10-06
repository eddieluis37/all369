@extends('layouts.bt4.app')

@section('title', 'Lista de Profesionales')

@section('content')

@include('programmings/nav')

@if(auth()->user()->can('TrainingItem: edit') && $programming_status == 'active')
<a href="{{ route('trainingitems.create',['commune_file_id' => Request::get('commune_file_id')]) }}" class="btn btn-info mb-4 float-right btn-sm">Agregar Item</a>
@endif
<h4 class="mb-3"> Capacitaciones Municipales {{$trainingItems->first()->communeFile->year ?? ''}} - {{$trainingItems->first()->communeFile->commune->name ?? ''}}</h4>

<button onclick="tableExcel('xlsx')" class="btn btn-success mb-4 float-left btn-sm">Excel</button>

<table id="tblData" class="table table-striped  table-sm table-bordered table-condensed fixed_headers table-hover  ">
    <thead>
        <tr style="font-size:60%;">
            <th class="text-center align-middle table-dark" colspan="18">PROGRAMA  ANUAL DE CAPACITACION  PERSONAL ESTATUTO ATENCIÓN PRIMARIA (LEY 19.378) SERVCIO DE SALUD TARAPACÁ   </th>
        </tr>
        <tr style="font-size:60%;">
            <th class="text-center align-middle" rowspan="2">LINEAMIENTOS ESTRATEGICOS</th>
            <th class="text-center align-middle" rowspan="2">ACTIVIDADES DE CAPACITACION (TEMAS)</th>
            <th class="text-center align-middle" rowspan="2">OBJETIVOS EDUCATIVOS</th>
            <th class="text-center align-middle" colspan="7">NUMERO DE PARTICIPANTES POR CATEGORIA</th>
            <th class="text-center align-middle" rowspan="2">NUMERO DE HORAS PEDAGOGICAS </th>
            <th class="text-center align-middle" colspan="4">FINANCIAMIENTO</th>
            <th class="text-center align-middle" rowspan="2">ORGANISMO EJECUTOR</th>
            <th class="text-center align-middle" rowspan="2">COORDINADOR</th>
            <th class="text-center align-middle" rowspan="2">FECHA DE EJECUCIÓN</th>
            @if(auth()->user()->can('TrainingItem: edit') && $programming_status == 'active')<th class="text-center align-middle" rowspan="2">EDITAR</th> @endif
            @if(auth()->user()->can('TrainingItem: delete') && $programming_status == 'active')<th class="text-center align-middle" rowspan="2">ELIMINAR</th> @endif
        </tr>
        <tr style="font-size:45%;">
            <th class="text-center align-middle">A (Médicos, Odont, QF,etc.)</th>
            <th class="text-center align-middle">B (Otros Profesio-nales)</th>
            <th class="text-center align-middle">C (Técnicos Nivel Superior) </th>
            <th class="text-center align-middle">D (Técnicos de Salud)</th>
            <th class="text-center align-middle">E (Adminis-trativos Salud)</th>
            <th class="text-center align-middle">F (Auxiliares servicios Salud)</th>
            <th class="text-center align-middle">TOTAL</th>
            <th class="text-center align-middle">ITEM CAPACITACION</th>
            <th class="text-center align-middle">FONDOS MUNICIPALES (SI-NO)</th>
            <th class="text-center align-middle">OTROS FONDOS (ESPECIFICAR CUALES)</th>
            <th class="text-center align-middle">TOTAL PRESUPUESTO ESTIMADO </th>
        </tr>
    </thead>
    <tbody style="font-size:60%;">
        @php($lineamiento_temp = null)
        @foreach($trainingItems as $trainingItem)
        <tr class="small">
            @if($trainingItem->linieamiento_estrategico != $lineamiento_temp)
            <td class="text-center" rowspan="{{$trainingItems->where('linieamiento_estrategico', $trainingItem->linieamiento_estrategico)->count()}}"><strong>{{ $trainingItem->linieamiento_estrategico}}</strong></td>
            @php($lineamiento_temp = $trainingItem->linieamiento_estrategico)
            @endif
            <td class="text-center align-middle">{{ $trainingItem->temas }}</td>
            <td class="text-center align-middle">{{ $trainingItem->objetivos_educativos }}</td>
            <td class="text-center align-middle">{{ $trainingItem->med_odont_qf }}</td>
            <td class="text-center align-middle">{{ $trainingItem->otros_profesionales }}</td>
            <td class="text-center align-middle">{{ $trainingItem->tec_nivel_superior }}</td>
            <td class="text-center align-middle">{{ $trainingItem->tec_salud }}</td>
            <td class="text-center align-middle">{{ $trainingItem->administrativo_salud }}</td>
            <td class="text-center align-middle">{{ $trainingItem->auxiliares_salud }}</td>
            <td class="text-center align-middle">{{ $trainingItem->total }}</td>
            <td class="text-center align-middle">{{ $trainingItem->num_hr_pedagodicas }}</td>
            <td class="text-center align-middle">{{ $trainingItem->item_cap }}</td>
            <td class="text-center align-middle">{{ $trainingItem->fondo_muni }}</td>
            <td class="text-center align-middle">{{ $trainingItem->otro_fondo }}</td>
            <td class="text-center align-middle">{{ number_format($trainingItem->total_presupuesto_est, 0, ',', '.') }}</td>
            <td class="text-center align-middle">{{ $trainingItem->org_ejecutor }}</td>
            <td class="text-center align-middle">{{ $trainingItem->coordinador }}</td>
            <td class="text-center align-middle">{{ $trainingItem->fecha_ejecucion }}</td>

            @if(auth()->user()->can('TrainingItem: edit') && $programming_status == 'active')
                <td class="text-center align-middle"><a href="{{ route('trainingitems.show', $trainingItem->id) }}" class="btn btb-sm btn-light small" >
                    <span class="fas fa-edit" aria-hidden="true"></span></a>
                </td>
            @endif
            @if(auth()->user()->can('TrainingItem: delete') && $programming_status == 'active')
            <td class="text-center align-middle">
                <form method="POST" action="{{ route('trainingitems.destroy', $trainingItem->id) }}" class="small d-inline">
                    {{ method_field('DELETE') }} {{ csrf_field() }}
                    <button class="btn btn-sm btn-outline-danger small" onclick="return confirm('¿Desea eliminar el registro realmente?')">
                    <span class="fas fa-trash-alt " aria-hidden="true"></span>
                    </button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-size:60%;">
            <td class="text-center" colspan="3">TOTALES</td>
            <td  class="text-center">{{ $trainingItems->sum('med_odont_qf') ? $trainingItems->sum('med_odont_qf') : '0' }}</td>
            <td  class="text-center">{{ $trainingItems->sum('otros_profesionales') ? $trainingItems->sum('otros_profesionales') : '0'  }}</td>
            <td  class="text-center">{{ $trainingItems->sum('tec_nivel_superior') ? $trainingItems->sum('tec_nivel_superior') : '0'  }}</td>
            <td  class="text-center">{{ $trainingItems->sum('tec_salud') ? $trainingItems->sum('tec_salud') : '0'  }}</td>
            <td  class="text-center">{{ $trainingItems->sum('administrativo_salud') ? $trainingItems->sum('administrativo_salud') : '0'  }}</td>
            <td  class="text-center">{{ $trainingItems->sum('auxiliares_salud') ? $trainingItems->sum('auxiliares_salud') : '0'  }}</td>
            <td  class="text-center">{{ $trainingItems->sum('total') ? $trainingItems->sum('total') : '0'  }}</td>
            <td class="text-center" colspan="4"></td>
            <td  class="text-center">{{ $trainingItems ? number_format($trainingItems->sum('total_presupuesto_est'), 0, ',', '.') : '0'}}</td>
            <td class="text-center" colspan="3"></td>
        </tr>
    </tfoot>
</table>

@endsection

@section('custom_js')

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>  
<script>





      function tableExcel(type, fn, dl) {
          var elt = document.getElementById('tblData');
          const filename = 'Informe_capacitación'
          var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
          return dl ?
            XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
            XLSX.writeFile(wb, `${filename}.xlsx`)
        }
</script>
@endsection

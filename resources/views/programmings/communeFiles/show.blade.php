@extends('layouts.bt4.app')

@section('title', 'Nuevo convenio')

@section('content')
<a href="{{ route('communefiles.index') }}" class="btn btb-flat btn-sm btn-dark" >
                    <i class="fas fa-arrow-left small"></i> 
                    <span class="small">Volver</span> 
    </a>

<h3 class="mb-3">Actualizar Permisos Documentos Adjuntos Communa {{ $communeFile->commune->name}} {{ $communeFile->year}} </h3>

<form method="POST" class="form-horizontal small" action="{{ route('communefiles.update', $communeFile->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-row ">
        <div class="form-group col-md-6">
            <label for="forprogram">Comuna</label>
            <select name="commune" id="formprogram" class="form-control selectpicker " data-live-search="true" disabled>
                  <option>{{ $communeFile->commune->name}}</option>
                  
            </select>
        </div>
        
        <div class="form-group col-md-6">
            <label for="forprogram">Descripción</label>
            <input type="input" class="form-control" id="forreferente" value="{{ $communeFile->description }}" name="description" required="">
            <small>Ej. Documentos Adjuntos 2021 - Alto Hospicio</small>
        </div>
    </div>

    <div class="form-row">

        <fieldset class="form-group col-2">
            <label for="fordate">Fecha</label>
            <input type="text" class="form-control " id="datepicker" value="{{ $communeFile->year }}" name="date" required="">
        </fieldset>

        <div class="form-group col-md-6">
            <label for="forprogram">Responsable</label>
            <select name="user" id="user" class="form-control "  data-live-search="true" >
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{$user->name}} {{$user->fathers_family}} {{$user->mothers_family}} - {{ $user->position }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="forprogram">Permitir Acceso</label>
            <select name="access[]" id="access" class="form-control selectpicker " data-live-search="true" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{$user->name}} {{$user->fathers_family}} {{$user->mothers_family}}</option>
                @endforeach
            </select>
        </div>

        </div>
    <button type="submit" class="btn btn-info mb-4">Actualizar</button>

</form>



@endsection

@section('custom_js')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<script type="text/javascript">
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    $(function () {
        var jobs =  @json($access_list);
        //console.log(jobs);
        $('select').selectpicker();

        jobs.forEach(function(row) {
         // console.log(row);
            $("#access option").filter(function(){
                return $.trim($(this).val()) ==  row
            }).prop('selected', true);

        });
        $('#access').selectpicker('refresh')


    });

</script>
@endsection

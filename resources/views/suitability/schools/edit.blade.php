@extends('layouts.bt4.app')

@section('title', 'Editar Colegio')

@section('content')

@include('suitability.nav')

<h3 class="mb-3">Editar Colegio</h3>

<form method="POST" class="form-horizontal" action="{{ route('suitability.schools.update', $school) }}">
    @csrf
    @method('PUT')

    <div class="form-row align-items-end">
        <fieldset class="form-group col-6 col-sm-6 col-md-6 col-lg-6">
            <label for="for_name">Nombre*</label>
            <input type="text" class="form-control" id="for_name" name="name" autocomplete="off" value="{{$school->name}}" required>
        </fieldset>

        <fieldset class="form-group col-2 col-sm-2 col-md-1 col-lg-1">
            <label for="for_rbd">RBD*</label>
            <input type="text" class="form-control" id="for_rbd" name="rbd" autocomplete="off" value="{{$school->rbd}}" required>
        </fieldset>
    </div>

    <div class="row">
    <fieldset class="form-group col-8 col-sm-8 col-md-8 col-lg-8">
            <label for="for_holder">Dirección*</label>
            <input type="text" class="form-control" id="for_address" name="address" autocomplete="off" value="{{$school->address}}" required>
        </fieldset>
    </div>
    
    <div class="row">

    <fieldset class="form-group col-8 col-sm-8 col-md-8 col-lg-8">
            <label for="for_holder">Nombre Sostenedor*</label>
            <input type="text" class="form-control" id="for_holder" name="holder" autocomplete="off" value="{{$school->holder}}" required>
        </fieldset>
    </div>



    <div class="row">
        <fieldset class="form-group col-4">
            <label for="for_commune_id">Comuna*</label>
            <select name="commune_id" id="for_commune_id" class="form-control" required>
                <option value="">Seleccionar Comuna</option>
                @foreach($communes as $commune)
                <option value="{{ $commune->id  }}" {{ ($commune->id == $school->commune_id)?'selected':'' }}>{{ $commune->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-4">
            <label>Situación Legal*</label>
            <select class="form-control" name="legal" required>
            <option value="">Seleccionar Situación</option>
            <option value="PARTICULAR SUBVENCIONADO" {{ $school->legal == "PARTICULAR SUBVENCIONADO" ? 'selected' : '' }}>PARTICULAR SUBVENCIONADO</option>
            <option value="PARTICULAR NO SUBVENCIONADO" {{ $school->legal == "PARTICULAR NO SUBVENCIONADO" ? 'selected' : '' }}>PARTICULAR NO SUBVENCIONADO</option>
            <option value="MUNICIPAL CORPORACION" {{ $school->legal == "MUNICIPAL CORPORACION" ? 'selected' : '' }}>MUNICIPAL CORPORACION</option>
            <option value="MUNICIPAL DAEM" {{ $school->legal == "MUNICIPAL DAEM" ? 'selected' : '' }}>MUNICIPAL DAEM</option>
            <option value="ADMINISTRACION DELEGADA" {{ $school->legal == "ADMINISTRACION DELEGADA" ? 'selected' : '' }}>ADMINISTRACION DELEGADA</option>
            </select>
        </fieldset>
    </div>

        <label for="forBrand">Municipal*</label>
        <fieldset class="form-group col-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="municipality" id="RadioType1" value="1" {{ ( $school->municipality== '1' ) ? 'checked="checked"' : null }} required>
                <label class="form-check-label" for="inlineRadio1">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="municipality" id="RadioType2" value="0" required {{ ( $school->municipality== '0' ) ? 'checked="checked"' : null }}>
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </fieldset>
    
        <label for="forBrand">Gratuito*</label>
        <fieldset class="form-group col-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="free" id="RadioType1" value="1" {{ ( $school->free== '1' ) ? 'checked="checked"' : null }} required>
                <label class="form-check-label" for="inlineRadio1">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="free" id="RadioType2" value="0" {{ ( $school->free== '0' ) ? 'checked="checked"' : null }} required>
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </fieldset>
    


    <button type="submit" class="btn btn-primary">Actualizar</button>

</form>

@endsection

@section('custom_js')

@endsection
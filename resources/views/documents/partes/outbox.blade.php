@extends('layouts.bt4.app')

@section('title', 'Bandeja de salida')

@section('content')

@include('documents.partes.partials.nav')

<h3 class="mb-3">Bandeja de salida</h3>

<form method="GET" class="form-horizontal" action="{{ route('documents.partes.outbox') }}">

    <div class="form-row">
        <fieldset class="form-group col-1">
            <label for="for_id">ID</label>
            <input type="text" class="form-control" id="for_id" name="id" autocomplete="off">
        </fieldset>

        <!-- <fieldset class="form-group col-2">
            <label for="for_type">Tipo</label>
            <input type="text" class="form-control" id="for_type" name="type">
        </fieldset> -->

        <fieldset class="form-group col-3">
            <label for="for_subject">Materia</label>
            <input type="text" class="form-control" id="for_subject" name="subject">
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_number">Número</label>
            <input type="text" class="form-control" id="for_number" name="number">
        </fieldset>

        <fieldset>
            <label for="">&nbsp;</label>
            <button type="submit" class="btn btn-primary form-control"><i class="fas fa-search"></i></button>
        </fieldset>

    </div>

</form>

<h3 class="mt-3">Todos los partes</h3>

<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>N°</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Antec</th>
            <th>Responsable</th>
        </tr>
    </thead>
    <tbody>
        @forelse($documents as $document)
        <tr>
            <td rowspan="2">{{ $document->id }}</td>
            <td>{{ $document->number }}</td>
            <td nowrap>{{ $document->date ? $document->date->format('d-m-Y'): '' }}</td>
            <td>{{ optional($document->type)->name }}</td>
            <td>{{ $document->antecedent }}</td>
            <td>{{ $document->responsible }}</td>
            <td nowrap>
                @if($document->file)
                    <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="fas fa-file-pdf fa-lg"></i>
                    </a>
                @else
                    <form method="POST" action="{{ route('documents.find')}}">
                        @csrf
                        <button name="id" value="{{ $document->id }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-upload"></i>
                        </button>
                    </form>
                @endif
            </td>

        </tr>
        <tr>
            <td colspan="7" class="pb-2">{{ $document->subject }}</td>
        </tr>
        @empty
        <tr class="text-center">
            <td colspan="7">
                <em>
                    No hay partes
                </em>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $documents->render() }}

@endsection

@section('custom_js')
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip()
</script>
@endsection

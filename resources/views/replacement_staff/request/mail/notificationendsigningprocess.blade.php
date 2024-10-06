@extends('layouts.mail')

@section('content')

<div style="text-align: justify;">

  <h4>Estimado/a: </h4>

  <br>

  <p>A través del presente, se informa fin del proceso de firmas:</p>

  <ul>
      <li><strong>Nº Solicitud</strong>: {{ $requestReplacementStaff->id }}</li>
      <li><strong>Fecha Solicitud</strong>: {{ $requestReplacementStaff->created_at->format('d-m-Y H:i:s') }}</li>
      <li><strong>Nombre Solicitud</strong>: {{ $requestReplacementStaff->name }}</li>
  </ul>

  <hr>

  <ul>
      <li><strong>Solicitado por</strong>: {{ $requestReplacementStaff->user->FullName }}</li>
      <li><strong>Unidad Organizacional</strong>: {{ $requestReplacementStaff->organizationalUnit->name }}</li>
  </ul>

  <br>

  <p>Esto es un mensaje automatico de: {{ env('APP_NAME') }} -  {{ env('APP_SS') }}.</p>



</div>

@endsection

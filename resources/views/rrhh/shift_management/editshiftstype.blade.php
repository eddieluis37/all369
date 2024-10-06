@extends('layouts.bt4.app')
@section('title', 'Editando Tipos de Turnos')
@section('content')
<style type="text/css">
	.shadow {
  		box-shadow: 0px 2px 2px black;
  		-moz-box-shadow: 0px 2px 2px black, ;
  		-webkit-box-shadow: 0px 2px 2px black;
	}
</style>
<h3>Editando <i>"{{$sType->name}}"</i> - <b>{{$sType->shortname}}</b> </h3>
<div class="row ">
	<div class="col-md-6 col-md-offset-4 shadow"> 

		<form method="POST" class="form-horizontal" action="{{ route('rrhh.shiftsTypes.update') }}">
    		@csrf
    		@method('POST')

    		<div class="row">

    			<fieldset class="form-group col-6 col-md-3">
            		<label for="for_name">Nombre*</label>
            		<input type="text" class="form-control" id="for_name" name="name" value="{{$sType->name}}" required>
        		</fieldset>
    		</div>
    		<div class="row">

        		<fieldset class="form-group col-6 col-md-2">
        		    <label for="for_guard_name">Abreviacion</label>
        		    <input type="text" class="form-control" id="for_shortname" name="shortname" 
        		        value="{{$sType->shortname}}">
        		</fieldset>
    		</div>
    		
    		<div class="row">
    			@php
    				$days = explode(",",$sType->day_series)
    			@endphp
        		<fieldset class="form-group col-12 col-md-7">
        		    <label for="for_descripcion">Jornada</label>
        		    @for($i=0;$i<7;$i++)
        		         <select class="form-control"  id="for_day_series" name="day_series[]">
        		          @if($i>1)
                          <option value=""> ---- </option>
                          @endif
        		         	@foreach($tiposJornada as $index => $t  )
        		         		<option value="{{ $index}}" {{($index == $days[$i])?"selected":""}}> {{$index}} - {{$t}}</option>

        		         	@endforeach
        		         </select>
        		    @endfor
        		</fieldset>
    		</div>

    		<div class="row">
        		<fieldset class="form-group col-6 col-md-2">
        		    <label for="for_mostrar">Visible en </label>
				@foreach( $months as $month )
					@php
						$index = $loop->iteration;
					@endphp
					<div class="form-check form-check-inline">
  						<input class="form-check-input" type="checkbox"  name="months[]" value="{{$loop->iteration}}"  
  						{{-- (isset($actuallyMonths) && count( $actuallyMonths->where("month",$loop->iteration)->where("user_id",$idUser) ) > 0 )?"checked":"" --}} 
  						@foreach( $actuallyMonths as $key=> $aMonth )

  							@if( $aMonth->month == $index )
  								checked
  							@endif
  						@endforeach
  						/>
  						<label class="form-check-label" for="inlineCheckbox2">{{  substr($month, 0, 3) }} </label>
					</div>
				@endforeach
				

        		</fieldset>
    		</div>
    		<input hidden id="for_id" name="id" value="{{$sType->id}}">
    		<button type="submit" class="btn btn-primary">Guardar</button>
    		<button type="button" onclick="cancelar();" class="btn btn-danger">Cancelar</button>
    
		</form>



	</div>
	
</div>
<script type="text/javascript">
	
function cancelar(){
     window.history.back();
}
</script>

@endsection

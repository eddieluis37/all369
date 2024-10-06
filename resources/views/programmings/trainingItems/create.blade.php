@extends('layouts.bt4.app')

@section('title', 'Item Capacitación')

@section('content')

@include('programmings/nav')



<h4 class="mb-3">
<a href="{{ route('trainingitems.index', ['commune_file_id' => Request::get('commune_file_id')]) }}" class="btn btb-flat btn-sm btn-dark" >
                    <i class="fas fa-arrow-left small"></i> 
                    <span class="small">Volver</span> 
    </a>
Nuevo Item de Capacitación </h4>




<form method="POST" class="form-horizontal small" action="{{ route('trainingitems.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" id="forreferente" name="commune_file_id" value="{{Request::get('commune_file_id')}}">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="forprogram">Lineamientos Estrategicos</label>
            <select name="linieamiento_estrategico" id="linieamiento_estrategico" class="form-control">
                @if($year >= 2023)
                    <option value="EJE ESTRATÉGICO 1: Medio ambiente y entornos saludables">EJE ESTRATÉGICO 1: Medio ambiente y entornos saludables</option>
                    <option value="EJE ESTRATÉGICO 2: Estilos de vida">EJE ESTRATÉGICO 2: Estilos de vida</option>
                    <option value="EJE ESTRATÉGICO 3: Enfermedades transmisibles">EJE ESTRATÉGICO 3: Enfermedades transmisibles</option>
                    <option value="EJE ESTRATÉGICO 4: Enfermedades crónicas no transmisibles y violencia">EJE ESTRATÉGICO 4: Enfermedades crónicas no transmisibles y violencia</option>
                    <option value="EJE ESTRATÉGICO 5: Funcionamiento y discapacidad">EJE ESTRATÉGICO 5: Funcionamiento y discapacidad</option>
                    <option value="EJE ESTRATÉGICO 6: Emergencias y desastres">EJE ESTRATÉGICO 6: Emergencias y desastres</option>
                    <option value="EJE ESTRATÉGICO 7: Gestión, calidad e innovación">EJE ESTRATÉGICO 7: Gestión, calidad e innovación</option>
                    <option value="EJE ESTRATÉGICO 8: Equidad">EJE ESTRATÉGICO 8: Equidad</option>
                @else
                    <option value="EJE ESTRATEGICO 1: Enfermedades Transminisibles">EJE ESTRATEGICO 1: Enfermedades Transminisibles</option>
                    <option value="EJE ESTRATEGICO 2: Enfermedades crónicas, violencia y discapacidad">EJE ESTRATEGICO 2: Enfermedades crónicas, violencia y discapacidad</option>
                    <option value="EJE ESTRATEGICO 3: Hábitos de vida">EJE ESTRATEGICO 3: Hábitos de vida</option>
                    <option value="EJE ESTRATEGICO 4: Curso de vida">EJE ESTRATEGICO 4: Curso de vida</option>
                    <option value="EJE ESTRATEGICO 5: Equidad y salud en todas las políticas">EJE ESTRATEGICO 5: Equidad y salud en todas las políticas</option>
                    <option value="EJE ESTRATEGICO 6: Medio ambiente">EJE ESTRATEGICO 6: Medio ambiente.</option>
                    <option value="EJE ESTRATEGICO 7: Institucionalidad del Sector Salud">EJE ESTRATEGICO 7: Institucionalidad del Sector Salud</option>
                    <option value="EJE ESTRATEGICO 8: Calidad de la atenció">EJE ESTRATEGICO 8: Calidad de la atención</option>
                    <option value="EJE ESTRATEGICO 9: Emergencias, desastres y epidemias">EJE ESTRATEGICO 9: Emergencias, desastres y epidemias</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="forprogram">Actividad de Capacitación (Tema)</label>
            <input type="input" class="form-control " id="temas" name="temas" value="" required="">
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="forprogram">Objetivos Educativos</label>
            <textarea class="form-control rounded-1" name="objetivos_educativos" id="objetivos_educativos" rows="3"></textarea>
        </div>
    </div>

    <div class="form-row">
    

        <div class="form-group col-md-3">
            <label for="forprogram">A (Médicos, Odont, QF,etc.)</label>
            <input type="number" class="form-control " id="med_odont_qf" name="med_odont_qf"  required="">
        </div>
        <div class="form-group col-md-3">
            <label for="forprogram">B (Otros Profesio-nales)</label>
            <input type="number" class="form-control" id="otros_profesionales" name="otros_profesionales" required="">
        </div>


        <div class="form-group col-md-3">
            <label for="forprogram">C (Técnicos Nivel Superior)</label>
            <input type="number" class="form-control" id="tec_nivel_superior" name="tec_nivel_superior" required="">
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">D (Técnicos de Salud)</label>
            <input type="number" class="form-control" id="tec_salud" name="tec_salud" required="" >
        </div>
        
    </div>

    <div class="form-row">

        <div class="form-group col-md-3">
            <label for="forprogram">E (Adminis-trativos Salud)</label>
            <input type="number" class="form-control" id="administrativo_salud" name="administrativo_salud" required="">
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">F (Auxiliares servicios Salud)</label>
            <input type="number" class="form-control" id="auxiliares_salud" name="auxiliares_salud" required="">
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">Total</label>
            <input type="input" class="form-control" id="total" name="total"  required="" readonly>
        </div>
        

        <div class="form-group col-md-3">
            <label for="forprogram">Nro. de Horas Pedagogicas</label>
            <input type="input" class="form-control" id="num_hr_pedagodicas" name="num_hr_pedagodicas" required="">
        </div>

        
    </div>

    <div class="form-row">

        <div class="form-group col-md-3">
            <label for="forprogram">Item Capacitacion</label>
            <select name="item_cap" id="item_cap" class="form-control">
                    <option value=""></option>
                    <option value="X">SI</option>
               
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">Fondos Municipales</label>
            <select name="fondo_muni" id="fondo_muni" class="form-control">
                    <option value="NO">No</option>
                    <option value="SI">SI</option>
               
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">Otros Fondos (Especificar)</label>
            <input type="input" class="form-control" id="otro_fondo" name="otro_fondo" >
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">Total Presupuesto Estimado</label>
            <input type="number" class="form-control" id="total_presupuesto_est" name="total_presupuesto_est" >
        </div>

        
    </div>

    <div class="form-row">

        <div class="form-group col-md-3">
            <label for="forprogram">Organismo Ejecutor</label>
            <input type="input" class="form-control" id="org_ejecutor" name="org_ejecutor" >
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">COORDINADOR</label>
            <input type="input" class="form-control" id="coordinador" name="coordinador" >
        </div>

        <div class="form-group col-md-3">
            <label for="forprogram">Fecha de Ejecución</label>
            <input type="input" class="form-control" id="fecha_ejecucion" name="fecha_ejecucion" >
        </div>


    </div>

    
    <button type="submit" class="btn btn-info mb-4">Crear</button>

</form>

@endsection

@section('custom_js')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<script>
    $('#med_odont_qf, #otros_profesionales, #tec_nivel_superior, #tec_salud, #administrativo_salud, #auxiliares_salud').keyup(function() {
        
        var med_odont_qf         = $('#med_odont_qf').val();
        var otros_profesionales  = $('#otros_profesionales').val();
        var tec_nivel_superior   = $('#tec_nivel_superior').val();
        var tec_salud            = $('#tec_salud').val();
        var administrativo_salud = $('#administrativo_salud').val();
        var auxiliares_salud     = $('#auxiliares_salud').val();

        console.log("rate "+tec_salud+" coverture "+med_odont_qf);

        if(med_odont_qf == 0 && otros_profesionales == 0 && tec_nivel_superior == 0  && tec_salud == 0 && administrativo_salud == 0 && auxiliares_salud == 0)
        {
            var calc = 0;
            console.log("prevalence_rate == 0 && coverture == 0");
        }
        
        else 
        {
            var calc = Number(med_odont_qf) + Number(otros_profesionales) + Number(tec_nivel_superior)+Number(tec_salud) + Number(administrativo_salud) + Number(auxiliares_salud);
            console.log("prevalence_rate > 0 && coverture == 0");
            
        }
    
        $('#total').val(Math.round(calc));
        
    });


    
</script>


@endsection

@extends('layouts.bt4.app')

@section('title', 'Ley 19813')

@section('content')

@include('indicators.partials.nav')

<h3 class="mb-3">{{ $label['meta'] }}</h3>

<div class="row">
    <div class="col-sm">
        <div id="chartdiv-current"></div>
    </div>
    <div class="col-sm">
        <div id="chartdiv-current-2018"></div>
    </div>
</div>

<br>

<!-- Nav tabs -->
<ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
    @foreach($data as $nombre_comuna => $comuna)
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true"
            href="#{{ str_replace(" ","_",$nombre_comuna) }}">{{$nombre_comuna}}
        </a>
    </li>
    @endforeach
</ul>

<!-- Tab panes -->
<div class="tab-content mt-3">

    @foreach($data as $nombre_comuna => $comuna)

        <div class="tab-pane" id="{{ str_replace(" ","_",$nombre_comuna) }}" role="tabpanel" >

            <h4>{{ $nombre_comuna }}</h4>

            <table class="table table-sm table-bordered small">

                <thead>
                    <tr class="text-center">
                        <th width="45%">Indicador</th>
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
                    <tr class="text-center">
                        <td class="text-left">{{ $label['numerador'] }}</td>
                        <td rowspan="2" class="align-middle" nowrap>{{ $comuna['meta'] }}</td>
                        <td rowspan="2" class="align-middle">{{ $comuna['cumplimiento'] }} % </td>
                        <td class="text-right">{{ $comuna['numerador'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ $comuna['numerador_6'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ $comuna['numerador_12'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">{{ $label['denominador'] }}</td>
                        <td class="text-right">{{ $comuna['denominador'] }}</td>
                        <td colspan="12" class="text-center"> {{ $comuna['denominador'] }}</td>
                    </tr>
                </tbody>
            </table>

            <hr class="mt-5 mb-4" >
            @foreach($comuna['establecimientos'] as $nombre_establecimiento => $establecimiento)

                <strong> {{ $nombre_establecimiento }} </strong>

                <table class="table table-sm table-bordered small">
                    <thead>
                        <tr class="text-center">
                            <th width="45%">Indicador</th>
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
                        <tr class="text-center">
                            <td class="text-left">{{ $label['numerador'] }}</td>
                            <td rowspan="2" class="align-middle" nowrap>{{ $establecimiento['meta'] }} %</td>
                            <td rowspan="2" class="align-middle">{{ $establecimiento['cumplimiento'] }} % </td>
                            <td class="text-right">{{ $establecimiento['numerador']  }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">{{ $establecimiento['numerador_6'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">{{ $establecimiento['numerador_12'] }}</td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">{{ $label['denominador'] }}</td>
                            <td class="text-right">{{ $establecimiento['denominador'] }}</td>
                            <td colspan="12" class="text-center">{{ $establecimiento['denominador'] }}</td>
                        </tr>
                    </tbody>

                </table>

            @endforeach
        </div>
    @endforeach
</div>

@endsection

@section('custom_js')
<script type="text/javascript">
    $('#myTab a[href="#IQUIQUE"]').tab('show') // Select tab by name
</script>

<!-- INDICADOR 1 -->
<style>
    #chartdiv-current {
      width: 95%;
      height: 400px;
    }

    #chartdiv-current-2018 {
      width: 100%;
      height: 400px;
    }
</style>

<script>
    var mescarga = '<?php echo $mescarga; ?>'
    var mes;
    switch (mescarga) {
      case '1':
        mes = 'enero';
        break;
      case '2':
        mes = 'febrero';
        break;
      case '3':
        mes = 'marzo';
        break;
      case '4':
        mes = 'abril';
        break;
      case '5':
        mes = 'mayo';
        break;
      case '6':
        mes = 'junio';
        break;
      case '7':
        mes = 'julio';
        break;
      case '8':
        mes = 'agosto';
        break;
      case '9':
        mes = 'septiembre';
        break;
      case '10':
        mes = 'octubre';
        break;
      case '11':
        mes = 'noviembre';
        break;
      case '12':
        mes = 'diciembre';
        break;
      default:
      //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
        break;
    }
</script>

<!-- CURRENT CHART -->
<script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv-current", am4charts.XYChart);

    // Export
    //chart.exporting.menu = new am4core.ExportMenu();

    // Add percent sign to all numbers
    chart.numberFormatter.numberFormat = "#.##'%'";

    // Data for both series
    var arrayJS=<?php echo json_encode($data22019);?>;
    /* ALTO HOSPICIO */
    var ahos = arrayJS['ALTO HOSPICIO']['cumplimiento'];
    var meta_ahos = arrayJS['ALTO HOSPICIO']['meta'];
    /* CAMIÑA */
    var cam = arrayJS['CAMIÑA']['cumplimiento'];
    var meta_cam = arrayJS['CAMIÑA']['meta'];
    /* COLCHANE */
    var col = arrayJS['COLCHANE']['cumplimiento'];
    var meta_col = arrayJS['COLCHANE']['meta'];
    /* HUARA */
    var hua = arrayJS['HUARA']['cumplimiento'];
    var meta_hua = arrayJS['HUARA']['meta'];

    var iqu = arrayJS['IQUIQUE']['cumplimiento'];
    var meta_iqu = arrayJS['IQUIQUE']['meta'];

    var pic = arrayJS['PICA']['cumplimiento'];
    var meta_pic = arrayJS['PICA']['meta'];

    var poz = arrayJS['POZO ALMONTE']['cumplimiento'];
    var meta_poz = arrayJS['POZO ALMONTE']['meta'];

    var data = [ {
      "comuna": "Alto Hospicio",
      "cumplimiento": ahos,
      "meta": meta_ahos
    }, {
      "comuna": "Camiña",
      "cumplimiento": cam,
      "meta": meta_cam
    }, {
      "comuna": "Colchane",
      "cumplimiento": col,
      "meta": meta_col
    }, {
      "comuna": "Huara",
      "cumplimiento": hua,
      "meta": meta_hua
    }, {
      "comuna": "Iquique",
      "cumplimiento": iqu,
      "meta": meta_iqu
    }, {
      "comuna": "Pica",
      "cumplimiento": pic,
      "meta": meta_pic
    }, {
      "comuna": "Pozo Almonte",
      "cumplimiento": poz,
      "meta": meta_poz
    }];

    /* Create axes */
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "comuna";
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.fontSize = 12;

    /* Create value axis */
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.max = 110;

    /* Create series */
    var columnSeries = chart.series.push(new am4charts.ColumnSeries());
    columnSeries.name = "Cumplimiento";
    columnSeries.dataFields.valueY = "cumplimiento";
    columnSeries.dataFields.categoryX = "comuna";
    //columnSeries.dataFields.label.fontSize = 12;

    columnSeries.columns.template.tooltipText = "[#fff font-size: 10px]{name} en {categoryX}:\n[/][#fff font-size: 12px]{valueY} [/] [#fff]{additional}[/]"
    //columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
    columnSeries.columns.template.propertyFields.stroke = "stroke";
    columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
    columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
    columnSeries.tooltip.label.textAlign = "middle";

    var valueLabel = columnSeries.bullets.push(new am4charts.LabelBullet());
    valueLabel.label.text = "[bold]{valueY}[/]";
    valueLabel.label.fill = am4core.color("#fff");
    valueLabel.locationY = 0.1;
    valueLabel.label.fontSize = 12;

    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.name = "Meta";
    lineSeries.dataFields.valueY = "meta";
    lineSeries.dataFields.categoryX = "comuna";

    lineSeries.stroke = am4core.color("#fdd400");
    lineSeries.strokeWidth = 3;
    lineSeries.propertyFields.strokeDasharray = "lineDash";
    lineSeries.tooltip.label.textAlign = "middle";

    var bullet = lineSeries.bullets.push(new am4charts.Bullet());
    bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
    bullet.tooltipText = "[#fff font-size: 10px]{name} en {categoryX}:\n[/][#fff font-size: 12px]{valueY} [/] [#fff]{additional}[/]";

    var circle = bullet.createChild(am4core.Circle);
    circle.radius = 4;
    circle.fill = am4core.color("#fff");
    circle.strokeWidth = 3;

    let title = chart.titles.create();
    title.text = "Cumplimiento vs Meta - Año 2019";
    title.fontSize = 15;
    title.marginBottom = 10;

    chart.data = data;

    chart.responsive.enabled = true;

    }); // end am4core.ready()
</script>

<!-- CURRENT-2018 Chart -->
<script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv-current-2018", am4charts.XYChart);

    // Add percent sign to all numbers
    chart.numberFormatter.numberFormat = "#.##'%'";

    var arrayJS=<?php echo json_encode($data22019);?>;
    var arrayJS2018=<?php echo json_encode($data22018);?>;

    if(mescarga <= 11){
        var ahos2018 = arrayJS2['ALTO HOSPICIO']['numerador_6'] / arrayJS2['ALTO HOSPICIO']['denominador'] * 100;

    }
    if(mescarga == 12){
        var ahosInd2_2018 = arrayJS2['ALTO HOSPICIO']['numerador'] / denMeta2_2018 * 100;
    }

    // Add data
    chart.data = [ {
      "comuna": "Alto Hospicio",
      "year2018": ahos2018,
      "year2019": ahos
    }, {
      "comuna": "Camiña",
      "year2018": 0,
      "year2019": cam
    }, {
      "comuna": "Colchane",
      "year2018": 0,
      "year2019": col
    }, {
      "comuna": "Huara",
      "year2018": 0,
      "year2019": hua
    }, {
      "comuna": "Iquique",
      "year2018": 0,
      "year2019": iqu
    }, {
      "comuna": "Pica",
      "year2018": 0,
      "year2019": pic
    }, {
      "comuna": "Pozo Almonte",
      "year2018": 0,
      "year2019": poz
    }];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "comuna";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.fontSize = 12;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.max = 110;

    chart.colors.list = [
      am4core.color("#9fc5e8"),
      am4core.color("#741b47")
    ];

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "year2018";
    series.dataFields.categoryX = "comuna";
    series.clustered = false;
    series.name = "Año 2018";
    series.columns.template.tooltipText = "Cobertura en {categoryX} (2018): [bold]{valueY}[/]";

    /*Add label
    var labelBullet = series.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.text = "[bold]{valueY}[/]";
    labelBullet.label.fill = am4core.color("#000");
    labelBullet.locationY = 0;
    labelBullet.label.fontSize = 12;*/

    var series2 = chart.series.push(new am4charts.ColumnSeries());
    series2.dataFields.valueY = "year2019";
    series2.dataFields.categoryX = "comuna";
    series2.name = "Año 2019";
    series2.clustered = false;
    series2.columns.template.width = am4core.percent(50);
    series2.columns.template.tooltipText = "Cobertura en {categoryX} (2019): [bold]{valueY}[/]";

    // Add label
    var labelBullet = series2.bullets.push(new am4charts.LabelBullet());
    //labelBullet.label.text = "[bold]{valueY}[/]";
    labelBullet.label.fill = am4core.color("#fff");
    labelBullet.locationY = 0.5;
    labelBullet.label.fontSize = 12;

    //TITULO
    let title = chart.titles.create();
    title.text = "Cobertura "+ mes +" vs Año 2018 - Servicio de Salud Tarapacá";
    title.fontSize = 15;
    title.marginBottom = 10;

    //LEYENDA
    chart.legend = new am4charts.Legend();
    legend.parent = chart.chartContainer;
    legend.background.fill = am4core.color("#000");
    legend.background.fillOpacity = 0.05;
    legend.width = 120;
    legend.align = "right";

    }); // end am4core.ready()
</script>

@endsection

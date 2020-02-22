<?php
include 'includes/header.php' 
?>
<style type="text/css">
    #container {
    height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<div class="container d-flex justify-content-center">
    
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart with buttons to modify options, showing how options can be changed
        on the fly. This flexibility allows for more dynamic charts.
    </p>

    <button id="plain">Plain</button>
    <button id="inverted">Inverted</button>
    <button id="polar">Polar</button>
</figure>
</div>
</div>            
</div>
</div>
</div>
</div>


<?php
include 'includes/footer.php' 
?>

<script src="plugins/highcharts/highcharts.js"></script>
<script src="plugins/highcharts/highcharts-more.js"></script>
<script src="plugins/highcharts/exporting.js"></script>
<script src="plugins/highcharts/exporting-data.js"></script>
<script src="plugins/highcharts/accessibility.js"></script>
<script type="text/javascript">
    var chart = Highcharts.chart('container', {

    title: {
        text: 'Chart.update'
    },

    subtitle: {
        text: 'Plain'
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
        showInLegend: false
    }]

});


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain'
        }
    });
});

$('#inverted').click(function () {
    chart.update({
        chart: {
            inverted: true,
            polar: false
        },
        subtitle: {
            text: 'Inverted'
        }
    });
});

$('#polar').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: true
        },
        subtitle: {
            text: 'Polar'
        }
    });
});

</script>
</body>
</html>
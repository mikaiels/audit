@extends('app')


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style type="text/css">
		.pagination li{
			float: left;
			list-style-type: none;
			margin:5px;
		}

		.buttontengah {
    text-align: center;
}

.button {
    position: absolute;
  
}


#card-header-createjo {
   background-color: cyan !important;
}
#card-header-masterjo {
   background-color: #AAFF00;
}
#card-header-pengaturan {
   background-color: #EADDCA;
}



	</style>


@section('content')


@auth



<div >
      
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Pie Chart
                    </div>
                    <div class="card-body">
                        <div id="pie_chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Line Chart
                    </div>
                    <div class="card-body">
                        <div id="line_chart"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header">
                Column Chart
            </div>
            <div class="card-body">
                <div id="column_chart"></div>
            </div>
        </div>

    </div>
    <script>
        Highcharts.chart('column_chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Sum of Product Grouped by Year Chart',
            },
            xAxis: {
                categories: <?= json_encode($column['categories']) ?>,
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Sales',
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            plotOptions: {
                bar: {
                    borderRadius: '50%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: <?= json_encode($column['series']) ?>
        });
    </script>
    <script>
        Highcharts.chart('line_chart', {

            title: {
                text: 'Sum of Sales Chart',
            },
            yAxis: {
                title: {
                    text: 'Sales'
                }
            },

            xAxis: {
                categories: <?= json_encode($line['categories']) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                name: 'Sales',
                data: <?= json_encode($line['data']) ?>
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
    <script>
        Highcharts.chart('pie_chart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Product Count by Category Chart'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Total',
                colorByPoint: true,
                data: <?= json_encode($pie) ?>
            }]
        });
    </script>



@endauth




@guest
<a class="btn btn-primary" href="{{ route('login') }}">Login</a>
<a class="btn btn-info" href="{{ route('register') }}">Register</a>
@endguest

@endsection
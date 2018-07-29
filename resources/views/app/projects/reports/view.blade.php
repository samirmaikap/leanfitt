@extends('layouts.app')
@section('content')
    <main>
        <header class="header no-border">
            <div class="header-bar">
                <h4>{{ucfirst($report->report_name)}} - {{ucfirst($report->project_name)}}</h4>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                @if($report_category==14 || $report_category==15 || $report_category==11 || $report_category==12 || $report_category==6)
                    @include('app.projects.reports.chart')
                @endif
            </div>
        </div>
    </main>
    <script data-provide="sweetalert">
        window.onload=function(){
            $(function(){
                var category_id="{{$report_category}}";
                var label=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('label')->values()->toJson() : null !!}');
                var value1=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('value')->values()->toJson() : null !!}');
                var xAxis="{{empty($report_data->x_axis) ? 'X Axis' : $report_data->x_axis}}"
                var yAxis="{{empty($report_data->y_axis) ? 'Y Axis' : $report_data->y_axis}}"
                if(category_id==14){
                    var value2=[];
                    var currentValue=0;
                    for (var i=0;i<value1.length;i++){
                        currentValue+=parseFloat(value1[i]);
                        value2[i]=currentValue;
                    }
                    paretoChart('pareto-chart',label,value1,value2,xAxis,yAxis);
                }
                else if(category_id=15){
                    barChart('bar-chart',label,value1,xAxis,yAxis);
                }
                else if(category_id==11){
                    var data_array=[];
                    for(var i=0;i<label.length;i++){
                        data_array[i]['x']=label[i];
                        data_array[i]['y']=value1[i];
                    }
                    scatterChart('scatter-chart',data_array,xAxis,yAxis);
                }
                else if(category_id==12){
                    lineChart('line-chart',label,value1,xAxis,yAxis);
                }
                else if(category_id==6){
                    barChart('bar-chart',label,value1,xAxis,yAxis);
                }
            })

            $('.dataset-table').on('click','.edit-chart-data',function(){
                var $tr=$(this).parent().parent().parent();
                var id=$tr.data('id');
                var label=$tr.find('.chart-label').text();
                var value=$tr.find('.chart-value').text();
                $('#modal-chart').find('.modal-title').html('Edit Chart data');
                $('#modal-chart').find('input[name="label"]').val(label);
                $('#modal-chart').find('input[name="value"]').val(value);
                $('#modal-chart').find('input[name="chart_id"]').val(id);
                $('#modal-chart').modal('show');
            })

            $('.dataset-table').on('click','.remove-chart-data',function(){
                var $tr=$(this).parent().parent().parent();
                var id=$tr.data('id');
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    var url="{{url('projects/reports/charts')}}/"+id;
                    $('#deleteChartDataForm').attr('action',url)
                    $('#deleteChartData').trigger('click');
                })
            })

            $('.new-chart-dataset').click(function(){
                $('#chartModalForm')[0].reset();
                $('#modal-chart').find('input[name="report_id"]').val("{{$report->id}}");
                $('#modal-chart').find('.modal-title').html('Add Chart data');
                $('#modal-chart').modal('show');
            })


            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                toastr.success('{{ session('success') }}');
            }, 500);
            @endif
            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                toastr.error("{{ $error }}");
            }, {{ $timeout * $key }});
            @endforeach
            @endif
        }
    </script>
@endsection
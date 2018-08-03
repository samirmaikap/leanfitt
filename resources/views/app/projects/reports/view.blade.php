@extends('layouts.app')
@section('content')
    <main>
        <header class="header no-border">
            <div class="header-bar">
                <h4>{{ucfirst($report->report_name)}} - {{ucfirst($report->project_name)}}</h4>
            </div>
        </header>
        <div class="main-content">
            @if($report_category==16 || $report_category==18 || $report_category==19 || $report_category==20)
                <div class="row">
                    @include('app.projects.reports.chart')
                </div>
            @elseif($report_category==2)
                <div class="row">
                    @include('app.projects.reports.grid')
                </div>
            @elseif($report_category==5)
                @include('app.projects.reports.checkbox')
            @elseif($report_category==1)
                @include('app.projects.reports.defaults')
            @endif
        </div>
    </main>
    <script data-provide="sweetalert">
        window.onload=function(){
            $(function(){
                var category_id="{{$report_category}}";

                if(category_id==16 || category_id==18 || category_id==19 || category_id==20){
                    var label=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('label')->values()->toJson() : null !!}');
                    var value1=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('value')->values()->toJson() : null !!}');
                    var xAxis="{{empty($report_data->x_axis) ? 'X Axis' : $report_data->x_axis}}"
                    var yAxis="{{empty($report_data->y_axis) ? 'Y Axis' : $report_data->y_axis}}"
                }
                if(category_id==18){
                    console.log('pareto called');
                    var value2=[];
                    var currentValue=0;
                    for (var i=0;i<value1.length;i++){
                        currentValue+=parseFloat(value1[i]);
                        value2[i]=currentValue;
                    }
                    paretoChart('pareto-chart',label,value1,value2,xAxis,yAxis);
                }
                else if(category_id==16){
                    console.log('bar called');
                    barChart('bar-chart',label,value1,xAxis,yAxis);
                }
                else if(category_id==20){
                    console.log('scatter called');
                    var data_array=[];
                    for(var i=0;i<label.length;i++){
                        data_array.push({
                            x:label[i],
                            y:value1[i],
                        })
                    }
                    scatterChart('scatter-chart',data_array,xAxis,yAxis);
                }
                else if(category_id==19){
                    console.log('line called');
                    lineChart('line-chart',label,value1,xAxis,yAxis);
                }
                else{
                    console.log('null');
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

            //Default page function
            $(".default-page").on('click','.media-1-level-1',function() {
                $(this).removeClass('media-1-level-1').addClass('media-2-level-1').appendTo('.default-page .container-2-level-1');
            });

            $(".default-page").on('click','.media-2-level-1',function() {
                $(this).removeClass('media-2-level-1').addClass('media-1-level-1').appendTo('.default-page .container-1-level-1');
            });

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
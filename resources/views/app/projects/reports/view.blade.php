@extends('layouts.app')
@section('content')
    <main>
        <header class="header no-border">
            <div class="header-bar">
                <h4>{{ucfirst($report->report_name)}} ({{ucfirst($report->project_name)}})</h4>
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
    <script>
        window.onload=function(){
            $(function(){
                var category_id="{{$report_category}}";
                var label=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('label')->values()->toJson() : null !!}');
                var value1=JSON.parse('{!! isset($report_data->chart) ? $report_data->chart->pluck('value')->values()->toJson() : null !!}');
                var xAxis="{{empty($report_data->axis) ? 'X Axis' : $report_data->axis}}"
                var yAxis="{{empty($report_data->yxis) ? 'Y Axis' : $report_data->yxis}}"

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

                }
                else if(category_id==11){

                }
                else if(category_id==12){

                }
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
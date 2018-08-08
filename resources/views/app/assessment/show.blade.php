@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>Assessments</h4>
            </div>
        </header>

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <div class="media-list media-list-hover media-list-divided">
                                @if(count($assessments) > 0)
                                    @foreach($assessments as $key=>$assessment)
                                        @php $string_arr=['Strongly Disagree','Disagree','Neutral','Agree','Strongly Agree'] @endphp
                                        <div class="media">
                                            <div class="media-body">
                                                <p>
                                                    {{$assessment->assessment}}
                                                </p>
                                                <div class="mt-10">
                                                    @for($i=0;$i<5;$i++)
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio" id="rad1{{$i.$key}}" name="assessments[{{ $assessment->tool_name }}][{{  $key }}]" value="{{$i+1}}"> {{$string_arr[$i]}}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h3 class="py-20">No assessment found</h3>
                                @endif
                            </div>
                            @if(count($assessments) > 0)
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <script>
                window.onload=function(){
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
        </div>
@endsection
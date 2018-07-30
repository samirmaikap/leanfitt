@extends('layouts.app')
@section('content')
    <style>
        .hidden{
            display: none;
        }
        .radio-success{
            color:green;
        }
        .radio-danger{
            color:red;
        }
    </style>
    <main class="main-container">
        <aside class="aside aside-lg aside-expand-md">
            <div class="aside-body no-padding">
                <div class="media-list media-list-divided media-list-hover mt-20 mb-20">
                    @if(count($tools) > 0)
                        @foreach($tools as $tool)
                            <a class="media  {{$active_tool == $tool->tool_id ? 'active' : ''}}" href="{{url('quizzes/take').'/'.$tool->tool_id}}">
                                <div class="media-body">
                                    <p class="text-truncate w-160px"><strong>{{$tool->too_name}}</strong>
                                        @if($tool->quiz_taken)
                                            <span class="badge badge-success pull-right">{{$tool->score}} % Score</span>
                                        @else
                                            <span class="badge badge-warning pull-right">Pending</span>
                                        @endif

                                    </p>
                                    <p class="text-truncate">{{$tool->question_count}} Questions</p>
                                </div>
                            </a>
                        @endforeach
                    @endif

                </div>
            </div>

            <button class="aside-toggler"></button>
        </aside>
        <!-- END Page aside -->
        <header class="header no-border">
            <div class="header-bar">
                <h4>{{isset($quiz->tool_name) ? ucfirst($quiz->tool_name) : 'Take'}} Quizzes</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item question-progress-text">1</li>
                    <li class="breadcrumb-item">{{isset($quiz->question_count) ? $quiz->question_count : 0}}</li>
                </ol>
            </div>
        </header>

        <div class="main-content">
                <div class="row">
                    @if($quiz->taken && !isset($_GET['retake']))
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="d-block text-success">You've taken this quiz already</h1>
                                </div>
                                <div class="card-footer">
                                    <a href="?retake=true" type="button" class="btn btn-primary" >Retake</a>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $quizs=isset($quiz->quiz) ? $quiz->quiz : null;
                        @endphp

                        <div class="col-lg-12">
                            <div class="card">
                                @if(count($quizs) > 0)
                                    @foreach($quizs as $key=>$q)
                                        <div class="data-toogle question-block" id="goto-{{$key}}" data-toggle="{{$key}}"  style="display: none">
                                            <h3 class="card-title pt-20 pb-20"><strong>{{$q->question}}</strong></h3>
                                            <div class="media-list">
                                                @php $questions=isset($q->content) ? $q->content : null @endphp
                                                @if(count($questions) > 0)
                                                    @foreach($questions as $num=>$que)
                                                        <div class="media media-single">
                                                            <div class="form-check form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="radio" id="rad{{$key.$num}}" name="qradio{{$key}}" value="{{$que->type}}">
                                                                    {{$que->answer}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    @endforeach
                                @else
                                    <div class="card-title"><h3>No Quiz found</h3></div>
                                @endif
                                <div class="card-footer">
                                    <form method="post" action="{{url('quizzes/post')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" id="result-correct" name="correct" value="0">
                                        <input type="hidden" id="result-incorrect" name="incorrect" value="0">
                                        <input type="hidden" id="total-question" name="total" value="{{$quiz->question_count}}">
                                        <input type="hidden" name="lean_tool_id" value="{{$active_tool}}">
                                        <input type="hidden" name="employee_id" value="{{auth()->user()->id}}">
                                        @if(!$quiz->taken)
                                            <input type="submit" id="submit-result" name="submit" class="hidden btn btn-primary" value="Submit">
                                            <button type="button" class="btn btn-primary btn-next disabled">Next</button>
                                        @else
                                            @if(isset($_GET['retake']))
                                                <input type="submit" id="submit-result" name="submit" class="hidden btn btn-primary" value="Submit">
                                                <button type="button" class="btn btn-primary btn-next disabled">Next</button>
                                            @else
                                                <a href="?retake=true" type="button" class="btn btn-primary" >Retake</a>
                                            @endif

                                        @endif
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>


            <script>
                window.onload=function(){
                    if($('#total-question').val() == 1){
                        $("#submit-result").addClass('disabled').removeClass('hidden');
                        $('.btn-next').hide();
                    }
                    $('.question-block:eq(0)').stop(0).fadeIn('fast').addClass('active-question');
                    $("input[type='radio']").each(function(){
                        $(this).change(function(){
                            var $btnnext=$('.btn-next');
                            var $resultCorrect=$('#result-correct');
                            var $resultIncorrect=$('#result-incorrect');
                            if(!$(this).hasClass('disabled')){
                                $btnnext.removeClass('disabled');
                                $btnnext.addClass('active');
                                if(!$(this).hasClass('hidden')){
                                    $("#submit-result").removeClass('disabled');
                                }
                                $(this).parent().parent().parent().siblings().addClass('disabled');
                                $(this).parent().parent().parent().siblings().find("input[type='radio']").attr('disabled',true);
                                if($(this).val()==='true'){
                                    $(this).parent().addClass('radio-success');
                                    var correct=$resultCorrect.val();
                                    $resultCorrect.val(parseInt(correct)+1)
                                }
                                else{
                                    $(this).parent().addClass('radio-danger');
                                    $(this).siblings().addClass('text-danger');
                                    var incorrect=$resultIncorrect.val();
                                    $resultIncorrect.val(parseInt(incorrect)+1)
                                }
                            }
                        })
                    });
                    $('.btn-next').click(function(){
                        var total=$('#total-question').val();
                        if(!$(this).hasClass('disabled')){
                            var currentq=$('.active-question').data('toggle');
                            var next=parseInt(currentq)+1;
                            var progress=parseInt(next)+1;
                            if(total >= next){
                                $(this).addClass('disabled');
                                $('#goto-'+currentq).removeClass('active-question').stop(0).fadeOut('fast',function(){
                                    $('#goto-'+next).stop(0).fadeIn().addClass('active-question');
                                });
                                $('.question-progress-text').html(progress);
                                // $('.question-progress-bar').css("width",parseInt((progress/total)*100)+"%");
                                if( parseInt(total) - parseInt(progress) == 0){
                                    $("#submit-result").addClass('disabled').removeClass('hidden');
                                    $(this).hide();
                                }
                            }
                        }
                    });
                    $("#submit-result").click(function(e){
                        if($(this).hasClass('disabled')){
                            e.stopImmediatePropagation();
                            return false;
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
        </div>
@endsection
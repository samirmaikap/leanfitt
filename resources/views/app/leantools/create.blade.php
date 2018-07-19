@extends('layouts.app')
@section('content')
    <main class="main-container">
        <header class="header no-border">
            <div class="header-bar">
                <h4>{{empty($tool_id) ? "New" : 'Edit' }} Lean Tool</h4>
            </div>
        </header>

        <div class="main-content">

            <div class="card">
                <h4 class="card-title"><strong>Name</strong></h4>
                <div class="card-body form-type-material">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control tool-name" value="{{isset($tool->name) ? $tool->name : ''}}" onkeyup="fillToolName()">
                            <label>Lean tool name</label>
                        </div>
                    </div>
                </div>
            </div>

            {{--{{dd($tool)}}--}}
            <div class="card">
                <h4 class="card-title"><strong>Overview</strong></h4>
                <div class="card-body">
                    <textarea class="tiny-editor" id="overview-editor">
                        {!! isset($tool->overview) ? $tool->overview : '' !!}
                    </textarea>
                </div>
            </div>
            <div class="card">
                <h4 class="card-title"><strong>Steps</strong></h4>
                <div class="card-body">
                   <textarea class="tiny-editor" id="steps-editor">
                        {!! isset($tool->steps) ? $tool->steps : ''  !!}
                    </textarea>
                </div>
            </div>
            <div class="card">
                <h4 class="card-title"><strong>Case Studies</strong></h4>
                <div class="card-body">
                    <textarea id="case-editor"  class="tiny-editor">
                        {!! isset($tool->case_studies) ? $tool->case_studies : '' !!}
                    </textarea>
                </div>
            </div>

            {{--Assessment--}}
            <div class="card">
                <h4 class="card-title"><strong>Assessments</strong></h4>
                @php
                   $assessments=isset($tool->assessment) ? json_decode($tool->assessment) : null;
                        @endphp
                <div class="media-list media-list-hover media-list-divided scrollable assessment-list-container" style="height: auto;max-height: 350px">
                    @if(count($assessments) > 0)
                        @foreach($assessments as $key=>$assessment)
                            <div data-id="{{$key}}" class="media media-single assessment-list">
                                <div class="media-body">
                                    <p>{{$assessment}}</p>
                                </div>
                                <div class="media-right">
                                    <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary assessment-edit" href="#" data-toggle="modal" data-target="#assessment-modal"><i class="fe fe-edit-2"></i></a>
                                    <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary assessment-delete" href="#"><i class="fe fe-trash-2"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center bt-1 border-light p-2">
                    <a href="javascript:void(0)" class="d-block" id="new-assessment" data-toggle="modal" data-target="#assessment-modal">New Assessment</a>
                </div>
            </div>

            {{--Quiz--}}
            <div class="card">
                <h4 class="card-title"><strong>Quiz</strong></h4>
                @php
                    $quizs=isset($tool->quiz) ? collect(json_decode($tool->quiz))->sortBy('index') : null;
                @endphp
                <div class="media-list media-list-hover media-list-divided scrollable quiz-list-container" style="height: auto;max-height: 350px">
                     @if(count($quizs) > 0)

                        @foreach($quizs as $key=>$quiz)
                            <div data-id="{{isset($quiz->index) ? $quiz->index : ($key+1)}}" class="media media-single quiz-list">
                                <div class="media-body">
                                    <p>{{isset($quiz->question) ? $quiz->question : 'Not available' }}</p>
                                </div>
                                <div class="media-right">
                                    <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary quiz-edit" href="#" data-toggle="modal" data-target="#quiz-modal"><i class="fe fe-edit-2"></i></a>
                                    <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary quiz-delete" href="#"><i class="fe fe-trash-2"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center bt-1 border-light p-2">
                    <a href="javascript:void(0)" class="d-block" data-toggle="modal" data-target="#quiz-modal" id="new-quiz">New Quiz</a>
                </div>
            </div>

            {{--Save All the data--}}
            <div class="card">
                <div class="card-body text-center">
                    <form method="post" action="{{url('lean-tools/create')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="name" id="name-input">
                        <textarea style="display: none" name="overview" id="overview-input"></textarea>
                        <textarea style="display: none;" name="steps" id="steps-input"></textarea>
                        <textarea style="display: none;" name="case_studies" id="case-studies-input"></textarea>
                        <input type="hidden" name="tool_id" value="{{isset($tool_id) ? $tool_id : null}}">

                         <div class="assessment-input-container">
                             @if(count($assessments) > 0)
                                 @foreach($assessments as $key=>$assessment)
                                     <div class="form-group hidden assessment-input-group" data-id="{{$key}}">
                                         <input type="hidden" name="assessment[]" value="{{$assessment}}">
                                     </div>
                                 @endforeach
                             @endif
                         </div>
                         <div class="quiz-input-container">
                             @if(count($quizs) > 0)
                                 @foreach($quizs as $key=>$quiz)
                                     @php
                                         $qindex=isset($quiz->index) ? $quiz->index : ($key + 1);
                                         $qcontent=isset($quiz->content) ? $quiz->content : null;
                                     @endphp
                                     <div class="quiz-input-list" data-id="{{$qindex}}">
                                         <input type="hidden" name="quiz[{{$qindex}}][question]" value="{{$quiz->question}}">
                                         <input type="hidden" name="quiz[{{$qindex}}][index]" value="{{$qindex}}">
                                         @foreach($qcontent as $i=>$content)
                                             <input type="hidden" class="answer-block" name="quiz[{{$qindex}}][content][{{$i}}][answer]" value="{{isset($content->answer) ? $content->answer : ''}}">
                                             <input type="hidden" name="quiz[{{$qindex}}][content][{{$i}}][type]" value="{{isset($content->type) ? $content->type : ''}}">
                                         @endforeach
                                     </div>
                                 @endforeach
                             @endif
                         </div>

                        <button type="submit" class="btn btn-round btn-primary">Save</button>
                    </form>

                </div>
            </div>
        </div>

        {{--Modal start--}}
        <div class="modal modal-center fade" id="assessment-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Assessment</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="assessmentForm">
                            <div class="form-group">
                                <label>Name</label>
                                <input id="asmodal-name" type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <input type="hidden" id="assessment-data-id">
                            <input type="hidden" id="assessment-editor-type">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-close btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-bold btn-pure btn-primary" id="add-assessment">Add</button>
                    </div>
                </div>
            </div>
        </div>
        {{--Modal End--}}
        {{--Modal start--}}
        <div class="modal modal-top fade" id="quiz-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Quiz</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="quizForm">
                            <div class="form-group">
                                <label>Index</label>
                                <input id="question-index" type="number" class="form-control" name="index[]" placeholder="1">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <input id="question" type="text" class="form-control" name="question[]" placeholder="Name">
                            </div>
                            <div class="form-content">

                            </div>
                            <input type="hidden" id="quiz-data-id">
                            <input type="hidden" id="quiz-editor-type">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-close btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-bold btn-pure btn-primary" id="add-quiz">Add</button>
                    </div>
                </div>
            </div>
        </div>
        {{--Modal End--}}
    </main>
    <script data-provide="sweetalert">
        window.onload=function(){
             tinymce.init({
                 selector:'#overview-editor,#steps-editor,#case-editor',
                 branding: false,
                 height: 500,
                 theme: 'modern',
                 // plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
                 plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
                 toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                 image_advtab: true,
                 setup:function(ed) {
                     ed.on('change', function(e) {
                         updateTextContent();
                     });
                 }
             });

             updateTextContent();
             fillToolName();

             $('#add-assessment').on('click',function(){
                 var type=$('#assessment-editor-type').val();
                 var data_id=$('#assessment-data-id').val();
                 var content=$('#asmodal-name').val();
                 var list=assessmentListHtml(content,data_id);
                 var inputGroup=assessmentInputHtml(content,data_id);
                 if(type=='add'){
                     $('.assessment-list-container').append(list);
                     $('.assessment-input-container').append(inputGroup);
                     $('#assessmentForm')[0].reset();
                 }
                 else{
                     $('.assessment-list-container .assessment-list:eq('+data_id+')').replaceWith(list);
                     $('.assessment-input-container .assessment-input-group:eq('+data_id+')').replaceWith(inputGroup);
                 }

             });

             $('.assessment-list-container').on('click','.assessment-delete',function(){
                 var $this=$(this);
                 swal({
                     title: 'Are you sure?',
                     text: "You won't be able to revert this!",
                     type: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Yes, delete it!'
                 }).then(function() {
                     var data_id=$this.parent().parent().data('id');
                     $('.assessment-input-container .assessment-input-group[data-id="'+data_id+'"]').remove();
                     $this.parent().parent().remove();
                 })
             })
            $('#new-assessment').click(function(){
                var id=$('.assessment-list').length;
                $('#assessment-modal').find('.modal-title').html('Add Assessment');
                $('#assessment-modal').find('#assessment-data-id').val(id);
                $('#assessment-modal').find('#assessment-editor-type').val('add');
            })
            $('.assessment-list-container').on('click','.assessment-edit',function(){
                var id=$(this).parent().parent().data('id');
                $('#assessment-modal').find('.modal-title').html('Edit Assessment');
                $('#assessment-modal').find('#assessment-data-id').val(id);
                $('#assessment-modal').find('#assessment-editor-type').val('edit');
                $('#asmodal-name').val($(this).parent().parent().find('p').text())
            });

            /*Quiz*/
            $('#new-quiz').click(function(){
                var len=parseInt(parseInt($('.quiz-input-container > .quiz-input-list').length)+1);
                $('#quiz-editor-type').val('add');
                $('#quiz-data-id').val(len);
                initQuizEditor(len,'add');
            })
            $('.quiz-list-container').on('click','.quiz-edit',function(){
                var id=$(this).parent().parent().data('id');
                $('#quiz-editor-type').val('edit');
                $('#quiz-data-id').val(id);
                initQuizEditor(id,'edit');
            });

            $('#add-quiz').click(function(){
                var type=$('#quiz-editor-type').val();
                var selectedQuiz=$('#quiz-data-id').val();
                var question = $('#quiz-modal').find('#question').val();
                var list=quizListHtml(question,selectedQuiz);
                var inputGroup=quizInputHtml(question,selectedQuiz);
                if(type=='add'){
                    $('.quiz-list-container').append(list);
                    $('.quiz-input-container').append(inputGroup);
                    $('#quizForm')[0].reset();
                }
                else{
                    $('.quiz-list-container .quiz-list:eq('+(selectedQuiz - 1)+')').replaceWith(list);
                    $('.quiz-input-container .quiz-input-list:eq('+(selectedQuiz - 1)+')').replaceWith(inputGroup);
                }
            })

            $('.quiz-list-container').on('click','.quiz-delete',function(){
                var $this=$(this);
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function() {
                    var data_id=$this.parent().parent().data('id');
                    $('.quiz-input-container .quiz-input-list[data-id="'+data_id+'"]').remove();
                    $this.parent().parent().remove();
                })
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

        function fillToolName(){
            var name=$('.tool-name').val();
            $('#name-input').val(name);
        }

        function assessmentListHtml(content,count){
            var list='<div data-id="'+count+'" class="media media-single assessment-list">\n' +
                '                        <div class="media-body">\n' +
                '                            <p>'+content+'</p>\n' +
                '                        </div>\n' +
                '\n' +
                '                        <div class="media-right">\n' +
                '                            <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary assessment-edit" href="#" data-toggle="modal" data-target="#assessment-modal"><i class="fe fe-edit-2"></i></a>\n' +
                '                            <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary assessment-delete" href="#"><i class="fe fe-trash-2"></i></a>\n' +
                '                        </div>\n' +
                '                    </div>';
            return list;
        }

        function assessmentInputHtml(content,count){
            var html='<div class="form-group hidden assessment-input-group" data-id="'+count+'">\n' +
                '                                 <input type="hidden" name="assessment[]" value="'+content+'">\n' +
                '                             </div>';
            return html;
        }

        /*Quiz */
        function initQuizEditor(id='',mode= 'add') {
            $('#quiz-modal').find('.modal-title').text(mode + ' Question');
            var number_arr=['A','B','C','D','E','F','G','H','I'];
            var html='';
            if(mode==='add'){
                $('#question').val('');
                $('#question-index').val(id);
                for(var i=0;i<4;i++){
                    html+='<div class="form-group">\n' +
                        '                                <label>Option '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[answer]['+i+']" placeholder="Answer">\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']"  value="true" >True</label>\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']" value="false" checked>False</label>\n' +
                        '                            </div>';
                }
                $('#quiz-modal .form-content').empty().append(html);
            }
            else{
                var question=$('.quiz-input-container .quiz-input-list[data-id="' + id + '"]').find('input[name="quiz['+id+'][question]"]').val();
                var index=$('.quiz-input-container .quiz-input-list[data-id="' + id + '"]').find('input[name="quiz['+id+'][index]"]').val();
                $('#quiz-modal').find('#question-index').val(index);
                $('#quiz-modal').find('#question').val(question);
                var len=$('.quiz-input-container .quiz-input-list[data-id="' + id + '"]').find('.answer-block').length;
                for(var i=0;i<len;i++){
                    var ans=$('.quiz-input-container  .quiz-input-list[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][answer]"]').val();
                    var type=$('.quiz-input-container .quiz-input-list[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][type]"]').val();
                    var c1=(type==='true') ? "checked" : '';
                    var c2=(type==='false') ? "checked" : '';
                    html+='<div class="form-group">\n' +
                        '                                <label>Option '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[answer]['+i+']" value="'+ans+'">\n' +
                        '                                <label class="radio-inline mt-10 ml-10"><input type="radio" name="content[type]['+i+']"  value="true" '+c1+'>True</label>\n' +
                        '                                <label class="radio-inline mt-10"><input type="radio" name="content[type]['+i+']" value="false" '+c2+'>False</label>\n' +
                        '                            </div>';
                }
                $('#quiz-modal .form-content').empty().append(html);
            }
        }

        function quizListHtml(content,count){

            var list='<div data-id="'+count+'" class="media media-single quiz-list">\n' +
                '                        <div class="media-body">\n' +
                '                            <p>'+content+'</p>\n' +
                '                        </div>\n' +
                '\n' +
                '                        <div class="media-right">\n' +
                '                            <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary quiz-edit" href="#" data-toggle="modal" data-target="#quiz-modal"><i class="fe fe-edit-2"></i></a>\n' +
                '                            <a class="btn btn-sm btn-bold btn-round btn-outline btn-secondary quiz-delete" href="#"><i class="fe fe-trash-2"></i></a>\n' +
                '                        </div>\n' +
                '                    </div>';
            return list;
        }

        function quizInputHtml(question,selectedQuiz){

            var index=$('#quiz-modal').find('#question-index').val();
            var anstable='';
            for(var i=0;i<4;i++){
                var ans=$('#quiz-modal').find('input[name="content[answer]['+i+']"]').val();
                var type=$('#quiz-modal').find('input[name="content[type]['+i+']"]:checked').val();
                anstable +='<input type="hidden" class="answer-block" name="quiz['+selectedQuiz+'][content]['+i+'][answer]" value="'+ans+'">';
                anstable+= '<input type="hidden" name="quiz['+selectedQuiz+'][content]['+i+'][type]" value="'+type+'">'
            }
            var html = '<div class="quiz-input-list" data-id="'+selectedQuiz+'">\n' +
                '                                 <input type="hidden" name="quiz['+selectedQuiz+'][question]" value="'+question+'">\n' +
                '                                 <input type="hidden" name="quiz['+selectedQuiz+'][index]" value="'+index+'">\n'+
                ''+anstable+
                '</div>';
            return html;
        }

        function updateTextContent(){
            $('#overview-input').text(tinymce.get('overview-editor').getContent());
            $('#steps-input').text(tinymce.get('steps-editor').getContent());
            $('#case-studies-input').text(tinymce.get('case-editor').getContent());
        }
    </script>
@endsection
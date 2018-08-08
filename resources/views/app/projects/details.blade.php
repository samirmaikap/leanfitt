@extends('layouts.app')
@section('content')
    <main>
        <style>
            .avatar-container .avatar{
                vertical-align: middle !important;
            }
        </style>
        @include('app.projects.partials.header')
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4 project-container">
                    <div class="card">
                        <div class="card-header center-h"><h3><strong>{{$project->name}}</strong></h3></div>
                        <div class="card-body text-center bg-lighter">
                            <p>{{$project->note}}</p>
                            <p>{{$project->goal}}</p>
                            <p>Start Date: {{date('m/d/Y',strtotime($project->start_date))}}</p>
                            <p>End Date: {{date('m/d/Y',strtotime($project->end_date))}}</p>
                            <p>Report Date: {{date('m/d/Y',strtotime($project->report_date))}}</p>
                            <p>Owner: {{isset($project->owner) ? $project->owner->full_name : 'Not avaliable'}}</p>
                            @if($project->is_completed==1)
                                <p>Status: <span class="text-success">Completed</span></p>
                            @elseif($project->is_archived==1)
                                <p>Status: <span class="text-warning">Archived</span></p>
                            @else
                                <p>Status: <span class="text-primary">Ongoing</span></p>
                            @endif

                        </div>
                        @if(!isSuperadmin())
                            <div class="card-body text-center">
                                @if($project->is_completed==0 && $project->is_archived==0 )
                                    <button class="btn m-1 btn-round btn-primary" data-toggle="modal" data-target="#modal-project">Edit</button>
                                    <form class="d-inline-block" id="compeleteProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/complete">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <button class="btn m-1 btn-round btn-success complete-project">Mark Complete</button>
                                    </form>
                                @elseif($project->is_completed==1 && $project->is_archived==0 )
                                    <form class="d-inline-block" id="archiveProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/archive">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <button class="btn m-1 btn-round btn-warning archive-project">Archive</button>
                                    </form>

                                @elseif($project->is_completed==1 && $project->is_archived==1)
                                    <form class="d-inline-block" id="deleteProjectForm" method="post" action="{{url('projects')}}/{{$project->id}}/delete">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <button class="btn m-1 btn-round btn-danger delete-project">Delete</button>
                                    </form>
                                @else
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @php
                            $default_savings_content=json_decode(\Illuminate\Support\Facades\Storage::get('savings.json'));
                            $default_savings=$default_savings_content->values;
                            $default_savings_arr=$default_savings_content->values;
                        @endphp
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><h4>Tangible Savings</h4></div>
                                <form method="post" action="{{url('projects')}}/{{$project->id}}/savings/tangibles" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="media-list media-list-hover media-list-divided tangible-container scrollable h-250px">
                                        @if(count($tangibles) > 0)
                                            @foreach($tangibles as $key2=>$tangible)
                                                <div class="media media-single" id="tangible-{{$key2+1}}" data-id="{{$tangible->id}}">
                                                    <span class="title">{{$tangible->value}}</span>
                                                    <input type="hidden" id="tangible-input-value" name="values[]" value="{{$tangible->value}}">
                                                    <span class="badge badge-pill cursor-pointer fs-15 text-dark hover-info edit-tangible" data-toggle="modal" data-target="#modal-tangible"><i class="ti-pencil"></i></span>
                                                    <span class="badge badge-pill cursor-pointer fs-15 text-dark hover-danger remove-tangible"><i class="ti-trash"></i></span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    @if(!isSuperadmin())
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-round btn-outline-info add-tangible">Add New</button>
                                            <button class="btn btn-round btn-outline-success">Update</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><h4>Intangible Benefits</h4></div>
                                <form method="post" action="{{url('projects')}}/{{$project->id}}/savings/intangibles" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="media-list media-list-hover media-list-divided intangible-container scrollable h-250px">
                                        @php $intangibles_arr=$intangibles->pluck('value')->toArray(); @endphp
                                        @php
                                            $diff_arr=array_diff($intangibles_arr,$default_savings_arr);
                                            $other_name=array_pop($diff_arr)
                                        @endphp

                                        @foreach($default_savings as $key3=>$int_value)
                                            @if(next($default_savings))
                                                <div class="media media-single" href="#">
                                                    <label class="custom-control title custom-control-primary custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="{{$int_value}}" name="values[]" {{in_array($int_value,$intangibles_arr) ? 'checked' : ''}}>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">{{$int_value}}</span>
                                                    </label>
                                                </div>
                                            @else
                                                <div class="media media-single" href="#">
                                                    <label class="custom-control title custom-control-primary custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="{{empty($other_name) ? $int_value : $other_name}}" name="values[]" {{in_array(empty($other_name) ? $int_value : $other_name,$intangibles_arr) ? 'checked' : ''}}>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">{{empty($other_name) ? $int_value : $other_name}}</span>
                                                    </label>
                                                    @if(strtolower($int_value)=='others')
                                                        <span class="badge badge-pill cursor-pointer fs-15 text-success change-intangible-other" data-toggle="modal" data-target="#modal-intangible"><i class="ti-pencil"></i></span>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if(!isSuperadmin())
                                        <div class="card-footer text-center">
                                            <button class="btn btn-round btn-outline-success update-intangible">Update</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 avatar-container members-container">
                            <div class="card">
                                <div class="card-header"><h4>Members</h4></div>
                                <div class="card-body">
                                    @if(count($project_members) > 0)
                                        @foreach($project_members as $key=>$pmems)
                                            <label class="d-block my-20">{{$key}}</label>
                                            @foreach($pmems as $pmem)
                                                <a class="avatar avatar-pill avatar-lg" href="{{url('users')}}/{{$pmem->id}}/profile">
                                                    <img src="{{$pmem->avatar}}" alt="...">
                                                    <span>{{ucfirst($pmem->first_name)}} {{ucfirst($pmem->last_name)}}</span>
                                                    @if(!isSuperadmin())
                                                        <form id="memberRemoveForm" method="post" action="{{url('projects')}}/{{$project->id}}/member/{{$pmem->member_id}}/remove">
                                                            {{csrf_field()}}
                                                            {{method_field('delete')}}
                                                            <button type="submit"  class="close cursor-pointer remove-member">&times;</button>
                                                        </form>
                                                    @endif
                                                </a>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    @if(!isSuperadmin())
                                        <div class="avatar avatar-add avatar-lg hover-white cursor-pointer" data-toggle="modal" data-target="#modal-member"></div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 avatar-container attachments-container">
                            <div class="card">
                                <div class="card-header"><h4>Attachments</h4></div>
                                <div class="card-body">
                                    @if(isset($project->attachments) && count($project->attachments) > 0)
                                        @foreach($project->attachments as $key=>$attachment)
                                            @php $ext= empty($attachment->url) ? 'N/A' : pathinfo($attachment->url, PATHINFO_EXTENSION); @endphp
                                            <a class="avatar avatar-pill avatar-lg" title="{{pathinfo($attachment->url, PATHINFO_BASENAME)}}" style="overflow: hidden" href="{{$attachment->url}}" target="_blank">
                                                <img src="https://ui-avatars.com/api/?font-size=0.21&length=4&uppercase=false&name={{$ext}}" alt="...">
                                                <span class="text-truncate w-150px">{{pathinfo($attachment->url, PATHINFO_FILENAME)}}</span>
                                                @if(!isSuperadmin())
                                                    <form id="attachmentRemoveForm" method="post" action="{{url('projects')}}/{{$project->id}}/attachment/{{$attachment->id}}/remove">
                                                        {{csrf_field()}}
                                                        {{method_field('delete')}}
                                                        <button type="submit" class="close cursor-pointer remove-attachment">&times;</button>
                                                    </form>
                                                @endif
                                            </a>
                                        @endforeach
                                    @endif
                                    @if(!isSuperadmin())
                                        <a class="avatar avatar-add avatar-lg hover-white cursor-pointer add-attachment"></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 comments-container">
                            <div class="card">
                                <div class="card-header"><h4>Comments</h4></div>
                                <div class="card-body">
                                    <div class="media-list media-list-divided">

                                        @if(isset($project->comments) && count($project->comments) > 0)
                                            @foreach($project->comments as $comment)
                                                <div class="media">
                                                    <a class="avatar" href="#">
                                                        <img src="{{isset($comment->user) ? $comment->user->avatar : null}}" alt="...">
                                                    </a>
                                                    <div class="media-body">
                                                        <p>
                                                            <a href="{{url('users')}}/{{isset($comment->user) ? $comment->user->id : null}}/profile"><strong>{{isset($comment->user) ? $comment->user->full_name : 'No Name'}}</strong></a>
                                                            <time class="float-right text-fade" datetime="2018-07-14 20:00">{{date('m/d/Y',strtotime($comment->created_at))}}</time>
                                                        </p>
                                                        <p>{{$comment->comment}}</p>
                                                        <p>
                                                        {{--<span class="cursor-pointer badge badge-gray mr-1">Edit</span> --}}
                                                        @if(session()->get('user')->id==$comment->user->id)
                                                            <form id="commentDeleteForm" method="post" action="{{url('projects')}}/comment/{{$comment->id}}/remove">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}
                                                                <button type="submit" class="btn btn-xs btn-outline-danger mr-5 mt-1 remove-comment">Delete</button>
                                                            </form>
                                                            @endif
                                                            </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h4>No comments</h4>
                                        @endif
                                    </div>
                                    @if(!isSuperadmin())
                                        <form class="publisher bg-transparent bt-1 border-fade" method="post" action="{{url('projects/comment')}}">
                                            {{csrf_field()}}
                                            <textarea name="comment" class="publisher-input" style="resize: none" placeholder="Add Comment">{{old('comment')}}</textarea>
                                            {{--<input class="publisher-input" type="text" placeholder="Add Comment">--}}
                                            <input type="hidden" name="type" value="project">
                                            <input type="hidden" name="project_id" value="{{$project->id}}">
                                            <button type="submit" class="publisher-btn" href="#"><i class="fe fe-arrow-right"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-top fade" id="modal-project" tabindex="-1">
            <div class="modal-dialog mt-30 ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{url('projects')}}/{{$project->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="input-normal">Name</label>
                                <input type="text" name="name" class="form-control" id="input-normal" value="{{isset($project->name) ? $project->name : old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="textarea">Description</label>
                                <textarea name="note" class="form-control" id="textarea" rows="2">{{isset($project->note) ? $project->note : old('note')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Goal</label>
                                <textarea name="goal" class="form-control" id="textarea" rows="2">{{isset($project->goal) ? $project->goal : old('goal')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Start Date</label>
                                <input type="text" name="start_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->start_date) ? date('m/d/Y',strtotime($project->start_date)) : old('start_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">End Date</label>
                                <input type="text" name="end_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->end_date) ? date('m/d/Y',strtotime($project->end_date)) : old('end_date')}}">
                            </div>
                            <div class="form-group">
                                <label for="input-normal">Report Date</label>
                                <input type="text" name="report_date" class="form-control" id="input-normal" data-provide="datepicker" data-date-today-highlight="true" value="{{isset($project->report_date) ? date('m/d/Y',strtotime($project->report_date)) : old('report_date')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-bold btn-pure btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{--Tangible--}}
        <div class="modal modal-center fade" id="modal-tangible" tabindex="-1">
            <div class="modal-dialog mt-30 ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="input-normal">Value</label>
                            <input type="text" id="tangible-input" class="form-control">
                        </div>
                        <input type="hidden" name="id" id="tangible-id">
                        <input type="hidden" id="tangible-key">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bold btn-pure btn-primary update-tangible">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{--Intangible--}}
        <div class="modal modal-center fade" id="modal-intangible" tabindex="-1">
            <div class="modal-dialog mt-30 ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Intagible</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="input-normal">Name</label>
                            <input type="text" class="form-control" id="input-intangible">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bold btn-pure btn-secondary " data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bold btn-pure btn-primary rename-intangible-other">Save</button>
                    </div>
                </div>
            </div>
        </div>


        @include('app.projects.partials.members-modal')

        {{--Upload attachment--}}
        <form method="post" action="{{url('projects/attachment')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" id="file-input" style="display: none" name="attachment" onchange="$('#uploadFile').trigger('click')">
            <input type="hidden" name="type" value="project">
            <input type="hidden" name="project_id" value="{{$project->id}}">
            <input type="submit" value="true" id="uploadFile" style="display: none">
        </form>

    </main>
    <script data-provide="sweetalert">
        window.onload=function(){
            $('.add-attachment').click(function(){
                $('#file-input').trigger('click');
            })

            $('.project-container').on('click','.complete-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#compeleteProjectForm').submit();
                })
            })

            $('.project-container').on('click','.archive-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#archiveProjectForm').submit();
                })
            })

            $('.project-container').on('click','.delete-project',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#deleteProjectForm').submit();
                })
            })

            // $('.members-container').on('click','.remove-member',function(e){
            //     e.preventDefault();
            //     e.stopImmediatePropagation();
            //     swal({
            //         title: 'Are you sure?',
            //         text: "You can revert this later!",
            //         type: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes'
            //     }).then(function() {
            //         $('#memberRemoveForm').;
            //     })
            // })

            $('.attachments-container').on('click','.remove-attachment',function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                swal({
                    title: 'Are you sure?',
                    text: "You can revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#attachmentRemoveForm').submit();
                })
            })

            $('.comments-container').on('click','.remove-comment',function(e){
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function() {
                    $('#commentDeleteForm').submit();
                })
            })

            $('.rename-intangible-other').click(function(){
                var text=$('#input-intangible').val();
                if(text!==null){
                    $('.intangible-container .custom-control-input:last').val(text);
                    $('.intangible-container .custom-control-description:last').html(text);
                }
                $('#modal-intangible').modal('hide');
            })

            $('.tangible-container').on('click','.edit-tangible',function(){
                var text=$(this).parent().find('input').val();
                var id=$(this).parent().data('id');
                var key=($(this).parent().attr('id').split('-'))[1]
                $('#tangible-input').val(text);
                $('#tangible-id').val(id);
                $('#tangible-key').val(key);
            })

            $('.tangible-container').on('click','.remove-tangible',function(){
                $(this).parent().remove();
            })

            $('.add-tangible').click(function(){
                $('#tangible-input').val('');
                $('#tangible-key').val('');
                $('#tangible-id').val('');
                $("#modal-tangible").modal('show');
            })

            $('.update-tangible').click(function(){
                var value=$('#tangible-input').val();
                var key=$('#tangible-key').val();
                if(!key){
                    var len=parseInt($('.tangible-container .media-single').length)+1;
                    var html=' <div class="media media-single" id="tangible-'+len+'" data-id="">\n' +
                        '                                                            <span class="title">'+value+'</span>\n' +
                        '                                                            <input type="hidden" id="tangible-input-value" name="values[]" value="'+value+'">\n' +
                        '                                                            <span class="badge badge-pill cursor-pointer fs-15 text-success edit-tangible" data-toggle="modal" data-target="#modal-tangible"><i class="ti-pencil"></i></span>\n' +
                        '                                                            <span class="badge badge-pill cursor-pointer fs-15 text-success"><i class="ti-trash"></i></span>\n' +
                        '                                                        </div>'
                    $('.tangible-container').append(html);
                    $('#tangible-input').val('');
                }
                else{
                    $('#tangible-'+key).find('.title').html(value);
                    $('#tangible-'+key).find('input').val(value);
                    $('#modal-tangible').modal('hide');
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
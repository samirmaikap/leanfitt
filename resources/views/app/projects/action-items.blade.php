@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">
            {{--<form class="card card-transparent">--}}
                {{--<h4 class="card-title fw-400 text-center">Contact Us</h4>--}}
                {{--<div class="card-body">--}}
                    {{--@include('static.partials.maintenance')--}}
                    @include("app.action-items.partials.board")
                {{--</div>--}}
            {{--</form>--}}
        </div>
    </main>

    <style>
        .media {
            background-color: #fff;
        }
    </style>


    {{--@include('app.action-items.partials.action-item-modal')--}}
    @include('app.projects.partials.assignees-modal')

    <!-- Dragula dependencies -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/dragula/dragula.min.css') }}">
    <script src="{{ asset('assets/vendor/dragula/dragula.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/dom-autoscroller/dom-autoscroller.min.js') }}"></script>

    <!-- Dropzone dependencies -->
    {{--<link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/min/dropzone.min.css') }}">--}}
    {{--<script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}"></script>--}}

    <!-- Dragula script-->
    <script>
        // Dropzone.autoDiscover = false;

        var userId = '{{ session()->get('user')->id }}';
        window.onload = function () {

            var drake = dragula(
                $('.board-scroller .media-list').get(),
                {
                    isContainer: function (el) {
                        return false; // only elements in drake.containers will be taken into account
                    },
                    moves: function (el, source, handle, sibling) {
                        return true; // elements are always draggable by default
                    },
                    accepts: function (el, target, source, sibling) {
                        return true; // elements can be dropped in any of the `containers` by default
                    },
                    invalid: function (el, handle) {
                        console.log($(el).data('disabled'));
                        if($(el).data('disabled') || $('.modal').is(':visible')) {
                            return true;
                        }
                        return false; // don't prevent any drags from initiating by default
                    },
                    direction: 'vertical',             // Y axis is considered when determining where an element would be dropped
                    copy: false,                       // elements are moved by default, not copied
                    copySortSource: false,             // elements in copy-source containers can be reordered
                    revertOnSpill: true,              // spilling will put the element back where it was dragged from, if this is true
                    removeOnSpill: false,              // spilling will `.remove` the element, if this is true
                    mirrorContainer: document.body,    // set the element that gets mirror elements appended
                    ignoreInputTextSelection: true     // allows users to select input text, see details below
                }
            );

            drake.on('drop', function (el, target, source, sibling) {
                var currentIndex = $(el).index();
                var currentProcess = $(el).parents('.process').data('id');
                console.log(' index: ', currentIndex);
                console.log(' process: ', currentProcess);
                $(el).find('.action-item-form input[name="position"]').val(currentIndex);
                $(el).find('.action-item-form input[name="process_id"]').val(currentProcess);

                // $.each($(target).children(), function (key, value) {
                //     console.log(key, value);
                // });
                $(el).find('.action-item-form').submit();

                var assignorId = $(el).find('.action-item-form input[name="user_id"]').val();

                var assignees =  $(el).find('.action-item-form:first [name="assignees[]"]').val();

                if((currentProcess == 4 || currentIndex == 5) && (userId != assignorId)){
                    $(el).data('disabled','true');
//                    alert('disabled');
                }
            });

            var scroll = autoScroll([
                document.querySelector('.board-wrapper')
            ], {
                direction: 'horizontal',
                margin: 20,
                pixels: 10,
                maxSpeed: 25,
                scrollWhenOutside: true,
                autoScroll: function () {
                    return this.down && drake.dragging;
                }
            });

            {{--Dropzone.prototype.defaultOptions.params = {--}}
                {{--_token: '{{ csrf_token() }}',--}}
                {{--type: 'action_item'--}}
            {{--};--}}

            $('input[name="title"], textarea[name="description"], select[name="assignees[]"]').change(function (e) {
                console.log(this);
                $(this).parents('.modal').find('.update-action-item').removeAttr('disabled');
            });

            $('.update-action-item').click(function (e) {
                $(this).parents('.modal').find('.action-item-form').submit();
            });


            $('.action-item-form').submit(function (e) {
                e.preventDefault();

                var $this = $(this);

                var id =  $this.find('input[name="id"]').val();
                var title = $this.find('input[name="title"]').val();
                // var description = $this.find('textarea[name="description"]').val();
                // var assignees = $this.find('select[name="assignees[]"]').val();
                //
                // var data = {
                //     title: title,
                //     description: description,
                //     assignees: assignees
                // };

                var data = $this.serializeArray();

                console.log(data);

                $this.parents('.modal').find('.update-action-item').html('<i class="fa fa-spinner fa-pulse"></i> Updating...').attr('disabled', '');

                $.ajax({
                    url: '{{ url('api/items') }}' + '/'  + id,
                    type: 'PUT',
                    data: data,
                    success: function(response) {

                        console.log(response);
                        $this.parents('.modal').find('.update-action-item').html('Update').removeAttr('disabled');

                        if (response.success) {
                            $('.action-item[data-id="' + id + '"]').find('.title').text(title);

                            var assignees = response.data.assignees;
                            var $parent = $this.parents('.action-item');

//                            if($parent.find('.assignees').length){
                            if(assignees.length){
//                                $parent.find('.assignees').prev('small').remove();
                                $parent.find('.assignees').prev('small').show();
                                $parent.find('.assignees').html('');
                            }else{
//                                $parent.children('.media').find('.media-body').append('<small class="text-fader">Assignees</small><p class="assignees"></p>');
                                $parent.find('.assignees').prev('small').hide();
                                $parent.find('.assignees').html('');
                            }

                            for(var i=0; i< assignees.length; i++){
                                console.log("assignees " + i);
                                var borderClass = '';
                                if(userId == assignees[i].id){
                                    borderClass = 'border-primary';
                                }
                                var html = ' <span class="avatar avatar-sm b-2 ' + borderClass + '">' +
                                    '<img src="https://ui-avatars.com/api/?name=' + assignees[i].full_name + '" alt="">'+
                                    '</span> ';
                                $parent.children('.media').find('p.assignees').append(html);
                            }
//                            location.reload();

                            toastr.success(response.message);
                            $this.parents('.modal').modal('hide');
                        } else {
                            toastr.error("Something went wrong! Please try again later.");
                        }
                    },
                    error: function (response, error) {
                        console.log(response.responseText, error);
                        toastr.error("Something went wrong! Please try again later.");
                    }
                });
            });

            $( '.comment-form').submit(function (e) {
                e.preventDefault();
                console.log('init post');

                var $this = $(this);

                if( $this.find('textarea[name="comment"]').val().trim() == ''){
                    return;
                }

                $this.find('button').html('<i class="fa fa-spinner fa-pulse"></i> Posting...').attr('disabled', '');

                var data = $this.serializeArray();

                $.post('{{ url('api/comments') }}', data, function (response) {
                    console.log(response);
                    $this.find('textarea').removeAttr('disabled');
                    $this.find('button').html('Post').removeAttr('disabled');

                    if(response.success){

                        $this.find('textarea').val('');

                        var html = '<div class="media">' +
                            '                                <a class="avatar" href="#">' +
                            '                                    <img src="https://ui-avatars.com/api/?name=' + response.data.user.full_name + '" alt="...">' +
                            '                                </a>' +
                            '                                <div class="media-body">' +
                            '                                    <p>' +
                            '                                        <a href="#"><strong>' + response.data.user.full_name + '</strong></a>' +
                            '                                        <time class="float-right text-fade" datetime="2017-07-14 20:00">' + moment(response.data.created_at).format('MM/DD/YYYY  hh::mm A') +
                            '                                        </time>' +
                            '                                    </p>' +
                            '                                    <p>' + response.data.comment + '</p>' +
                            '                                </div>' +
                            '                            </div>';

                        // console.log($this, $this.next('.comment-list'));
                        $this.next('.comment-list').prepend(html);
                        toastr.success(response.message);

                    }else{
                        toastr.error('Something went wrong! Please try again later.');
                    }
                });
            });


            // Attachment Uploader
            // $.each($('.dropzone').get(), function(key, value) {
            // $('.dropzone').each(function(key, value) {
            //
            //     console.log(typeof value);
            //
            //     var selector = '#' + $(value).attr('id');
            //     console.log(selector);
            //
            //     // var dropzones = [];
            //     // dropzones.push(initDropzone(selector));
            //
            //     var dropzone = initDropzone(selector) ;
            //
            //     //
            //     // dropzone.on('success', function (file, response) {
            //     //     console.log(response)
            //     //     var imgName = response;
            //     //     file.previewElement.classList.add("dz-success");
            //     //     console.log("Successfully uploaded :" + imgName);
            //     // });
            //     //
            //     // dropzone.on('error', function (file, response) {
            //     //     console.log(response)
            //     //     file.previewElement.classList.add("dz-error");
            //     //     $(file.previewElement).find('.dz-error-message').text(response.message);
            //     // });
            //     //
            //     // dropzone.on('removedfile', function(file) {
            //     //     console.log('removed file',file);
            //     //
            //     //     // AJAX request to delete attachment file
            //     //     $.ajax();
            //     // });
            //
            // });

            // initDropzone("#dropzone-4")


        };

        // function initDropzone(selector, options) {
        //
        //     var defaultOptions = {
        //         url: $(selector).attr('action') ? $(selector).attr('action') : $(selector).data('url'),
        //         addRemoveLinks: true,
        //         previewsContainer: '.dropzone-previews',
        //         autoProcessQueue: true,
        //         // uploadMultiple: true,
        //         // parallelUploads: 10,
        //         // maxFiles: 10,
        //         params: $(selector).data(),
        //
        //         // Events
        //         init: function() {
        //             var myDropzone = this;
        //
        //             // this.options.params = $(this).data()
        //
        //             var mockFile = { name: "myimage.jpg", size: 12345, type: 'image/jpeg' };
        //             // this.addFile.call(this, mockFile);
        //             this.options.addedfile.call(this, mockFile);
        //             this.options.thumbnail.call(this, mockFile, "");
        //             mockFile.previewElement.classList.add('dz-success');
        //             mockFile.previewElement.classList.add('dz-complete');
        //
        //             // First change the button to actually tell Dropzone to process the queue.
        //             // this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
        //             //     // Make sure that the form isn't actually being sent.
        //             //     e.preventDefault();
        //             //     e.stopPropagation();
        //             //     myDropzone.processQueue();
        //             // });
        //
        //             // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        //             // of the sending event because uploadMultiple is set to true.
        //             this.on("sendingmultiple", function() {
        //                 // Gets triggered when the form is actually being sent.
        //                 // Hide the success button or the complete form.
        //             });
        //             this.on("successmultiple", function(files, response) {
        //                 // Gets triggered when the files have successfully been sent.
        //                 // Redirect user or notify of success.
        //
        //                 console.log(files, response)
        //             });
        //             this.on("errormultiple", function(files, response) {
        //                 // Gets triggered when there was an error sending the files.
        //                 // Maybe show form again, and notify user of error
        //
        //                 console.log(files, response)
        //             });
        //         },
        //
        //         success: function (file, response) {
        //             console.log(response)
        //             var imgName = response;
        //             file.previewElement.classList.add("dz-success");
        //             console.log("Successfully uploaded :" + imgName);
        //         },
        //         error: function (file, response) {
        //             console.log(response)
        //             file.previewElement.classList.add("dz-error");
        //             $(file.previewElement).find('.dz-error-message').text(response.message);
        //         },
        //
        //         removedfile: function(file) {
        //             console.log('removed file',file);
        //
        //             // AJAX request to delete attachment file
        //             $.ajax();
        //         },
        //     }
        //
        //     options = $.extend(defaultOptions, options);
        //
        //     console.log(options);
        //
        //     return new Dropzone(selector, options);
        //
        // }

        function demo(){
            alert(1);
        }

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

    </script>
@endsection
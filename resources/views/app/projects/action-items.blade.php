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
                        if($(el).data('disabled')) {
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
                            toastr.success(response.message);
                        } else {
                            toastr.error("Something went wrong! Please try again later.");
                        }
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
        //             this.options.thumbnail.call(this, mockFile, "data:image/jpeg;base64,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");
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

    </script>
@endsection
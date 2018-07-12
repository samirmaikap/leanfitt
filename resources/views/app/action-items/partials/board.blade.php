<div class="board-wrapper">
    <div class="board-scroller">
        <div class="">
            <div class="card">
                <h4 class="card-title">To Do</h4>
                <div class="card-body">
                    <div class="media-list media-list-hover media-list-divided">
                        <a class="media media-single" href="#">
                            <div class="media-body">
                                <h6>Pack for travel after the snow</h6>
                                <small class="text-fader">By Hossein Shams</small>
                            </div>
                        </a>

                        <a class="media media-single" href="#">
                            <div class="media-body">
                                <h6>My new city</h6>
                                <small class="text-fader">By Maryam Amiri</small>
                            </div>
                        </a>

                        <a class="media media-single" href="#new-action-item-modal" data-toggle="modal">
                            <div class="media-body">
                                <h6>See the word in different way</h6>
                                <small class="text-fader">By Frank Camly</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Dragula dependencies -->

<link rel="stylesheet" href="{{ asset('assets/vendor/dragula/dragula.min.css') }}">
<script src="{{ asset('assets/vendor/dragula/dragula.min.js') }}"></script>

<script src="{{ asset('assets/vendor/dom-autoscroller/dom-autoscroller.min.js') }}"></script>

<!-- Dragula script-->
<script>

    app.ready(function () {

        var drake = dragula(
            $('.board-scroller .media-list').get()
        );

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
    });

</script>
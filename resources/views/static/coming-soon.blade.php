@extends("layouts.static")
@section("content")

    <div class="h-fullscreen bg-img p-70" style="background-image: url(https://images.pexels.com/photos/943630/pexels-photo-943630.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940)" data-overlay="6">

    <h1><img src="https://preview.ibb.co/nnWvuy/logopng_2.png" width="200" alt="logo"></h1>

    <br>

    <h2 class="text-uppercase text-white fs-50 d-none d-md-block">
        <span class="fs-70 fw-900">Launching</span><br>
        <span>very soon</span>
        <span class="text-primary fs-70">.</span>
    </h2>

    <h2 class="text-uppercase text-white fs-30 d-md-none">
        <span class="fs-50 fw-900">Launching</span><br>
        <span>very soon</span>
        <span class="text-primary fs-50">.</span>
    </h2>

    <br><br><br>

    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | MailChimp Integration
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | You should obtain your MailChimp form action url and place it inside
    | the action attribute of the form.
    |
    | How you can obtain your MailChimp form action url?
    | Watch this: https://www.youtube.com/watch?v=sybmI8HgxFo
    |
    !-->
    <form class="form-type-material row d-none d-md-block" method="get" action="">
        <div class="input-group input-group-lg col-lg-6">
            <div class="input-group-input">
                <input type="text" class="form-control bg-transparent text-white" name="EMAIL">
                <label class="text-white fw-400">Enter Your Email Address</label>
            </div>
            <span class="input-group-btn">
          <button class="btn btn-bold btn-outline btn-light" type="submit">Notify me</button>
        </span>
        </div>
    </form>

    </div>

    </div>
@endsection
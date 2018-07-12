@extends('layouts.app')
@section('content')
    <main>
        @include('app.projects.partials.header')
        <div class="main-content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="card" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        {{--<h4 class="card-title fw-400 text-center">Contact Us</h4>--}}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Give this project a name" value="{{ $project["name"] }}">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" name="description" placeholder="Write something about the project">
                                    {{ isset($project["description"]) ? $project["description"] : '' }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-bold btn-block btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </main>
@endsection
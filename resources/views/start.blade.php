@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h2 class="border-bottom text-center">standart VUE+Laravel</h2>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
                <a type="button" class="btn btn-secondary" href="#1">Example component</a>
                <a type="button" class="btn btn-secondary" href="#2">Vue -> Blade</a>
                <a type="button" class="btn btn-secondary" href="#3">Ajax</a>
                <a type="button" class="btn btn-secondary" href="#4">Line</a>
                <a type="button" class="btn btn-secondary" href="#5">Pie</a>
                <a type="button" class="btn btn-secondary" href="#6">Random</a>
                <a type="button" class="btn btn-secondary" href="#7">Socket</a>
                <a type="button" class="btn btn-secondary" href="#8">Chat</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="owl-carousel owl-theme mt-5">
            <div class="row m-2" data-hash="1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#1 Example component</h2>
                            <example-component></example-component>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row m-2" data-hash="2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#2 Передача данных во Vue из Blade </h2>
                            <prop-component :urldata="{{ json_encode($url_data) }}"></prop-component>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row m-2" data-hash="3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#3 Ajax</h2>
                            <ajax-component :urldata="{{ json_encode($url_data) }}"></ajax-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-2" data-hash="4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#4 ChartJS line</h2>
                            <chartline-component></chartline-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-2" data-hash="5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#5 ChartJS Pie</h2>
                            <chartpie-component></chartpie-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-2" data-hash="6">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#6 ChartJS Random</h2>
                            <chartrandom-component></chartrandom-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-2" data-hash="7">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#7 Broadcasting</h2>
                            <chartsocket-component></chartsocket-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-2" data-hash="8">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 720px;">
                            <h2 class="text-center">#8 Chat</h2>
                            <chat-socket-component></chat-socket-component>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
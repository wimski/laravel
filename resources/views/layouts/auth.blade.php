@extends('base')

@section('body')
    <div class="vh-100 d-flex align-items-center">
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header h3">
                            @yield('heading')
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

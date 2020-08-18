@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome back '.Auth::user()->name.'!') }}
                </div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('list_robots') }}">My Robots</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--div id="behavior-editor" style="width: 100%; height: 512px;"></div-->
<!--div id="example"></div-->
@endsection

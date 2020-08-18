@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route($route_name, $route_args ?? null) }}">
                @csrf
                @yield('form-fields')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ $btn_text }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

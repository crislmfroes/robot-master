@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($collection as $item)
        <div class="col-md-6">
            @include($card_view)
        </div>
        @endforeach
    </div>
    <a href="{{ route($creation_route, $creation_args ?? []) }}" class="btn btn-primary m-2">{{ $creation_text }}</a>
</div>
@endsection

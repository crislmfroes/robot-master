@extends('layouts.form')
@section('form-fields')
<div class="form-group">
    <label for="name">Robot Name</label>
    <input type="text" class="form-control" name="name" value="{{$item->name ?? ''}}">
</div>
@endsection

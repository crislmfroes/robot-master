@extends('layouts.form')
@section('form-fields')
<div class="form-group">
    <label for="name">State Name</label>
    <input type="text" class="form-control" name="name" value="{{$item->name ?? ''}}">
</div>
<div class="form-group">
    <label for="description">State Description</label>
    <textarea class="form-control" name="description" rows="4">{{$item->description ?? ''}}</textarea>
</div>
<div class="form-group">
    <label for="robot">Robot</label>
    <select class="form-control" name="robot">
        @foreach ($robots as $robot)
        <option value="{{ $robot->id }}" selected="{{ $robot === ($item->robot ?? null) ? 'selected' : '' }}">{{ $robot->name }}</option>
        @endforeach
    </select>
</div>
<div id="parameters-input" parameters="{{json_encode($item->availableParams ?? null)}}" ></div>
<div id="in-keys-input" keys="{{json_encode($item->inputKeys ?? null)}}" ></div>
<div id="out-keys-input" keys="{{json_encode($item->outputKeys ?? null)}}" ></div>
<div id="outcome-input" outcomes="{{json_encode($item->outcomes ?? null)}}" ></div>
@endsection

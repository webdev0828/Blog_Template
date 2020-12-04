@extends('layouts.app')

@section('title')

Add New Blog

@endsection

@section('content')

<form action="{{ route('store') }}" method="post">

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">

<input required="required" placeholder="Enter title here" type="text" name="title"class="form-control" />

</div>

<div class="form-group">

<textarea class="form-control" name='description'></textarea>

</div>

<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

</form>

@endsection
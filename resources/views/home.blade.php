@extends('layouts.app')
@section('title')
{{$title}}
<form action="{{ route('home')}}" method="post" class="orderbyForm" style="float:right">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <select class='orderby' name='orderby'>
    <option value='desc' {{ $orderBy== 'desc'? 'selected' : '' }}>DESC</option>
    <option value='asc' {{ $orderBy == 'asc'? 'selected' : '' }}>ASC</option>
  </select>
  <input type='hidden' value="{{ $title}}" name='title' />
</form>
@endsection
@section('content')
@if ( !$posts->count() )
There is no post till now. Login and write a new post now!!!
@else
<div class="">
  @foreach( $posts as $post )
  <div class="list-group">
    <div class="list-group-item">
      <h3>
        <a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
      </h3>
      <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="#">{{ $post->author->name }}</a></p>
    </div>
    <div class="list-group-item">
      <article>
        {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
      </article>
    </div>
  </div>
  @endforeach
  {!! $posts->render() !!}
</div>
@endif
@endsection
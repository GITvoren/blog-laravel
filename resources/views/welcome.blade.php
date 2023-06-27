@extends('layouts.app')
@section('content')
    <img src="{{ asset('images/laravel.png') }}" style= "width: 400px; height: 400px; display: block; margin: auto" />
    <h2 class="text-center mt-5">Featured Posts:</h2>
     @if(count($posts) > 0)
          @foreach($posts as $post)
                    <div class="card text-center w-75 mx-auto">
                         <div class="card-body">
                         <h4 class="card-title mb-3"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                         <h6 class="card-text mb-3">Author: {{$post->user->name}}</h6>
                         </div>
                    </div>          
          @endforeach
     @else
     <div>
          <h2>There are no featured posts to show!</h2>
     </div>
     @endif
@endsection
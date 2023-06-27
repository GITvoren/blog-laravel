@extends('layouts.app')

@section('content')
<form method="POST" action="/posts/{{$post->id}}">
     @csrf
     @method('PUT')
          <div class="form-group">
               <label for="title">Title</label>
               <input type="text" class= "form-control" id="title" name="title" value= "{{$post->title}} "/>
          </div>
          <div class="form-group">
               <label for="content">Content</label>
               <textarea type="text" class= "form-control" id="content" name="content" rows="3">{{$post->content}}</textarea>
          </div>
          <div class="mt-2">
               <button class="btn btn-primary" type="submit">Update post</button>
          </div>
     </form>
@endsection
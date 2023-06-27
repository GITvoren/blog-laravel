@extends('layouts.app')

@section('content')
     <form method="POST" action="/posts">
     @csrf
          <div class="form-group">
               <label for="title">Title</label>
               <input type="text" class= "form-control" id="title" name="title" />
          </div>
          <div class="form-group">
               <label for="content">Content</label>
               <textarea type="text" class= "form-control" id="content" name="content" rows="3" >
               </textarea>
          </div>
          <div class="mt-2">
               <button class="btn btn-primary" type="submit">Create post</button>
          </div>
     </form>
@endsection

<!-- put csrf on every form within the app -->
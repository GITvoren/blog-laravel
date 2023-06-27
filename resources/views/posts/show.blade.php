@extends('layouts.app')
@inject('postComments', 'App\Models\PostComment')
@section('content')
     <div class="card">
          <div class="card-body">
               <h2 class="card-title">{{$post->title}}</h2>
               <p class="card-subtitle text-muted">Author: {{$post->user->name}}</p>
               <p class="card-subtitle text-muted mb-3">Created At: {{$post->created_at}}</p>
               <p class="card-text">{{$post->content}}</p>

               <div class="mt-3">
                    <a href="/posts" class="card-link">View All Posts</a>
               </div>

               @if(Auth::id() != $post->user_id)
                    <form action="/posts/{{$post->id}}/like" class="d-inline" method="POST">
                         @method('PUT')
                         @csrf
                         @if($post->likes->contains('user_id', Auth::id()))
                              <button type="submit" class="btn btn-danger">Unlike</button>
                         @else
                              <button type="submit" class="btn btn-success">Like</button>
                         @endif
                    </form>
               @endif
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Comment
               </button>
                  <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
               <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comment on post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="POST" action="/posts/{{$post->id}}/comment">
                         @csrf
                              <div class="form-group">
                                   <label for="content">Comment</label>
                                   <textarea type="text" class= "form-control" id="content" name="content" rows="3" ></textarea>
                              </div>
                              <div class="mt-2">
                                   <button class="btn btn-primary" type="submit">Comment</button>
                              </div>
                    </form>
                </div>
               </div>
               </div>
         </div>
              
          </div>
     </div>

               <?php
                    $comments = $postComments::where('post_id', $post->id)->get();
               ?>

          @foreach($comments as $comment)
               <div class="card w-100">
                    <div class="card-body">
                         <h3 class="card-title">{{$comment->content}}</h3>
                         <p class="card-subtitle">{{$comment->user->name}}</p>
                    </div>
               </div>
          @endforeach

@endsection
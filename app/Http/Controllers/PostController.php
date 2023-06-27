<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;


class PostController extends Controller
{
    public function create(){
        // will return create.blade.php file from views/posts/ path
        return view('posts.create');
    }

    public function store(Request $request){
        if(Auth::user()){
            $post = new Post;

            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::user()->id;

            $post->save();
            return redirect('/posts');
        } else{
            return redirect('/login');
        }
    }

    public function index(){
        $posts = Post::where('isActive', true)->get();
        return view('posts.index')->with('posts', $posts);
    }

    public function show($id){
        $post = Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    public function edit($id){
        $post = Post::find($id);

        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id){
        $post = Post::find($id);

        if(Auth::user()->id == $post->user_id){
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();
        }

        return redirect('/posts');
    }

    public function archive($id){
        $post = Post::find($id);

        if(Auth::user()->id == $post->user_id){
            $post->isActive = false;

            $post->save();
        } 
        return redirect('/posts');
    }

    public function like($id){
        // get the post to be liked and the user who liked that post
        $post = Post::find($id);
        $user_id = Auth::user()->id;

        if($post->user_id != $user_id){ //checks if the author of the post is same as the user whos logged in
            if($post->likes->contains("user_id", $user_id)){ //checks if the user has already liked the post, if so, just delte the like from the post
                PostLike::where('post_id', $post->id)->where('user_id', $user_id)->delete();
            } else{ //if not yet liked, then create a new like for the post
                $postLike = new PostLike;

                $postLike->post_id = $post->id;
                $postLike->user_id = $user_id;

                $postLike->save();
            }

            return redirect("/posts/$id");
        }
    }

    public function comment(Request $request, $id){

        $post = Post::find($id);
        $user_id = Auth::user()->id;

        if(Auth::user()){
            $post = Post::find($id);
            $user_id = Auth::user()->id;

            $postComment = new PostComment;

            $postComment->content = $request->input('content');
            $postComment->post_id = $post->id;
            $postComment->user_id = $user_id;

            $postComment->save();

            
        }
        return redirect("/posts/$id");
    }

    

    
}

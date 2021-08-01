<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();

        return view('index')
            ->with(['posts' => $posts]);
    }

    //Implicit Binding
    public function show(Post $post)//Post型の$postを受け取ってそれをもとにデータを抽出して何らかの処理をする
    {
         return view('posts.show')//posts.showはpostsフォルダの中のshow.blade.phpだという意味
            ->with(['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
            // ->with([]);
    }

    public function store(PostRequest $request)//フォームから送信されたデータはここでRequest型の$requestでまとめて受け取ることができる
    {
         $post = new Post();
         $post->title = $request->title;
         $post->body = $request->body;
         $post->save();

        return redirect()
            ->route('posts.index');
    }

    public function edit(Post $post)//Post型の$postを受け取ってそれをもとにデータを抽出して何らかの処理をする
    {
         return view('posts.edit')
            ->with(['post' => $post]);
    }


    public function update(PostRequest $request, Post $post)//フォームから送信されたデータはここでRequest型の$requestでまとめて受け取ることができる
    {
         $post->title = $request->title;
         $post->body = $request->body;
         $post->save();

        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index');
    }
}

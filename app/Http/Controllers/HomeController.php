<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $lastPosts = Post::orderBy('id', 'desc')->skip(0)->take(10)->get();
        return view('home', compact('posts', 'lastPosts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        $lastPosts = Post::orderBy('id', 'desc')->skip(0)->take(10)->get();
        return view('viewpost', compact('post', 'lastPosts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUpdatePost;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderByRaw('id')->get();
        $lastPosts = Post::orderBy('id', 'desc')->skip(0)->take(10)->get();
        return view('admin.viewposts', compact('posts', 'lastPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createposts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUpdatePost $request)
    {
        $request->validated();
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;

        if($request->image_path->isValid()){
            $nameFile = Str::of($request->title)->slug("-").'.'.$request->image_path->getClientOriginalExtension();
            $request->image_path->move(public_path("images"), $nameFile);
            $data["image_path"] = $nameFile;
        }

        Post::create($data);
        return redirect()->route('post.index')->with('message','Post cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where("id", $id)->first();
        $lastPosts = Post::orderBy('id', 'desc')->skip(0)->take(10)->get();
        return view('admin.viewpost', compact('post', 'lastPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where("id", $id)->first();

        if($post->user_id != auth()->user()->id)
            return redirect()->route('post.index')->with('messageError', 'Sem permissão para editar este post');

        return view('admin.updateposts', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUpdatePost $request, $id)
    {
        $request->validated();

        $post = Post::find($id);

        $data = $request->all();
        $data["user_id"] = auth()->user()->id;

        if($request->image_path && $request->image_path->isValid()){
            $nameFile = Str::of($request->title)->slug("-").'.'.$request->image_path->getClientOriginalExtension();
            $request->image_path->move(public_path("images"), $nameFile);
            $data["image_path"] = $nameFile;
        }
        $post->update($data);
        return redirect()->route('post.index')->with('message', 'Post editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where("id", $id)->first();

        if($post->user_id != auth()->user()->id)
            return redirect()->route('post.index')->with('messageError', 'Sem permissão para deletar este post');

        $post->delete();
        return redirect()->route('post.index')->with('message','Post deletado com sucesso!');
    }
}

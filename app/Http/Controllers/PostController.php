<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //middleware para proteger rutas 
    /**
     * el construc e slo primero que se ejecuta cuanod es instanciado el controlador 
    */
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }


    public function index(User $user)
    {
        //dd(auth()->user());
        //dd($user->username);

        //todo: obtienes los post del usuario logeado y se lo mandas a tu vista con el where le dices que necesitas el id y con el get lo obtines
        //$posts = Post::where('user_id', $user->id)->get();

        //otra forma apliacando paginacion
        $posts = Post::where('user_id', $user->id)->paginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' =>$posts
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:250',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        /*Post::create([
            'titulo'=>$request->titulo,
            'descripcion' => $request->descripcion,
            'imagen'=>$request->imagen,
            'user_id'=>auth()->user()->id
        ]);*/


        //otra forma de crear registros
        /*$post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();*/

        //otra forma de crear registro con las relaciones creadas 
        $request->user()->posts()->create([
            'titulo'=>$request->titulo,
            'descripcion' => $request->descripcion,
            'imagen'=>$request->imagen,
            'user_id'=> auth()->user()->id
        ]);



        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post) 
    {
        return view('post.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
}




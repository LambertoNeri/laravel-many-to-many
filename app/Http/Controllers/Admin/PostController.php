<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:5|max:100',
        'category_id'   => 'required|integer|exists:categories,id',
        'url_image'     => 'required|url|max:200',
        'content'       => 'required|string',
        'tags'          => 'nullable|array',
        'tags.*'        => 'integer|exists:tags,id',
    ];

    private $validation_messages = [
        'required'  => 'Il campo :attribute è obbligatorio',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        'max'       => 'Il campo :attribute non può superare i :max caratteri',
        'url'       => 'Il campo deve essere un url valido',
        'exists'    => 'Valore non valido',
    ];




    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }




    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }




    public function store(Request $request)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // salvare i dati nel db se validi
        $newPost = new Post();
        $newPost->title         = $data['title'];
        $newPost->category_id   = $data['category_id'];
        $newPost->url_image     = $data['url_image'];
        $newPost->content       = $data['content'];
        $newPost->save();

        // associare i tag
        $newPost->tags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $newPost]);
    }




    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }




    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        // return view('admin.posts.edit', [
        //     'post'       => $post,
        //     'categories' => $categories,
        //     'tags'      => $tags,
        // ]);
    }




    public function update(Request $request, Post $post)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // aggiornare i dati nel db se validi
        $post->title        = $data['title'];
        $post->category_id  = $data['category_id'];
        $post->url_image    = $data['url_image'];
        $post->content      = $data['content'];
        $post->update();

        // associare i tag
        $post->tags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $post]);
    }




    public function destroy(Post $post)
    {
        // disassociare tutti i tag dal post
        $post->tags()->detach();
        // $post->tags()->sync([]);

        // elimino il post
        $post->delete();

        return to_route('admin.posts.index')->with('delete_success', $post);
    }
}
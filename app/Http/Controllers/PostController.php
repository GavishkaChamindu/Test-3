<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {


$validateData = $req->validate([

    'title' => 'required',
    'author_name' => 'required',
    'content' => 'required',
    'image' => 'required',
    'user_image' => 'required',
    'user_id' => 'required'

]);

$post = new Post;

$post->title = $validateData['title'];
$post->author_name = $validateData['author_name'];
$post->content = $validateData['content'];
$post->image = $validateData['image']->store('images');
$post->user_image = $validateData['user_image']->store('images');

$post->user_id = $validateData['user_id'];

$post->save();











    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    return Post::all();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id,Request $req)
    {



            $post = Post::find($id);

            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }


            $validatedData = $req->validate([
                'title' => 'required',
                'author_name' => 'required',
                'content' => 'required',
                'image' => 'required',
                'user_image' => 'required',
                'user_id' => 'required',


            ]);

            $post->update($validatedData);

            return response()->json(['message' => 'Post updated successfully', 'data' => $post]);



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {












    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);

    }
}

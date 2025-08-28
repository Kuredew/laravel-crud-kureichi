<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'image' => 'required|image',
                'content' => 'required',
                'genre' => 'nullable|string',
            ]);

            $image = $request->file('image');
            $imageName = $image->hashName();
            $imagePath = $image->storeAs('public/images', $imageName);

            //simpan data ke database
            Post::create([
                'image' -> $imagePath,
                'title' -> $request->input('title'),
                'content' -> $request->input('content'),
                'genre' -> $request->input('genre')
            ]);

            //redirect kembali ke halaman index dengan pesan sukses
            return redirect()->route('posts.index')
                            ->with('success','Post created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Maaf, terjadi error.', $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try{
            $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'nullable',
                'content' => 'required',
                'genre' => 'nullable|string', //kolom genre yg baru ditambahkan
            ]);

            $imagePath = $post->image;
            if ($request->hasFile('image')) {
                if ($imagePath) {
                    Storage::disk("public")->delete('images/', $imagePath);
                }
                $image = $request->file('image');
                $imageName = $image->hashName();
                $imagePath = $image->storeAs('public/images', $imageName);
            }

            $post->update([
                'title'=> $validatedData['title'],
                'content' => $validatedData['content'],
                'genre' => $validatedData['genre'],
                'image' => $imagePath
            ]);

            return redirect()->route('posts.index')
                            ->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Maaf, terjadi error.', $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $imagePath = $post->image;
        if ($imagePath) {
            Storage::disk("public")->delete('images/', $imagePath);
        }

        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully.');
    }
}

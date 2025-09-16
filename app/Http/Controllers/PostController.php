<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Post;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']),
            new Middleware('auth', only: ['home', 'logout'])
        ];
    }
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
        $genres = Genre::all();
        return view('posts.create', compact('genres'));
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
            $imagePath = $image->storeAs('/images', $imageName, 'public');

            //simpan data ke database
            Post::create([
                'image' => $imageName,
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'genre' => $request->input('genre')
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
        $genres = Genre::all();
        return view('posts.edit', compact('post', 'genres'));
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

            $imageName = $post->image;
            if ($request->hasFile('image')) {
                if ($imageName) {
                    Storage::disk("public")->delete('images/' . $imageName);
                }
                $image = $request->file('image');
                $imageName = $image->hashName();
                $image->storeAs('/images', $imageName, 'public');
            }

            $post->update([
                'title'=> $validatedData['title'],
                'content' => $validatedData['content'],
                'genre' => $validatedData['genre'],
                'image' => $imageName
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
            Storage::disk("public")->delete('images/' + $imagePath);
        }

        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Post $post, Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data = $this->validatePost();
        $data['user_id'] = auth()->id();
        $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        Post::create($data);

        return redirect()->route('admin.posts')->with('success', 'Your post created successfully');
    }
    public function edit(Post $post){
        return view('admin.posts.edit', compact('post'));
    }
    public function update(Post $post, Request $request){
        $data = $this->validatePost($post);

        if (isset($data['thumbnail'])){
//            Storage::delete('storage/'.$post->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }

        $post->update($data);

        return redirect()->route('admin.posts')->with('success', 'Post updated!');

    }
    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $thumbnail = $post->thumbnail;
        if ($thumbnail){
            Storage::delete($thumbnail);
        }
        $post->delete();
        return back()->with('success', 'Post deleted!');
    }
    protected function validatePost(?Post $post = null){
        $post ??= new Post();
        return \request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required','image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }

}

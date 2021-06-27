<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;
use Hamcrest\Arrays\IsArray;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $new_post_data = $request->all();

        $new_slug = Str::slug($new_post_data['title'], '-');
        $base_slug = $new_slug;
      
        $post_exist_slug = Post::where('slug', '=', $new_slug)->first();
        $count = 1;

        while($post_exist_slug) {
            $new_slug = $base_slug . '-' . $count;
            $count++;
            
            $post_exist_slug = Post::where('slug', '=', $new_slug)->first();
        }

        $new_post_data['slug'] = $new_slug;

        $new_post = new Post();
        $new_post->fill($new_post_data);
        $new_post->save();

        // Dobbiamo fare il Sync per i tags
        if (isset($new_post_data['tags']) && is_array($new_post_data['tags'])) {
            $new_post->tags()->sync($new_post_data['tags']);
        }
        

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post' => $post,
            'post_category' => $post->category,
            'post_tags' => $post->tags
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        
        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $modif_post_data = $request->all();    
        
        $post = Post::findOrFail($id);

        $modif_post_data['slug'] = $post->slug;   

        if($modif_post_data['title'] != $post->title) {
            
            $new_slug = Str::slug($modif_post_data['title'], '-');
            $base_slug = $new_slug;
         
            $post_exist_slug = Post::where('slug', '=', $new_slug)->first();
            $count = 1;

            while($post_exist_slug) {
                $new_slug = $base_slug . '-' . $count;
                $count++;
                
                $post_exist_slug = Post::where('slug', '=', $new_slug)->first();
            }

            $modif_post_data['slug'] = $new_slug;
        }

        $post->update($modif_post_data);

        // Tags
        if(isset($modif_post_data['tags']) && is_array($modif_post_data['tags'])) {
            $post->tags()->sync($modif_post_data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id); 

        // Eseguire il Detach per i Tags
        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

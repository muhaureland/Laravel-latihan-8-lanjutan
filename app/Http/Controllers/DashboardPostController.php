<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
        // $category = Category::all();
        // return view('dashboard.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:255',
            'category_id'   => 'required',
            'gambar'        => 'image|file|max:1024',
            'body'          => 'required'
            
        ]);

        // jika ada gambar jalankan fungsi dibawah..upload gambar ke folder post-gambar
        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('post-gambar');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
    
        Post::create($validatedData);
        return redirect('dashboard/posts')->with('status', 'postingan data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post'      => $post,
            'categories'=> Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // cara slug uniq tanpa sluggable
        // $rules = [
        //     'category_id'   => 'required',
        //     'body'          => 'required'
            
        // ];

        // // jika request title tidak sama dengan post title maka tetap gunakan title tsb
        // if ($request->title != $post->title) {
        //     $rules['title'] = 'required|unique:posts';
        // }
        // $validatedData = $request->validate($rules);

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['slug'] = Str::slug($request->title);
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
    
        // Post::where('id', $post->id)->update($validatedData);
        // return redirect('dashboard/posts')->with('status', 'postingan data berhasil dirubah!');


        // cara slug uniq dengan sluggable...ada tanda garis merah karena php inteliphense nya...tapi tetap jalan g error
        $validatedData = $request->validate([
            'title'         => 'required|max:255',
            'category_id'   => 'required',
            'gambar'        => 'image|file|max:1024',
            'body'          => 'required'
            
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
    
        Post::where('id', $post->id)->update($validatedData);
        return redirect('dashboard/posts')->with('status', 'postingan data berhasil dirubah!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect('dashboard/posts')->with('status', 'menghapus data berhasil!');
    }
}

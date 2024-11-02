<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Civitas;
use App\Models\Category;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datavalidate =  $request->validate([
            'title' => ['required'],
            'category_id' => ['required'],
            'post' => ['required'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif','max:2048']
        ]);

        $datavalidate['uuid'] = (string) Str::orderedUuid();
        $datavalidate['civitas_id'] = Auth::user()->id;

        if ($request->hasFile('photo')) {
            // Store the file and get its path
            $filePath = $request->file('photo')->store('posts', 'public');
            $datavalidate['photo'] = $filePath;
        }
        $datapost = Post::create($datavalidate);

        return redirect('/civitas/view/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        $civitas = Civitas::where('user_id',Auth::user()->id)->get()->first();
        $posts = Post::where('civitas_id',$civitas->id)->get();
        $queues = Queue::with(['post', function($q) use($civitas) {
            $q->where('civitas_id',$civitas->id);
        }])->with('schedule')->get();
        //return count($queues);

        return view('post.view',compact('queues','categories','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function editPhoto($uuid)
    {
        return view('post.photo', array('uuid' => $uuid));
    }

    public function savePhoto(Request $request, $uuid)
    {
        $filevalidate = $request->validate([
            'filephoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('filephoto')) {
            // Store the file and get its path
            $filePath = $request->file('filephoto')->store('posts', 'public');

            $post = Post::where('uuid',$uuid)->get()->first();

            //$civitas = Civitas::where('user_id',Auth::user()->id)->first();
            
            if (!is_null($post->photo)) {
                //Storage::delete($civitas->photo);
                Storage::disk('public')->delete($post->photo);
            } 
            $post->photo = $filePath;
            $post->update();
            return redirect('/civitas/view/posts');
            // Save the file path in the incoming fields array
            //$incomingFields['photo'] = $filePath; // or 'photo_path'
        }
    }

    
}

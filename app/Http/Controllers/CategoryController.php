<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Civitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $dataposts = Category::with(['post' => function($q) {
            $civitas = Civitas::where('user_id',Auth::user()->id)->get()->first();
            $q->where('civitas_id',$civitas->id)->orderBy('created_at','asc');
        } ])->get();
        // foreach ($categories as $category) {
        //     $post = $category->post;
        //     if (count($post)) {
        //         echo $category->category."<br>";
        //         echo $post."<br>";
        //     }
        // }
        return view('civitas.view01',compact($dataposts));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }


}

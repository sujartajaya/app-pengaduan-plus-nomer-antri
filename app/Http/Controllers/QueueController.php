<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Post;
use Illuminate\Http\Request;

class QueueController extends Controller
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
    public function show(Queue $queue)
    {
        date_default_timezone_set("Asia/Makassar");
        $tanggal = date('Y-m-d');
        $antrian = $queue->where('tanggal','<=',$tanggal)->where('status','open')->where('checkin','false')->get();
        $count = 0;
        return view('schedule.notif',compact('antrian','count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Queue $queue)
    {
        //
    }

    public function displyById($id)
    {
        $antri = Queue::where('id',$id)->get()->first();
        $post = Post::where('id',$antri->post_id)->get()->first();

        $html = view('schedule.modal', compact('post'))->render();
        return $html;
    }
}

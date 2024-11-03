<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Post;
use App\Models\Category;
use App\Models\Queue;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
    public function show(Schedule $schedule, $uuid)
    {
        /** Setia post pumya 1 jadwa nome antri */
        $post = Post::where('uuid',$uuid)->get()->first();
        $queue = Queue::with('post')->where('post_id',$post->id)->with('schedule')->get()->first();

        return $queue;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule, $uuid)
    {
        $validate = $request->validate([
            'tanggal' => [
                'required',
                'after:today'
            ]
        ]);
        $post = Post::where('uuid',$uuid)->get()->first();

        /** apakah ada tanggal yang dipilih di schedule */
        $jadwal = $schedule->where('tanggal',$validate)->get()->first();

        if (is_null($jadwal)) {
            $jadwal = Schedule::create($validate);
            $str = str_replace('-','',$jadwal->tanggal);
            $noantre = $str.'00001';
            
            $dataq['schedule_id'] = $jadwal->id;
            $dataq['post_id'] = $post->id;
            $dataq['number'] = $noantre;

            $queue = Queue::create($dataq);
            $post->schedule = 'true';
            $post->update();
            return redirect("/civitas/post/schedule/".$uuid);

        } else {
            $str = str_replace('-','',$jadwal->tanggal);
            $totnumb = Queue::where('number','like',$str.'%')->get()->count();
            /** proses membuat nomer antre kombinasi tgl dan nomer antre */
            $noantre = "";
            if ($totnumb == 0) {
                $noantre = $str.'00001';
            } else {
                $totnumb++;
                $tempid = 5 - strlen((string)$totnumb);
                $noid = "";
                for ($i=0;$i<$tempid;$i++) {
                    $noid = $noid."0";
                }
                $noantre = $str.$noid.$totnumb;
            }

            $dataq['schedule_id'] = $jadwal->id;
            $dataq['post_id'] = $post->id;
            $dataq['number'] = $noantre;

            $queue = Queue::create($dataq);
            $post->schedule = 'true';
            $post->update();
            return redirect("/civitas/post/schedule/".$uuid);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function pilihJadwal($uuid)
    {
        $post = Post::where('uuid',$uuid)->get()->first();
        $categories = Category::all();
        return view('schedule.view',compact('post','categories'));
    }
}

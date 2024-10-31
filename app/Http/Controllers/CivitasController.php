<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Civitas;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $civitas = Civitas::where('user_id',Auth::user()->id)->first();

        return view('civitas.profile', compact('civitas'));
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
        $validate = $request->validate([
            'nim' => ['required','unique:civitas'],
            'fakultas' => ['required'],
            'prodi' => ['required'],
            'address' => ['required']
        ]);
        $validate['user_id'] = Auth::user()->id;

        $civitas = Civitas::create($validate);

        if ($civitas) {
            return $civitas;
        }

        return dd('Gagal daftar!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Civitas $civitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Civitas $civitas)
    {
        $data = $civitas->where('user_id',Auth::user()->id)->get()->first();
        return view('civitas.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Civitas $civitas)
    {
        $validatedData = $request->validate([
            'fakultas' => 'sometimes|string',
            'prodi' => 'sometimes|string',
            'address' => 'sometimes|string',
            // Additional validation rules for partial updates
        ]);

        $civitas->where('user_id',Auth::user()->id)->update($validatedData);

        return redirect('/civitas');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Civitas $civitas)
    {
        //
    }

    public function uploadPhoto(Request $request)
    {
        $filevalidate = $request->validate([
            'filephoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('filephoto')) {
            // Store the file and get its path
            $filePath = $request->file('filephoto')->store('civitas', 'public');

            $civitas = Civitas::where('user_id',Auth::user()->id)->first();
            
            if (!is_null($civitas->photo)) {
                //Storage::delete($civitas->photo);
                Storage::disk('public')->delete($civitas->photo);
            } 
            $civitas->photo = $filePath;
            $civitas->update();
            return redirect('/civitas/profile');
            // Save the file path in the incoming fields array
            //$incomingFields['photo'] = $filePath; // or 'photo_path'
        }
    }

    public function post()
    {
        $categories = Category::all();
        return view('civitas.post',compact('categories'));
    }
}

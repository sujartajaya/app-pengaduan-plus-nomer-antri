<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Civitas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            //return view('welcome');
            $civitas = Civitas::where('user_id',Auth::user()->id)->get()->first();
            $stdjson = json_encode($civitas);
            $data = json_decode($stdjson);
            if (Auth::user()->type == 'civitas') {
                if (empty($data)) {
                    /** dijalankan jika pendaftaran student belum lengkap setelah sigup */
                    $name = Auth::user()->name;
                    /** view complate form register */
                    return view('civitas.register',compact('name'));
                    //dd('Data perlu dilengkapi');
                }
                /** view profile civitas */
                return redirect('/civitas/profile');
            } else {
                /** redirect admin */
            }
            
        }else{
            return redirect('/user/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.register');
    }


    public function login()
    {
        return view('user.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:dns','unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['min:8']
        ]);

        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);

        if ($user) {
            /** setelah daftar user disuruh login pake email dan password yang baru didaftar */
            //return view('login.index')->with('message','Please login using your email and password!');
            return $user;
        } 

        return dd('Gagal daftar!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['min:8']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, Auth::user()->password);
        if($currentPasswordStatus){
             User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('message','Password Updated Successfully');
        } else {
            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

         return back()->with('loginError','Login Failed!');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

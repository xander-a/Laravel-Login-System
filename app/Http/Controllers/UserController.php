<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = '';
        return view('user.index', array('user' => $user, 'title' => 'Index Page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('user.register', array('title' => 'Register Page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Hash the password using bcrypt
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        // Flash message to show that user is added successfully
        Session::flash('flash_message', 'User registered successfully!');

        User::create($validatedData);

        return redirect()->route('user.login');


    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function login()
    {
        return view('user.login', array('title' => 'Login Page'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            return redirect()->route('user.index');
        } else {
            return redirect()->route('user.login');
        }  
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function account()
    {
        return view('user.account', array('title' => 'Account Page'));

    }
}

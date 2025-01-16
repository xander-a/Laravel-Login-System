<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    Index Page:
    - it will link you to index page or landing page
    */   
    public function index()
    {
        $user = '';
        return view('user.index', array('user' => $user, 'title' => 'Index Page'));
    }
    
    /* 
    Register Page:
    - it will redirect you to register page
    */
    public function register()
    {
        return view('user.register', array('title' => 'Register Page'));
    }

    /* 
    - This handles POST method 
    - It will store the user data to the database
    */
    public function store(Request $request)
    {
        // Validate the data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed|alphaNum',
        ]);

        // Hash the password using bcrypt
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        // Flash message to show that user is registered successfully
        Session::flash('flash_message', 'User registered successfully!');

        // Insert the data to the database
        User::create($validatedData);

        return redirect()->route('user.login');
    }

    /* 
    Login Page:
    - Redirect to login page
    */
    public function login()
    {
        return view('user.login', array('title' => 'Login Page'));

    }

    /* 
    - Authenticate the user
    */

    public function authenticate(Request $request)
    {
        // Checks if the user is in database
        // it maps the value to keys 'email' and 'password'
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            return redirect()->route('user.index');
        } else {
            // Flash message to show that user is not registered
            Session::flash('flash_message', 'Invalid email or password. Try Again!');

            // Redirect back
            return redirect()->back();  
        }  
    }

    /* 
    Logout:
    - it logouts user 
    */
    public function logout(){
        // logout the current user
        Auth::logout();

        // Message
        Session::flash('flash_message', 'You logged out successfully!');

        // Redirect to login page
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

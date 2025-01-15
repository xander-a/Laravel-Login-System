@extends('layouts.master')

@section('title', $title)

@section('sidebar')
    @parent
    // you can add something here
@endsection

@section('content') 
    <h1>{{ $title }}</h1>
    
    @if(Auth::check())
        Logged in as:
        
        
            Name: {{ Auth::user()->name }}<br>
            Email: {{ Auth::user()->email }}<br>
            
            <a href="{{ url('user/account') }}">My Account</a> | 
            <a href="{{ url('user/logout') }}">Logout</a> <!-- Can use url() or route() helper functions for URL -->
        
    @else
        
            <a href="{{ route('user.login') }}">Login</a> | 
            <a href="{{ route('user.register') }}">Register</a> 
        
    @endif
        
@endsection
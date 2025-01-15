@extends('layouts.master')

@section('title', $title)

@section('sidebar')
    @parent
    // you can add something here
@endsection

@section('content')

    <h1>{{ $title }}</h1>

    <form action="{{ route('user.store') }}" method="POST">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <table>
        <tr>
            <td><label for="name" class="control-label">Name</label></td>
            <td>
                <input type="text" name="name" id="name" class="form-control" size="40">
            </td>
        </tr>
        <tr>
            <td><label for="email" class="control-label">Email</label></td>
            <td>
                <input type="email" name="email" id="email" class="form-control" size="40">
            </td>
        </tr>
        <tr>
            <td><label for="password" class="control-label">Password</label></td>
            <td>
                <input type="password" name="password" id="password" class="form-control" size="64">
            </td>
        </tr>
        <tr>
            <td><label for="password_confirmation" class="control-label">Confirm Password</label></td>
            <td>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" size="64">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-submit">Submit</button>
            </td>
        </tr>
    </table>
</form>


@endsection
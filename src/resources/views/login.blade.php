@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="wrapper">
        <div class="container">
            <h1>Login</h1>
            <form class="form">
                <input type="email" name="email" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button type="'submit" id="login-button">Login</button>
            </form>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

@endsection
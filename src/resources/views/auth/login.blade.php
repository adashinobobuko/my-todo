@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="wrapper">
    <div class="container">
        <h1 class="login-title">Login</h1>
        @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
        @endif
        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email入力欄 -->
            <input type="email" name="email" placeholder="Email" required autofocus>

            <!-- Password入力欄 -->
            <input type="password" name="password" placeholder="Password" required>

            <!-- サブミットボタン -->
            <button type="submit" id="login-button">Login</button>
            
        </form>
        <div class="sign-up">
            <a href="/register">Sign up</a>
        </div>
    </div>
</div>
@endsection

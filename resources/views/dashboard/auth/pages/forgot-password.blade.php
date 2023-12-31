@extends('dashboard.auth.app')
@section('form-title', 'Lupa Password')
@section('form-caption', 'Masukkan email anda')
@section('form-authentication')
    <form action="{{ route('forgot-password.store') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Remember your account? <a href="auth-login.html" class="font-bold">Log
                in</a>.
        </p>
    </div>
@endsection

@extends('layouts.main')
@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                    <div class="text w-100">
                        <img src="{{ asset('assets/img/favicon/favicon.png') }}" class="mt-3" style="max-height: 70px; width: auto;" />								
                            <p>Belum memiliki akun?</p>
                        <a href="/register" class="btn btn-white btn-outline-white">Sign Up</a>
                    </div>
                </div>
                <div class="login-wrap p-4 p-lg-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Sign In</h3>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="/login" class="signin-form" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="label" for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button style="background-color: #9CFF2E;" type="submit" class="form-control btn btn-secondary submit px-3">Sign In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-wrap mb-0">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
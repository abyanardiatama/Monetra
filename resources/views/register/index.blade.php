@extends('layouts.mainRegister')
@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last" style="border-radius: 0 20px 20px 0">
                    <div class="text w-100">
                        <img src="{{ asset('assets/img/favicon/favicon.png') }}" class="mt-3" style="max-height: 70px; width: auto;" />
                        <h2 style="color: rgb(255, 255, 255);">Monetra</h2>								
                        <p>Sudah memiliki akun?</p>
                        <a href="/" class="btn btn-white btn-outline-white">Sign In</a>
                    </div>
                </div>
                <div class="login-wrap p-4 p-lg-5" style="border-radius: 20px 0 0 20px">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Sign Up</h3>
                        </div>
                    </div>
                    <form action="/register" class="signup-form" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="label" for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button style="background-color: #9CFF2E;" type="submit" class="form-control btn btn-secondary submit px-3">Create Account</button>
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
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
@extends('dashboard.layouts.main')
@include('dashboard.partials.sidebar')

@section('container')
<div class="space-between">
    <div>
        <h3>Pengaturan Pengguna</h3>
    </div>
    <div>
        @if (session('success'))
            <div class="session-success" role="alert">
                <span><i class='bx bxs-info-circle' ></i>
                    {{ session('success') }}
                </span>
            </div>
        @elseif (session('error'))
            <div class="session-error" role="alert">
                <span><i class='bx bxs-error-circle' ></i>
                    {{ session('error') }}
                </span>
            </div>
        @endif
    </div>
</div>
<div class="summary_container">
    <div class="card-medium">
        <h3 style="margin-left: 32px">Update Profile</h3>
        <form style="margin: 32px" action="/dashboard/user/profile/{{ $user->id }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name" class="modal__description">Nama</label>
                <input type="text" name="name" class="modal__input" id="name" placeholder="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email" class="modal__description">Email</label>
                <input type="text" name="email" class="modal__input" id="email" placeholder="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <button type="submit" class="modal__button">Update</button>
            </div>
        </form>
    </div>
    <div class="card-medium">
        <h3 style="margin-left: 32px">Update Password</h3>
        <form style="margin: 32px" action="/dashboard/user/password/{{ $user->id }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="Oldpassword" class="modal__description">Password Lama</label>
                <input type="password" name="Oldpassword" class="modal__input" id="Oldpassword" placeholder="Masukkan Password Lama" required>
            </div>
            <div class="form-group">
                <label for="Newpassword" class="modal__description">Password Baru</label>
                <input type="password" name="Newpassword" class="modal__input" id="Newpassword" placeholder="Masukkan Password Baru" required>
            </div>
            <div class="form-group">
                <button type="submit" class="modal__button">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Profil Petugas')

@section('content')
    <h1>Profil Petugas</h1>

    <div>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role ?? 'Petugas') }}</p>
    </div>

    <hr>

    <h2>Ganti Password</h2>

    <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password">Password Lama</label>
            <input type="password" name="current_password" id="current_password">
            @error('current_password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit" class="btn">Simpan Password</button>
    </form>
@endsection
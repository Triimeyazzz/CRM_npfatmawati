@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="border px-4 py-2 w-full" value="{{ $user->name }}" required>
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="border px-4 py-2 w-full" value="{{ $user->email }}" required>
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label>Password (leave blank to keep current)</label>
            <input type="password" name="password" class="border px-4 py-2 w-full">
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="border px-4 py-2 w-full">
        </div>

        <div class="mb-4">
            <label>Phone Number</label>
            <input type="text" name="nomor_hp" class="border px-4 py-2 w-full" value="{{ $user->nomor_hp }}">
            @error('nomor_hp')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label>Address</label>
            <textarea name="alamat" class="border px-4 py-2 w-full">{{ $user->alamat }}</textarea>
            @error('alamat')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label>Role</label>
            <select name="role" class="border px-4 py-2 w-full" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Profile Picture</label>
            <input type="file" name="profile_picture" class="border px-4 py-2 w-full">
            @error('profile_picture')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
    </form>
</div>
@endsection

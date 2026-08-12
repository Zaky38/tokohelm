@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <!-- BACK -->
        <div class="col-md-12">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- BREADCRUMB -->
        <div class="col-md-12 mt-2">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>

        <!-- DATA PROFILE -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-user"></i> My Profile</h4>

                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td width="10">:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <td>{{ $user->nohp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $user->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- FORM EDIT -->
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-pencil-alt"></i> Edit Profile</h4>


        <!-- FORM EDIT -->
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">

                    <!-- BUTTON -->
                    <button class="btn btn-warning mb-3" onclick="toggleProfile()">
                        <i class="fa fa-pencil-alt"></i> Edit Profile
                    </button>

                    <div id="formProfile" style="display:none;">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>

                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NO HP -->
                        <div class="mb-3">
                            <label>No HP</label>
                            <input type="text" name="nohp"
                                   class="form-control @error('nohp') is-invalid @enderror"
                                   value="{{ old('nohp', $user->nohp) }}">

                            @error('nohp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ALAMAT -->
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat"
                                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $user->alamat) }}</textarea>

                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label>Password (opsional)</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- KONFIRM PASSWORD -->
                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control">
                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-success">
                            Simpan Perubahan
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
function toggleProfile(){
    let form = document.getElementById("formProfile")
    form.style.display = (form.style.display === "none") ? "block" : "none"
}
</script>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | {{ $user->name }}</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <p>Nama : {{ $user->name }}</p>
                        <p>Email : {{ $user->email }}</p>
                        <p>Role : {{ $user->is_admin ? 'Admin' : 'Member' }}</p>

                        <form action="{{ route('edit_profile', $user) }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" placeholder="Masukkan Nama" value="{{ $user->name }}"
                                        class=" form-control" id="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password :
                                </label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" placeholder="Masukkan password"
                                        class=" form-control" id="password">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password :
                                </label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_confirmation"
                                        placeholder="Masukkan konfirmasi password" class=" form-control"
                                        id="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>
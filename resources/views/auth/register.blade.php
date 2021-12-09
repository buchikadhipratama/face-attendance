@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper"
                                style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

                            </div>
                        </div>
                        <div class="col-md-8 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Sinar<span>Nadi</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">Create a new account.</h5>


                                <form action="/register" method="POST" class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="Full Name" required autofocus value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror" id="username"
                                            placeholder="Username" required autofocus value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Role --}}
                                    <div class="form-group">
                                        <label for="Role">Employment</label>
                                        <select class="form-control @error('role') is-invalid @enderror" name="role"
                                            id="role" required>
                                            <option selected disabled value="0">Choose your Role</option>
                                            @foreach ($roles as $r)
                                                <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- email --}}
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email" required value="{{ old('email') }}">
                                    </div>

                                    {{-- password --}}
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Password" required>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary mr-2 mb-2 mb-md-0" type="submit">Sing up</button>
                                    </div>
                                    <a href="{{ url('/login') }}" class="d-block mt-3 text-muted">Already a user?
                                        Sign in</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

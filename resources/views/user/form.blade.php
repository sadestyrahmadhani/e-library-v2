@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users') }}" data-toggle="ajax">Users</a>
    </li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@endsection

@section('content')

@session('errors')
    <div class="alert alert-danger">{{session('errors')}}</div>
@endsession

<div class="col-md-6 col-sm-8 col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}">
                    @error('name')
                        <i class="invalid-feedback">{{ $message }}</i>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="off" value="{{ isset($data) ? $data->email : '' }}">
                            @error('email')
                                <i class="invalid-feedback">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" autocomplete="off" value="{{ isset($data) ? $data->username : '' }}">
                            @error('username')
                                <i class="invalid-feedback">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off" {{ isset($data) ? 'disabled' : '' }}>
                            @error('password')
                                <i class="invalid-feedback">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password" autocomplete="off" {{ isset($data) ? 'disabled' : '' }}>
                            @error('confirm_password')
                                <i class="invalid-feedback">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Role</label>
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="">Pilih Roles</option>
                        <option value="Administrator" {{ isset($data) && $data->role == 'Administrator' ? 'selected' : '' }} >Administrator</option>
                        <option value="Member" {{ isset($data) && $data->role == 'Member' ? 'selected' : '' }}>Member</option>
                    </select>
                    @error('role')
                        <i class="invalid-feedback">{{$message}}</i>
                    @enderror
                </div>
                <hr>
                <div class="form-group text-right">
                    <a class="btn btn-danger" type="button" href="{{ route('admin.users') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
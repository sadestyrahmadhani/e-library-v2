@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.members')}}">Anggota</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')
<div class="col-md-6 col-sm-9">
    <div class="card">
        <div class="card-body">
            <form action="{{$action}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama" autocomplete="off" value="{{isset($data) ? $data->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" value="{{isset($data) ? $data->email : ''}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">No. Telp</label>
                    <input type="tel" name="phone" class="form-control" placeholder="No. Telp" autocomplete="off" value="{{isset($data) ? $data->phone : ''}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" placeholder="Alamat" autocomplete="off">{{isset($data) ? $data->address : ''}}</textarea>
                </div>
                <div class="col-12 text-end">
                    <a href="{{route('admin.members')}}" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-papper-plane"></i>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
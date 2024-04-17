@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.books')}}">Books</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')
<div class="col-md-6 col-sm-9">
    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off" value="{{isset($data) ? $data->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Tahun Terbit</label>
                    <input type="text" class="form-control" id="publication_year" name="publication_year" placeholder="Tahun Terbit" autocomplete="off" value="{{isset($data) ? $data->publication_year : date('Y')}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="author" placeholder="Penerbit" autocomplete="off" value="{{isset($data) ? $data->author : ''}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Genre</label>
                    <select name="genre_id" id="" class="form-control select2">
                        <option value="">Pilih genre</option>
                        @foreach ($genres as $item)
                            <option value="{{ $item->id }}" {{ isset($data)  && $data->genre_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea name="description" id="" rows="4" class="form-control">{{ isset($data) ? $data->description :'' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Images</label>
                    <input type="file" name="file" class="form-control-file dropify">
                </div>
                <hr>
                <div class="col-12 text-end">
                    <a href="" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i>  submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.dropify').dropify()

    $('#publication_year').datepicker({
        format: 'yyyy',
        date: new Date()
    })

    $('.select2').select2()
</script>
@endsection
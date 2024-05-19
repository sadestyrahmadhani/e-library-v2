@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Books</li>
</ol>
@endsection

@section('content')

@session('success')
    <div class="alert alert-success"><strong>Perhatian : </strong>{{ session('success') }}</div>
@endsession

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-1">
            <a class="btn btn-primary" href="{{ route('admin.books.create') }}"><i class="fa fa-plus"></i> Tambah</a>
        </div>
        <table class="table zero-configuration" id="dataTable" width="100%">
            <thead>
                <th>No.</th>
                <th>Images</th>
                <th>Nama</th>
                <th>Deskrisi</th>
                <th>Tahun Terbit</th>
                <th>Penulis</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($books as $item)
                    <tr>
                        <td width="5%">{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/images/books/'. $item->picture) }}" alt="cover buku" height="100"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->publication_year }}</td>
                        <td>{{ $item->author }}</td>
                        <td width="150">
                            <a href="{{ route('admin.books.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="feather icon-edit"></i></a>
                            <button type="button" data-toggle="modal" data-target="#modal{{$item->id}}" class="btn btn-sm btn-outline-danger"><i class="feather icon-trash"></i></button>
                            <div class="modal fade" id="modal{{$item->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.books.delete', $item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-header"><h5 class="modal-title">Hapus?</h5></div>
                                            <div class="modal-body">
                                                Anda yakin ingin melanjutkan menghapus data?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-primary" type="submit">Ya, lanjutkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#dataTable').DataTable() 
</script>
@endsection
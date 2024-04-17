@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}" data-toggle="ajax">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
@endsection

@section('content')

@session('success')
<div class="alert alert-success"><strong>Perhatian : </strong>{{ session('success') }}</div>
@endsession

<div class="card">
    <div class="card-body">
        <div class="col-12 text-right mb-1">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i>
                Tambah</button>
        </div>
        <table class="table zero-configuration" id="dataTable" width="100%">
            <thead>
                <th>No.</th>
                <th>Nama</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($genres as $item)
                <tr>
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td width="150">
                        <button data-toggle="modal" data-target="#modalEdit{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary"><i class="feather icon-edit"></i></button>
                        <div class="modal fade" id="modalEdit{{ $item->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.genres.update', $item->id) }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Genre</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    placeholder="Name" value="{{ $item->name }}" required>
                                                @error('name')
                                                <i class="invalid-feedback">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="modal"
                                                data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <button type="button" data-toggle="modal" data-target="#modal{{$item->id}}"
                            class="btn btn-sm btn-outline-danger"><i class="feather icon-trash"></i></button>
                        <div class="modal fade" id="modal{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.genres.delete', $item->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus?</h5>
                                        </div>
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

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.genres.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Genre</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Name" required>
                        @error('name')
                        <i class="invalid-feedback">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="modal" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#dataTable').DataTable()
</script>
@endsection
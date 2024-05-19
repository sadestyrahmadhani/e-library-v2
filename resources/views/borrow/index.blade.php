@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Peminjaman</li>
</ol>
@endsection

@section('content')

@session('success')
<div class="alert alert-success"><strong>Perhatian :</strong>{{session('success')}}</div>
@endsession

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $msg)
        <li>{{$msg}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('admin.borrows.checkout')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card mb-2" style="height: calc(100% - 1.3rem) !important">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" readonly class="form-control" value="{{date('Y-m-d H:i')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Masukkan kode buku</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan kode buku">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalDaftarBuku"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-2">
                <div class="card-body">
                    <label for="">Anggota</label>
                    <select class="form-control select2" name="member_id">
                        <option value="">Pilih Anggota</option>
                        @foreach($members as $item)
                        <option value="{{$item->id}}" {{old('member_id') != '' ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    <a href="{{route('admin.members.create')}}" class="nav-link">Tambah Anggota</a>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-danger w-100" href="{{route('admin.dashboard')}}">Batal</a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" type="button" data-toggle="modal" data-target="#modalCheckout"><i class="fa fa-paper-plane"></i> Checkout</button>
                            <div class="modal fade" id="modalCheckout">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa fa-paper-plane"></i> Checkout</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">Tanggal Peminjaman</label>
                                                <input type="text" readonly class="form-control" value="{{date('Y-m-d H:i')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tanggal Pengembalian</label>
                                                <input type="date" class="form-control" id="dateReturnBook" name="date_return">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <table id="dataTable" class="zero-configuration table" width="100%">
            <thead>
                <th>No.</th>
                <th>Images</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($transaction as $item)
                <tr>
                    <td width="5%">{{$loop->iteration}}</td>
                    <td><img src="{{asset('storage/images/books/'. $item->book->picture)}}" alt="cover buku" height="100"></td>
                    <td width="10%">{{$item->book->name}}</td>
                    <td>{{$item->book->description}}</td>
                    <td width="150" class="text-center">
                        <button type="button" data-toggle="modal" data-target="#modal{{$item->id}}" class="btn btn-sm btn-outline-danger"><i class="feather icon-trash"></i></button>
                        <div class="modal fade" id="modal{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.borrows.delete', $item->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus?</h5>
                                        </div>
                                        <div class="modal-body">Anda yakin ingin melanjutkan menghapus data?</div>
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
<div class="modal fade" id="modalDaftarBuku">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title font-weight-bold p-1"><i class="feather icon-book mr-1"></i>Data Buku</h2>
                <button class="float-right btn btn-default font-large-1" data-dismiss="modal" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table zero-configuration" id="modalDataTable">
                        <thead>
                            <th>No.</th>
                            <th>Nama</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($books as $item)
                            <tr>
                                <td width="5%">{{$loop->iteration}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/images/books/'.$item->picture)}}" alt="cover buku" height="100" class="d-flex">
                                        <div class="ml-1">
                                            <i class="badge badge-primary">{{$item->genre->name}}</i>
                                            <h5 class="font-weight-bold">{{$item->name}}</h5>
                                            <p class="m-0 p-0 small text-muted">Penulis : {{$item->author}}</p>
                                            <p class="m-0 p-0 small text-muted">Tahun Terbit : {{$item->publication_year}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{route('admin.borrows.store', $item->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-primary btn-sm"><i class="feather icon-chevron-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#dataTable').DataTable()
    $('#modalDataTable').DataTable()
    $('.select2').select2()
    // $('#dateReturnBook').datepicker({
    //     format: 'yyyy',
    //     date: new Date()
    // })
</script>
@endsection
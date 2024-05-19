@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.book-returns')}}">Pengembalian</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
</ol>
@endsection

@section('content')

@session('success')
<div class="alert alert-success"><strong>Perhatian :</strong>{{session('success')}}</div>
@endsession

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Information</h5>
        <hr>
        <div class="row">
            <div class="col-6">
                <table cellpadding="8">
                    <tr>    
                        <td class="font-weight-bold">Kode Transaksi</td>
                        <td>: {{$transaction->transaction_code}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Nama Anggota</td>
                        <td>: {{$transaction->member->name}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tanggal Peminjaman</td>
                        <td>: {{$transaction->date}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table cellpadding="8">
                    <tr>
                        <td class="font-weight-bold">Status</td>
                        <td>: <i class="badge {{$transaction->status == 'returned' ? 'badge-primary' : 'badge-warning'}}">{{$transaction->status == 'returned' ? 'Selesai' : 'Belum Dikembalikan'}}</i></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Jumlah Denda</td>
                        <td>
                            : Rp.{{number_format(1000*$late, 0, ',', '.')}}
                            @if($late > 0)
                                -
                                <i class="text-danger small">Telat {{$late}} hari.</i>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <td width="5%">No.</td>
                    <td>Nama Buku</td>
                    <td>Deskripsi</td>
                    <td>Status</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->transactionDetail as $item)
                <tr>
                    <td width="5%">{{$loop->iteration}}</td>
                    <td width="20%">
                        <div class="d-flex align-item-center">
                            <img src="{{asset('/storage/images/books/'.$item->book->picture)}}" alt="" height="100">
                            <div class="ml-1">
                                <i class="badge badge-primary">{{$item->book->genre->name}}</i>
                                <h5 class="font-weight-bold">{{$item->book->name}}</h5>
                                <p class="m-0 p-0 small text-muted">Penulis : {{$item->book->author}}</p>
                                <p class="m-0 p-0 small text-muted">Tahun Terbit : {{$item->book->publication_year}}</p>
                            </div>
                        </div> 
                    </td>
                    <td width="50%">{{$item->book->description}}</td>
                    <td>
                        <i class="badge {{ is_null($item->date_of_return) ? 'badge-warning' : 'badge-primary'}}">{{ is_null($item->date_of_return) ? 'Belum Dikembalikan' : 'Sudah Dikembalikan'}}</i>
                    </td>
                    <td>
                        @if(is_null($item->date_of_return))
                        <a href="{{route('admin.book-returns.returned', $item->id)}}" class="btn btn-primary btn-sm">Kembalikan</a>
                        @endif
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
@extends('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengembalian</li>
</ol>
@endsection

@section('content')

@session('success')
<div class="alert alert-success"><strong>Perhatian :</strong>{{session('success')}}</div>
@endsession

<div class="card" style="min-height: 70vh">
    <div class="card-body py-3">
        <div class="col-6 mx-auto mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari transaksi buku">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        @if($transaction->count() > 0)
            <table class="zero-configuration table">
                <thead>
                    <th width="5%">No.</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tenggat Waktu</th>
                    <th>Jumlah Buku</th>
                    <th>Jumlah Denda</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($transaction as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->transaction_code}}</td>
                            <td>{{$item->date}}</td>
                            <td>
                                {{$item->date_of_return}}
                                @if($item->late > 0)
                                    <p class="m-0 p-0">
                                        <i class="text-danger small">Telat {{$item->late}} hari.</i>
                                    </p>
                                @endif
                            </td>
                            <td>{{$item->transactionDetail()->count()}}</td>
                            <td>Rp. {{number_format(1000*$item->late, 0, ',', '.')}}</td>
                            <td>
                                <a href="{{route('admin.book-returns.show', $item->id)}}" class="btn btn-primary btn-sm text-white"><i class="fa fa-eye"></i> Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <img src="{{ asset('storage/images/no-result-found.png')}}" alt="" width="100%">
        @endif
    </div>
</div>

@endsection
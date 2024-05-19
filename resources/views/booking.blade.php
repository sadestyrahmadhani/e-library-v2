@extends('layouts.frontend')

@section('content')
<div class="container my-5">
    <h3 class="mb-5">Data Booking</h3>
    <div class="row mb-3">
        <div class="col-sm-9 col-10">
            <button class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Tambah
            </button>
            <button class="btn btn-warning">
                <i class="fa fa-paper-plane"></i>
                Checkout
            </button>
        </div>
        <div class="col-sm-3 col-2">
            <select name="" id="" class="form-control select2"></select>
        </div>
    </div>
    <div class="table-responsive">
        <table width="100%" class="table table-bordered">
            <thead>
                <th width="5%">No.</th>
                <th>Nama</th>
                <th></th>
            </thead>
            <tbody>
                @if(is_null($transaction))
                <tr>
                    <td colspan="3" class="text-center">
                        <img src="{{ asset('storage/images/no-result-found.png')}}" alt="" width="50%">
                    </td>
                </tr>
                @else
                @foreach($transaction->transactionDetail as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{asset('storage/images/books/'.$item->book->picture)}}" alt="" width="100">
                            <div class="ms-3">
                                <h3>{{$item->book->name}}</h3>
                                <p>{{$item->book->description}}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
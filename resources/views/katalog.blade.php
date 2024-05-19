@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3 col-sm-3 col-12">
            <div class="card shadow-sm rounded">
                <ul class="katalog">
                    <li class="item active">
                        <a href="http://localhost:8000/katalog/all">All</a>
                    </li>
                                            <li class="item">
                            <a href="http://localhost:8000/katalog/60845e48e2g9b9248e1923570dg60bd765bd29g7">Romance</a>
                        </li>
                                            <li class="item">
                            <a href="http://localhost:8000/katalog/86d407d9b8509ge082126167d4b5746e2ge2g95b">Food Recipes</a>
                        </li>
                                            <li class="item">
                            <a href="http://localhost:8000/katalog/4902d7e426gd427e0515718bdg96958b7086g5be">Education</a>
                        </li>
                                            <li class="item">
                            <a href="http://localhost:8000/katalog/b65d709eg027g28d5b3gb14960e764db858e42g9">Comic</a>
                        </li>
                                    </ul>
            </div>
        </div>
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6 col-12 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control form-search" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">  
                        @foreach($books as $item)
                        <div class="col-md-4 col-12">
                            <a href="http://localhost:8000/60845e48e2g9b9248e1923570dg60bd765bd29g7/detail" class="nav-link">
                                <div class="card books shadow-sm">
                                    <span class="latest-books">NEW</span>
                                    <div class="card-body text-dark" style="text-align: justify">
                                        <div class="card-image">
                                            <img src="{{asset('storage/images/books/'.$item->picture)}}" alt="" width="100%">
                                        </div>
                                        <span class="badge bg-primary small">{{ $item->genre->name }}</span>
                                        <h6>{{ $item->name }}</h6>
                                        <p class="text-muted">{{ Str::limit($item->description, 30, '...')}}</p>
                                        <p class="text-end text-muted m-0 p-0" style="font-size: 10px;">{{$item->count_views}} Views</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3 col-sm-3 col-12">
            <div class="card shadow-sm rounded">
                <ul class="katalog">
                    <li class="item {{ request()->path() == 'katalog' ? 'active' : '' }}">
                        <a href="http://localhost:8000/katalog">All</a>
                    </li>
                    @foreach($genres as $item)
                        <li class="item {{ request()->path() == 'katalog/'. $item->id ? 'active' : '' }}">
                            <a href="http://localhost:8000/katalog/{{ $item->id }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
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
                        @if($books->count() > 0)
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
                        @else
                            <img src="{{ asset('storage/images/no-result-found.png') }}" width="100%" class="mx-auto" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
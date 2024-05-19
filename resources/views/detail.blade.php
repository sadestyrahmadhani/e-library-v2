@extends('layouts.frontend')

@section('content')
<div class="col-md-6 col-12 mx-auto my-5">
    <div class="row align-items-center">
        <div class="col-md-4 col-12">
            <img src="{{asset('storage/images/books/'.$book->picture)}}" alt="" width="100%">
        </div>
        <div class="col-md-8 col-12">
            <div class="mx-5">
                <span class="badge bg-primary">{{$book->genre->name}}</span>
                <h2>{{$book->name}}</h2>
                <p>{{$book->description}}</p>
                <table>
                    <tr>
                        <td width="40%">Tahun Terbit</td>
                        <td> : {{$book->publication_year}}</td>
                    </tr>
                    <tr>
                        <td>Penulis</td>
                        <td> : {{$book->author}}</td>
                    </tr>
                </table>
                <button class="btn btn-primary mt-4 px-5 rounded-pill">Booking Now</button>
            </div>
        </div>
    </div>
</div>
<section id="latestBook" class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center mb-5"><span style="border-bottom: 3px solid #68A7AD;padding: 3px">LATEST BOOKS</span></h4>
        <div class="row my-5">
            @foreach($latestBooks as $item)
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('detail', $item->id) }}" class="nav-link">
                    <div class="card books shadow-sm">
                        <span class="latest-books">NEW</span>
                        <div class="card-body text-dark" style="text-align: justify">
                            <div class="card-image">
                                <img src="{{ asset('storage/images/books/'. $item->picture) }}" alt="" width="100%">
                            </div>
                            <span class="badge bg-primary small">{{ ucfirst($item->genre->name) }}</span>
                            <h6>{{ substr($item->name, 0, 26) . (strlen($item->name) > 26 ? '...' : '') }}</h6>
                            <p class="text-muted">{{ substr($item->description, 0, 35) . (strlen($item->description) > 35 ? '...' : '') }}</p>
                            <p class="text-end text-muted m-0 p-0" style="font-size: 10px;">{{ number_format($item->count_views) }} views</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
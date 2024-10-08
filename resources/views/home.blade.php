@extends('layouts.frontend')

@section('content')

{{-- Banner Carousel --}}
<section id="banner" class="container my-3 mb-5">
    <div class="carousel slide" id="bannerControls" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="title">Rapat Stategi Persaingan Perpustakaan Indonesia</div>
                <img src="{{ asset('storage/images/banner/banner-1.jpg') }}" alt="" width="100%">
            </div>
            <div class="carousel-item">
                <div class="title">5 Model Perpustakaan Terkini</div>
                <img src="{{ asset('storage/images/banner/banner-2.jpg') }}" alt="" width="100%">
            </div>
        </div>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bannerControls" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#bannerControls" data-bs-slide-to="1"></button>
            {{-- <button type="button" data-bs-target="#bannerControls" data-bs-slide-to="2"></button> --}}
        </div>
    </div>
</section>
{{-- End Banner Carousel --}}

{{-- Popular Book --}}
<section id="popularBook" class="bg-light py-5">
    <div class="container">
        <h4 class="text-center mb-5"><span style="border-bottom: 3px solid #68A7AD;padding: 3px">POPULAR BOOKS</span></h4>
        <div class="row my-5">
            @foreach($popularBooks as $item)
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('detail', $item->id) }}" class="nav-link">
                    <div class="card books shadow-sm">
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
{{-- End Popular Book --}}
{{-- Latest Book --}}
<section id="latestBook" class="py-5">
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
{{-- End Latest Book --}}

@endsection
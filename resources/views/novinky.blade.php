@extends('layouts.app')
@section('pageTitle', 'Novinky')

@section('content')

@if(count($featuredSliders) > 0)
<!-- Bootstrap Slider -->

<section id="sliderFeatured" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        @foreach($featuredSliders as $featured)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, #000 150%), url('{{ Voyager::image($featured->film->image_big) }}')">
            <a href="/film/{{$featured->film->id}}">
                <div class="slider-header">
                    <div class="header-rating">
                        <i class="fa fa-star"></i>
                        <span class="rating-text ml-3">@if (!is_null($featured->film->rating))<b>{{ $featured->film->rating }}</b>/10 (hodnotené {{ $featured->film->rating_num }}x) @else Zatiaľ nikto nehodnotil. @endif</span>
                    </div>
                    <h1>{{ $featured->film->name }}</h1>
                    <span>{{ $featured->fText }} | {{ $featured->film->year }} | @foreach($featured->film->cats as $cats){{ $loop->first ? '' : ', ' }}{{ $cats->cat }}@endforeach</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#sliderFeatured" role="button" data-slide="prev">
        <span class="left slide-control"><i class="fa fa-angle-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#sliderFeatured" role="button" data-slide="next">
        <span class="right slide-control"><i class="fa fa-angle-right"></i></span>
        <span class="sr-only">Next</span>
    </a>
</section>

@endif

<!-- Content - Filmy -->

<section class="mt-5 mb-5">
    <div class="container">
        <h2>Najlepšie hodnotené filmy</h2>
        
        <div class="cat-slider mt-3"> 
            @foreach ($filmRecords as $film)
                <div class="fs-slider">
                    <a href="/film/{{$film->id}}">
                        <div class="img-zoom">
                            <img src="../storage/{{ $film->image }}" alt="Film Small Image" class="fs-slider-img">
                        </div>
                        <h5 class="slider-film-title">{{ $film->name }}</h5>    
                        <span class="slider-film-year">{{ $film->year }}</span>
                    </a>
                </div>
            @endforeach
        </div>
        
        <br>
        <h2>Najlepšie hodnotené seriály</h2>
        
        <div class="cat-slider mt-3"> 
            @foreach ($showRecords as $show)
                <div class="fs-slider">
                    <a href="/film/{{$show->id}}">
                        <div class="img-zoom">
                            <img src="../storage/{{ $show->image }}" alt="Film Small Image" class="fs-slider-img">
                        </div>
                        <h5 class="slider-film-title">{{ $show->name }}</h5>    
                        <span class="slider-film-year">{{ $show->year }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
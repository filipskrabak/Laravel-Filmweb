@extends('layouts.app')
@section('pageTitle', 'Seriály')

@section('content')

    <div class="container my-5">
        @if(count($cats) > 0)
            @foreach ($cats as $cat)
                @if(count($cat->film) > 0)
                    <div class="cat-single mb-5"> 
                    <h2><a class="genre-link" href="/zaner/serialy/{{ $cat->id }}">{{ $cat->cat }} <i class="fa fa-chevron-circle-right"></i></a></h2>
                        <div class="cat-slider mt-3"> 
                            @foreach ($cat->film as $film)
                                @if($film->type == 'S')
                                    <div class="fs-slider">
                                        <a href="/film/{{$film->id}}">
                                            <div class="img-zoom">
                                                <img src="../storage/{{ $film->image }}" alt="Film Small Image" class="fs-slider-img">
                                            </div>
                                            <h5 class="slider-film-title">{{ $film->name }}</h5>    
                                            <span class="slider-film-year">{{ $film->year }}</span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <h1>Neboli definované žiadne kategórie.</h1>
        @endif
    </div>
    
@endsection
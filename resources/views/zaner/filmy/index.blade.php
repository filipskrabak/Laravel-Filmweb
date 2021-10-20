@extends('layouts.app')
@section('pageTitle', $cat->cat)

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            @if(count($cat->film) > 0)
            <h1 class="mb-5">Filmy: {{$cat->cat}}</h1>
                <div class="row">
                    @foreach($cat->film as $film)
                        @if($film->type == 'F')
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="fs-slider mb-3">
                                    <a href="/film/{{$film->id}}">
                                        <div class="img-zoom">
                                            <img src="{{ asset('/storage/') }}/{{$film->image}}" alt="Film Small Image" class="fs-slider-img">
                                        </div>
                                        <h5 class="slider-film-title">{{ $film->name }}</h5>    
                                        <span class="slider-film-year">{{ $film->year }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
            <h1>Táto kategória neobsahuje žiadny záznam.</h1>
            @endif   
        </div>
    </div>
</div>
    
@endsection
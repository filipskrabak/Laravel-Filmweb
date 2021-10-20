@extends('layouts.app')
@section('pageTitle', 'Hľadať')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            @if(count($films) > 0)
            <h1 class="mb-5">Nájdené výsledky:</h1>
                <div class="row">
                    @foreach($films as $film)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="fs-slider mb-3">
                            <a href="/film/{{$film->id}}">
                                <div class="img-zoom">
                                    <img src="../storage/{{ $film->image }}" alt="Film Small Image" class="fs-slider-img">
                                </div>
                                <h5 class="slider-film-title">{{ $film->name }}</h5>    
                                <span class="slider-film-year">{{ $film->year }}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
            <h1>Pre zadaný výraz nebol nájdený žiadny film v databáze.</h1>
            @endif   
        </div>
    </div>
</div>
    
@endsection
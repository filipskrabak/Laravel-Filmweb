@extends('layouts.app')
@section('pageTitle', $film->name)

@section('content')

    <section class="container-fluid p-0" id="fs-header-img-container">
        <div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>   

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" allowfullscreen="allowfullscreen" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="header-big-img">
            <img src="../storage/{{ $film->image_big }}" alt="Film Header Image" class="fs-header-img">
        </div>
        <div class="header-text-overlay">
            <div class="header-rating">
                <i class="fa fa-star"></i>
                <span class="rating-text ml-3">@if (!is_null($film->rating))<b>{{ $film->rating }}</b>/10 ({{ $film->rating_num }}) @else Zatiaľ nikto nehodnotil. @endif</span>
            </div>
            <div class="header-main-text">
                <h1>{{ $film->name }}</h1>
                <span>{{ $film->year }} | {{ $film->minutes }}min | @foreach($film->cats as $cats){{ $loop->first ? '' : ', ' }}{{ $cats->cat }}@endforeach</span>
            </div>
            <div class="header-main-text header-buttons">
                <a href="#trailerModal" class="trailer-video" data-toggle="modal" data-src="{{ $film->trailer }}" data-target="#trailerModal">
                    <i class="fa fa-play-circle"></i>
                    <span class="underbuttontext">Trailer</span>
                </a>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-3">
                <img src="../storage/{{ $film->image }}" alt="Film Small Image" class="fs-small-img mx-auto d-block">
            </div>
            <div class="col-sm-9">
                <h2>{{ $film->name }}</h2>
                <i class="fa fa-map-marker"></i> {{ $film->country }}
                <br><br>
                <span><b>Popis:</b> {{ $film->desc }}</span>
                <br><br>
                <span><b>Hrajú:</b> {{ $film->actors }}</span>
            </div>
        </div>
    </div>

    <div class="container my-5">

    @include('inc.errors')

    @if($userHasRated == 0)
        {{ Form::open(['url' => 'film/'.$film->id.'/submit']) }}
            <div class="form-group">
                {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Napíšte komentár k tomuto filmu...'])}}
            </div>
            <div class="form-group stars my-1">
                <h6>Vaše hodnotenie</h6>
                <input class="star star-5" id="star-5" type="radio" name="rating" value="10"/>
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" name="rating" value="7.5"/>
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" name="rating" value="5"/>
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" name="rating" value="2.5"/>
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
                <label class="star star-1" for="star-1"></label>

            </div>
            {{Form::submit('Odoslať', ['class' => 'btn btn-dark'])}}
        {{ Form::close() }}
    @endif

    </div>

    <div class="container my-5">
        <h2>Komentáre</h2>
        @if(count($records) > 0)
            @foreach($records as $record)
            <div class="commentbox my-3">
                <h5><strong>{{$record->user->name}}</strong> @if(Auth::id() == $record->user->id) <a href="comment/{{ $record->id }}/delete"><i class="fa fa-trash"></i></a> @endif<span class="commentheading">@for($i = 0; $i <= 10; $i+=2.5) @if($i <= $record->rating) <i class="fa fa-star commentstar-gold"></i> @else <i class="fa fa-star commentstar-gray"></i> @endif @endfor</span></h5>
                <span>{{$record->comment}}</span>
            </div>
            @endforeach
        @else
        <div class="my-3"><h4>Zatiaľ nikto nekomentoval.</h4></div>
        @endif    
    </div>
    
@endsection
@extends('layouts.app')
@section('pageTitle', 'Pridať film')

@section('content')

    <div class="container my-5">

        @include('inc.errors')

        {{ Form::open(['url' => 'pridat-film/submit', 'files' => true, 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('name', 'Názov filmu')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Zadaj názov'])}}
            </div>
            @if(count($cats) > 0)
                <div class="form-group">
                <?php /* {{Form::label('cat', 'Zvoľ kategórie')}}
                    @foreach ($cats as $cat)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="CB{{ $cat->id }}" value="{{ $cat->id }}" name="cats[]">
                        <label class="custom-control-label" for="CB{{ $cat->id }}">{{ $cat->cat }}</label>
                    </div>
                    @endforeach*/ ?>

                    <select id="cats_id[]" name="cats_id[]" multiple>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->cat }}</option>
                        @endforeach
                    </select>
                </div>
            @endif  
            <div class="form-group">
                {{Form::label('year', 'Rok')}}
                {{Form::text('year', '', ['class' => 'form-control', 'placeholder' => 'Rok'])}}
            </div>
            <div class="form-group">
                {{Form::label('country', 'Krajina')}}
                {{Form::text('country', '', ['class' => 'form-control', 'placeholder' => 'Krajina'])}}
            </div>
            <div class="form-group">
                {{Form::label('minutes', 'Dĺžka (min)')}}
                {{Form::text('minutes', '', ['class' => 'form-control', 'placeholder' => 'Dĺžka (min)'])}}
            </div>
            <div class="form-group">
                {{Form::label('actors', 'Herci')}}
                {{Form::textarea('actors', '', ['class' => 'form-control', 'placeholder' => 'Herci'])}}
            </div>
            <div class="form-group">
                {{Form::label('desc', 'Popis')}}
                {{Form::textarea('desc', '', ['class' => 'form-control', 'placeholder' => 'Popis'])}}
            </div>
            <div class="form-group">
                {{Form::label('trailer', 'Trailer')}}
                {{Form::text('trailer', '', ['class' => 'form-control', 'placeholder' => 'YouTube Embed Video URL'])}}
            </div>
            <div class="form-group">
                {{Form::label('type', 'Vyber typ')}}
                {{Form::select('type', ['F' => 'Film', 'S' => 'Seriál'], 'F', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('image', 'Obrázok (malý)')}}
                {{Form::file('image')}}
            </div>
            <div class="form-group">
                {{Form::label('image_big', 'Obrázok (veľký)')}}
                {{Form::file('image_big')}}
            </div>
            {{Form::submit('Odoslať', ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}

    </div>

    <div class="container my-5">
    <h1>Filmy</h1>
    @if(count($records) > 0)
        @foreach($records as $record)
        <ul class="list-group">
        <li class="list-group-item"> ID: {{$record->id}}</li>
            <li class="list-group-item"> Názov filmu: {{$record->name}}</li>
            <li class="list-group-item"> Kategória / žáner: {{$record->cat}}</li>
            <li class="list-group-item"> Hodnotenie: {{$record->rating}}</li>
            <li class="list-group-item"> Rok: {{$record->year}}</li>
            <li class="list-group-item"> Krajina: {{$record->country}}</li>
            <li class="list-group-item"> Dĺžka (min): {{$record->minutes}}</li>
            <li class="list-group-item"> Herci: {{$record->actors}}</li>
            <li class="list-group-item"> Popis: {{$record->desc}}</li>
        </ul>
        @endforeach
    @endif    

    </div>
    
@endsection
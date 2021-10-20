<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Cat;
use App\Featured;
use App\Comment;
use Auth;

class FilmsController extends Controller
{
    public function submit(Request $request)
    {
        // Skontrolujeme, ci je vsetko zadane

        $this->validate($request, [
            'name' => 'required',
            'year' => 'required',
            'country' => 'required',
            'minutes' => 'required',
            'actors' => 'required',
            'desc' => 'required',
            'trailer' => 'required',
            'image' => 'image|max:1999',
            'image_big' => 'image|max:1999'
        ]);

        // Spracovanie nazvu suboru img

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('image')->storeAs('public/previews', $filenameToStore);

        $filenameWithExt = $request->file('image_big')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image_big')->getClientOriginalExtension();
        $filenameToStore2 = $filename.'_'.time().'.'.$extension;

        $path2 = $request->file('image_big')->storeAs('public/previews', $filenameToStore2);
        
        // Vytvorenie zaznamu

        $record = new Film;
        $record->name = $request->input('name');
        $record->year = $request->input('year');
        $record->country = $request->input('country');
        $record->minutes = $request->input('minutes');
        $record->actors = $request->input('actors');
        $record->desc = $request->input('desc');
        $record->trailer = $request->input('trailer');
        $record->type = $request->input('type');
        $record->image = $filenameToStore;
        $record->image_big = $filenameToStore2;

        // Ulozenie zaznamu

        $record->save();

        $cats = $request->input('cats_id');
        $record->cats()->attach($cats, ['film_id' => $record->id]);
        
        // Presmerovanie

        return redirect('/pridat-film')->with('success', 'Záznam bol úspešne pridaný.');
    }

    public function getRecords(){
        $records = Film::all();
        $cats = Cat::all();

        return view('pridat-film', compact('cats'))->with('records', $records);
    }

    public function search(Request $request) {
        $search = $request->get('search');
        $films = Film::where('name', 'like', '%'.$search.'%')->get();

        return view('search', compact('films'));
    }

    public function viewFilms(){
        $cats = Cat::whereHas('film', function($q){
            $q->where('type', '=', 'F');
        })->get();

        return view('filmy', compact('cats'));
    }

    public function viewShows(){
        $cats = Cat::whereHas('film', function($q){
            $q->where('type', '=', 'S');
        })->get();

        return view('serialy', compact('cats'));
    }

    public function viewFilmsByRating(){
        $filmRecords = Film::where('type', '=', 'F')->orderBy('rating', 'desc')->take(12)->get();
        $showRecords = Film::where('type', '=', 'S')->orderBy('rating', 'desc')->take(12)->get();
        $featuredSliders = Featured::all();

        return view('novinky', compact('filmRecords', 'showRecords', 'featuredSliders'));
    }

    public function index($id){
        $id = Film::findOrFail($id);
        $records = $id->comments;
        $cats = Cat::all();

        if(Auth::check())
        {
            if($records->where('user_id', auth()->user()->id)->first())
                $userHasRated = 1;
            else
                $userHasRated = 0;
        }
        else {
            $userHasRated = 1;
        }
        
        return view('filmy.index', [
            'film' => $id,
        ])->with('records', $records)->with('cats', $cats)->with('userHasRated', $userHasRated);
    } 
}

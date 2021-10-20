<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use App\Film;

class CatsController extends Controller
{
    public function list()
    {
        $cats = Cat::all();

        return view('/pridat-film', compact('cats'));
    }

    public function submit(Request $request)
    {
        // Skontrolujeme, ci je vsetko zadane

        $this->validate($request, [
            'cat' => 'required'
        ]);

        $record = new Cat;
        $record->cat = $request->input('cat');

        // Ulozenie zaznamu

        $record->save();

        // Presmerovanie

        return redirect('/pridat-cat')->with('success', 'Záznam bol úspešne pridaný.');
    }
    
    public function indexFilm($id){
        $id = Cat::findOrFail($id);
        $films = Film::all();
        
        return view('zaner.filmy.index', [
            'cat' => $id,
        ])->with('films', $films);
    } 

    public function indexSerial($id){
        $id = Cat::findOrFail($id);
        $films = Film::all();
        
        return view('zaner.serialy.index', [
            'cat' => $id,
        ])->with('films', $films);
    } 
}

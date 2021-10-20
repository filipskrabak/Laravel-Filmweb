<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Film;
use Auth;

class CommentsController extends Controller
{
    public function submit($id, Request $request)
    {
        // Skontrolujeme, ci je vsetko zadane

        $filmId = Film::findOrFail($id);

        if (Comment::where('user_id', auth()->user()->id)->where('film_id', $id)->exists()) {
            return redirect('/film/'.$id)->with('fail', 'Tento film si už ohodnotil.');
        }

        $this->validate($request, [
            'comment' => 'required',
            'rating' => 'required',
        ]);

        $record = new Comment;
        $record->comment = $request->input('comment');
        $record->rating = $request->input('rating');
        $record->film_id = $id;
        $record->user_id = auth()->user()->id;

        $filmrating_num = $filmId->rating_num;
        $filmrating = $filmId->rating;

        $rating = (($filmrating*$filmrating_num)+$record->rating)/($filmrating_num+1);

        $filmId->rating = $rating;
        $filmId->rating_num++;
        $filmId->save();  

        //dd($rating, $filmrating, $filmrating_num);

        // Ulozenie zaznamu

        $record->save();

        // Presmerovanie

        return redirect('/film/'.$id)->with('success', 'Komentár bol úspešne pridaný.');
    }

    public function delete($id)
    {
        $commentId = Comment::findOrFail($id);

        $this->authorize('forceDelete', $commentId);

        $filmId = $commentId->film;
        $filmrating_num = $filmId->rating_num;
        $filmrating = $filmId->rating;
        $userrating = $commentId->rating;

        if($filmrating_num > 1)
            $newRating = ($filmrating*$filmrating_num-$userrating)/($filmrating_num-1);
        else
            $newRating = NULL;

        $filmId->rating = $newRating;
        $filmId->rating_num--;
        $filmId->save();  

        $commentId->delete();

        //dd($filmrating,$userrating,$newRating);

        // Presmerovanie

        return redirect()->back()->with('success', 'Komentár bol zmazaný.');
    }

    public function getRecords($id){
        Film::findOrFail($id);

        $records = Comment::all();

        return view('/film/'.$id)->with('records', $records);
    }
}

<?php

use Illuminate\Http\Request;
use App\Note;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {


//    $notes = Note::orderBy('created_at', 'desc')->where('user_id' == 1)->get();
//    $notes = Note::get();

    $id = Auth::user()->id;

    $notes = DB::table('notes')->where('user_id', $id)->get();


    return view('home', [
        'notes' => $notes,
    ]);


});


Route::post('/note', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/home')
            ->withInput()
            ->withErrors($validator);
    }

    Note::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => $request->user_id,
    ]);

    return redirect('/home');

});

Route::delete('/note/{note}', function (Note $note) {
    $note->delete();
    return redirect('/home');
});

Route::post('/note/edit/{note}', function (Request $request, Note $note) {

    $note->title = $request->title;
    $note->content = $request->content;

    $note->save();

    return redirect('/home');
});
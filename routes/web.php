<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Support\Facades\Route;

// Route::get('/', 'UserController@home')->name('mainpage');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/profile','ProfileController@index')->name('profile');
// Route::get('/search/{arg}','UserController@search');

// //genres
// Route::get('/genres','HomeController@genre')->name('genres');
// Route::post('/genres','HomeController@addGenre');
// Route::delete('/delete-genre/{id}','HomeController@destroyGenre');
// Route::post('/updateGenre/{id}','HomeController@updateGenre');
// Route::post('/genre-csv','HomeController@csvGenre');

// //before the song is uploaded
// Route::post('/upload','AudioController@index');
// Route::post('/uploading','AudioController@store');
// Route::get('/upload','AudioController@index');
// Route::delete('/cancel-upload','AudioController@destroy')->name('audio.destroy');


// //after the song is in database
// Route::get('/songs','SongController@index')->name('songs');
// Route::delete('/delete/{id}','SongController@destroy');
// Route::get('/edit/{id}','SongController@edit');
// Route::post('/update/{id}','SongController@update');
// Route::get('/show/{id}','SongController@show');
// Route::get('/play/{id}','UserController@play');
// Route::get('/album/{id}','UserController@album');
// Route::get('/artist/{id}','UserController@artist');


// //artists
// Route::get('/artists','ArtistController@index');
// Route::get('/show-artist/{id}','ArtistController@show');
// Route::get('/edit-artist/{id}','ArtistController@edit');
// Route::post('/update-artist/{id}','ArtistController@update');

// //getting Audio
// Route::get('/getAudio/{fileName}', [
//     'as' => 'audio',
//     function ($fileName)
//     {
//         $file = storage_path('app/public/'.$fileName);
//         return \response()->file($file);

//     }
// ]);


// Route::get('/error','HomeController@error')->name('error');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@home')->name('mainpage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','ProfileController@index')->name('profile');
Route::get('/search/{arg}','UserController@search');

//genres
Route::get('/genres','HomeController@genre')->name('genres');
Route::post('/genres','HomeController@addGenre');
Route::delete('/delete-genre/{id}','HomeController@destroyGenre');
Route::post('/updateGenre/{id}','HomeController@updateGenre');
Route::post('/genre-csv','HomeController@csvGenre');

//before the song is uploaded
Route::post('/upload','AudioController@index');
Route::post('/uploading','AudioController@store');
Route::get('/upload','AudioController@index');
Route::delete('/cancel-upload','AudioController@destroy')->name('audio.destroy');


//after the song is in database
Route::get('/songs','SongController@index')->name('songs');
Route::delete('/delete/{id}','SongController@destroy');
Route::get('/edit/{id}','SongController@edit');
Route::post('/update/{id}','SongController@update');
Route::get('/show/{id}','SongController@show');
Route::get('/play/{id}','UserController@play');
Route::get('/album/{id}','UserController@album');
Route::get('/artist/{id}','UserController@artist');
Route::get('/view-album/{id}','UserController@viewalbum');
Route::get('/view-artist/{id}','UserController@viewartist');


//for playlist
Route::get('/playlist','PlaylistController@all');
Route::get('/playlist/{id}','PlaylistController@index');
Route::post('/playlist','PlaylistController@save');
Route::post('/playlistsave','PlaylistController@playlistsave');
Route::get('/playlistedit/{url}','PlaylistController@playlistedit');
Route::post('/playlistupdate/{url}','PlaylistController@playlistupdate');
Route::get('/removefromplay/{id}/{play}','PlaylistController@removefromplay');
Route::get('/playlistdelete/{url}','PlaylistController@playlistdelete');

//for number of plays
Route::post('/playnum/{id}','UserController@playnum');
Route::get('/playnum',function (){
   return redirect('/');
});
Route::get('/playnum/{id}',function (){
    return redirect('/');
});


//artists
Route::get('/artists','ArtistController@index');
Route::get('/show-artist/{id}','ArtistController@show');
Route::get('/edit-artist/{id}','ArtistController@edit');
Route::post('/update-artist/{id}','ArtistController@update');

//getting Audio
Route::get('/getAudio/{fileName}', [
    'as' => 'audio',
    function ($fileName)
    {
        $file = storage_path('app/public/'.$fileName);
        return \response()->file($file);

    }
]);
Route::get('/getAudio/',function (){
    return redirect('/');
});

//Charts
Route::get('/charts/top', 'ChartController@top');
Route::get('/charts/trending', 'ChartController@trending');


Route::get('/error','HomeController@error')->name('error');


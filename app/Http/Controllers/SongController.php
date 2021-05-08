<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Genre;
use Illuminate\Http\Request;
use App\Song;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;


class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware(function($request, $next){
            if (!Gate::allows('isAdmin')) {
                return redirect()->route('error');
            }
            return $next($request);
        });
    }
    public function index()
    {
        $songs = Song::latest()->paginate(20);
        return view('songs.index')->withSongs($songs);
    }

    public function destroy($id)
    {
        $song = Song::find($id);
        $song->artists()->detach();
        $song->genres()->detach();
        $song->playlists()->detach();
        $song->chart()->detach();

        $song->albums()->detach();
        $album = $song->album;
        $album_res = Song::where('album',$album)->get()->count();
        if ($album_res == 1){
            $album = Album::where('title',$album);
            $album->delete();
        }

        Storage::delete($song->path);
        if ($song->album_art !== 'default.jpg'){
            Storage::delete('public/images/'.$song->album_art);
        }
        $song->delete();
        $success = 'The Song has been successfully deleted';
        return \response()->json([
            'success' => $success
        ]);
    }

    public function edit($id)
    {
        $song = Song::find($id);
        $genres = Genre::all();
        return view('songs.edit')->withSong($song)->withGenres($genres);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title' => 'required|max:255',
            'artist' => 'required',
            'year' => 'required|integer',
            'album' => 'required'
        ]);

        $song = Song::find($id);
        $song->title = $request->title;
//        $song->album = $request->album;
        $song->explicit = $request->explicit;
        $song->year = $request->year;

//      For saving album art
        if ($request->hasFile('album_art')){
            $image = $request->file('album_art');
            $fileName = Str::random(10).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/images', $image, $fileName);
            $song->album_art = $fileName;

            //Resize image here
            $thumbnailpath = public_path('storage/images/'.$song->album_art);
            $exten = explode('.',$song->album_art);

            $newfilename = $song->album_art.'_120.'.last($exten);
            Storage::putFileAs('public/images', $thumbnailpath, $newfilename);
            $thumbnailpath = public_path('storage/images/'.$newfilename);
            $img = Image::make($thumbnailpath)->resize(120, 120, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            $song->thumb_120 = $newfilename;
        }



if ($song->thumb_120 == ''){
    //Resize image here
    $thumbnailpath = public_path('storage/images/'.$song->album_art);
    $exten = explode('.',$song->album_art);

    $newfilename = $song->album_art.'_120.'.last($exten);
    Storage::putFileAs('public/images', $thumbnailpath, $newfilename);
    $thumbnailpath = public_path('storage/images/'.$newfilename);
    $img = Image::make($thumbnailpath)->resize(120, 120, function($constraint) {
        $constraint->aspectRatio();
    });
    $img->save($thumbnailpath);
    $song->thumb_120 = $newfilename;
}

if ($song->thumb_250 == ''){
    //Resize image here
    $thumbnailpath = public_path('storage/images/'.$song->album_art);
    $exten = explode('.',$song->album_art);

    $newfilename = $song->album_art.'_250.'.last($exten);
    Storage::putFileAs('public/images/', $thumbnailpath, $newfilename);
    $thumbnailpath = public_path('storage/images/'.$newfilename);
    $img = Image::make($thumbnailpath)->resize(250, 250, function($constraint) {
        $constraint->aspectRatio();
    });
    $img->save($thumbnailpath);
    $song->thumb_250 = $newfilename;
}



        $song->artists()->detach();
//      For assigning artists with songs
        $artist_arr = explode(',',$request->artist);
//        dd($artist_arr);
        foreach ($artist_arr as $artist_single){
            if ($artist_single !== null){
                $artist_single = trim($artist_single);
                $artist = Artist::where('name',$artist_single)->first();
                if (is_null($artist)){
                    $artist = new Artist;
                    $artist->name = $artist_single;
                    $artist->role = "singer";
                    $random = Str::random(10);
                    $title_slug = Str::slug($artist_single,'-');
                    $url = $title_slug.'-'.$random;
                    $artist->url = $url;
                    
                    $artist->auth_id = Auth::user()->id;
                    $artist->save();
//                    $song->artists()->attach($artist->id);
                }
                if ($artist->url === ""){
                    $random = Str::random(10);
                    $title_slug = Str::slug($artist_single,'-');
                    $url = $title_slug.'-'.$random;
                    $artist->url = $url;
                    $artist->save();
                }

//                dd($artist);
                $song->artists()->attach($artist->id);
            }

        }


        //For assigning album with songs
        $album_title = $request->album;
        $album = Album::where('title',$album_title)->first();

        if (is_null($album)){
            foreach ($song->albums as $album){}

            $song->albums()->detach();
            $song->album = $request->album;

            $album_delete = Song::where('album',$song->album)->get()->count();
            if ($album_delete == 0){
                $album = Album::find($album->id);
                $album->delete();
            }
            $album = new Album;
            $album->title = $album_title;
            $random = Str::random(10);
            $title_slug = Str::slug($album_title,'-');
            $url = $title_slug.'-'.$random;
            $album->path = $url;
            $album->year = $song->year;
            $album->save();
            $song->albums()->attach($album->id);
        }


//        For assigning genres
        $song->genres()->sync($request->genres);
        $song->save();
        return redirect()->route('songs');
    }

    public function show($id)
    {
        $song = Song::find($id);
        return view('songs.show')->withSong($song);
    }




}

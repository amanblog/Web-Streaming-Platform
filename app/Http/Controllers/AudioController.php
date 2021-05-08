<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Genre;
use App\Song;
//use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use \duncan3dc\MetaAudio\Tagger as Tagger;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use getID3;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Image;


class AudioController extends Controller
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
                return 'you are not allowed';
//                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {

        //to store a file on server
        $song = $request->file('audFile');

        $path = $song->store('public');
//      $path returns it's path


        //to retrieve file
        $audio = storage_path('app/'.$path);
        $tagger = new Tagger;
        $tagger->addDefaultModules();
        $mp3 = $tagger->open($audio);

        $id3 = new getID3();
        $picture = $id3->analyze($audio);
        if(isset($picture['id3v2']['APIC'])){
            $art =  'data:'.$picture['id3v2']['APIC'][0]['image_mime'].';charset=utf-8;base64,'.base64_encode($picture['id3v2']['APIC'][0]['data']);
        }
        elseif(isset($picture['comments']['picture'][0]['data'])){
            $art =  'data:'.$picture['comments']['picture'][0]['image_mime'].';charset=utf-8;base64,'.base64_encode($picture['comments']['picture'][0]['data']);
        }
        else{

            $art = Storage::url('images/default.jpg');
        }

        $genres = Genre::all();
        return   view('uploading')->withMp3($mp3)->withArt($art)->withPath($path)->withGenres($genres);


    }

    public function uploading(){
        return view('uploading');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|max:255',
            'artist' => 'required',
            'year' => 'required|integer',
            'album' => 'required'
        ]);

        $song = new Song;
        $song->title = $request->title;
        $song->album = $request->album;
        $song->explicit = $request->explicit;
        $song->year = $request->year;
        $song->path = $request->songFile;

        //For Song URL
        $random = Str::random(10);
        $title_slug = Str::slug($song->title,'-');
        $url = $title_slug.'-'.$random;
        $song->url = $url;


//      For saving album art
        if ($request->hasFile('album_art')){
            $image = $request->file('album_art');
            $fileName = Str::random(10).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/images', $image, $fileName);
            $song->album_art = $fileName;

//            $imageThumb = $image;
        }
        else{
            $art = $request->art;

            if (strpos($art,'data:image/jpeg;charset=utf-8;base64,') !== false){
                $image = str_replace('data:image/jpeg;charset=utf-8;base64,', '', $art);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10).'.'.'jpeg';
                Storage::put('public/images/'.$imageName,base64_decode($image));
                $song->album_art = $imageName;
//                $imageThumb = base64_decode($image);
            }
            elseif (strpos($art,'data:image/png;charset=utf-8;base64,') !== false){
                $image = str_replace('data:image/png;charset=utf-8;base64,', '', $art);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10).'.'.'png';
                Storage::put('public/images/'.$imageName,base64_decode($image));
                $song->album_art = $imageName;
//                $imageThumb = base64_decode($image);
            }
            else{
                $song->album_art = 'default.jpg';
//                $imageThumb = Storage::get('public/images/default.jpg');
            }


        }

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

        $song->save();

//      For assigning artists with songs
        $artist_arr = explode(',',$request->artist);
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
                    $artist->auth_id = Auth::user()->id;
                    $artist->url = $url;
                    $artist->save();
                }
                $song->artists()->attach($artist->id);
            }

        }


        //For assigning album with songs
        $album_title = $song->album;
        $album = Album::where('title',$album_title)->first();

        if (is_null($album)){
            $album = new Album;
            $album->title = $album_title;
            $random = Str::random(10);
            $title_slug = Str::slug($album_title,'-');
            $url = $title_slug.'-'.$random;
            $album->path = $url;
            $album->year = $song->year;
            $album->save();
        }
        $song->albums()->attach($album->id);


//        For assigning genres
        $song->genres()->sync($request->genres,false);
        $song->save();
        $request->session()->flash('success', 'The song was successfully saved!');

        return redirect()->route('home');

    }

    public function destroy(Request $request) //to cancel upload
    {
        Storage::delete($request->path);
        return redirect()->route('home');
    }

}

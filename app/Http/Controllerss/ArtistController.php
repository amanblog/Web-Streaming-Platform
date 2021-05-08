<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::latest()->paginate(20);

        return view('artists.index')->withArtists($artists);
    }

    public function show($id)
    {
        $artist = Artist::find($id);
         return view('artists.show')->withArtist($artist);
    }

    public function edit($id)
    {
        $artist = Artist::find($id);
        return view('artists.edit')->withArtist($artist);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name' => 'required|max:255',
            'about' => 'required|string',
        ]);

        $artist = Artist::find($id);
        $artist->name = $request->name;
        $artist->about = $request->about;

//      For saving profile pic
        if ($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');
            $fileName = Str::random(10).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/images/artists/', $image, $fileName);
            $artist->profile_pic = $fileName;


            //Resize image here
            $thumbnailpath = public_path('storage/images/artists/'.$artist->profile_pic);
            $exten = explode('.',$artist->profile_pic);

            $newfilename = $artist->profile_pic.'_120.'.last($exten);
            Storage::putFileAs('public/images/artists/', $thumbnailpath, $newfilename);
            $thumbnailpath = public_path('storage/images/artists/'.$newfilename);
            $img = Image::make($thumbnailpath)->resize(120, 120, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            $artist->thumb_120 = $newfilename;

            //Resize image here
            $thumbnailpath = public_path('storage/images/artists/'.$artist->profile_pic);
            $exten = explode('.',$artist->profile_pic);

            $newfilename = $artist->profile_pic.'_250.'.last($exten);
            Storage::putFileAs('public/images/artists/', $thumbnailpath, $newfilename);
            $thumbnailpath = public_path('storage/images/artists/'.$newfilename);
            $img = Image::make($thumbnailpath)->resize(250, 250, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            $artist->thumb_250 = $newfilename;
        }

if ($artist->profile_pic){
    if ($artist->thumb_120 == ''){
        //Resize image here
        $thumbnailpath = public_path('storage/images/artists/'.$artist->profile_pic);
        $exten = explode('.',$artist->profile_pic);

        $newfilename = $artist->profile_pic.'_120.'.last($exten);
        Storage::putFileAs('public/images/artists/', $thumbnailpath, $newfilename);
        $thumbnailpath = public_path('storage/images/artists/'.$newfilename);
        $img = Image::make($thumbnailpath)->resize(120, 120, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
        $artist->thumb_120 = $newfilename;
    }

    if ($artist->thumb_250 == ''){
        //Resize image here
        $thumbnailpath = public_path('storage/images/artists/'.$artist->profile_pic);
        $exten = explode('.',$artist->profile_pic);
        $newfilename = $artist->profile_pic.'_250.'.last($exten);
        Storage::putFileAs('public/images/artists/', $thumbnailpath, $newfilename);
        $thumbnailpath = public_path('storage/images/artists/'.$newfilename);
        $img = Image::make($thumbnailpath)->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
        $artist->thumb_250 = $newfilename;
    }
}


        $artist->save();
        return redirect('/show-artist/'.$artist->id);
    }
}

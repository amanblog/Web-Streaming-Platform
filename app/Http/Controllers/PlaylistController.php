<?php

namespace App\Http\Controllers;


use App\Playlist;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlaylistController extends Controller
{
    public function index($id)
    {
        $playlist = Playlist::where('url',$id)->first();

        if (isset($_GET['req'])) {
            if ($_GET['req']=='ajax'){
                return \response()->json(view('user.playlistajax')->withPlaylist($playlist)->render());
            }
        }else{
            return view('user.playlist')->withPlaylist($playlist);
        }
    }

    public function save(Request $request)
    {
        if(isset($request->play_name)){
            $playlist = new Playlist;
            $playlist->name = $request->play_name;
            $playlist->owner = Auth::user()->id;
            $playlist->is_public = 1;

            //For Playlist URL
            $random = Str::random(10);
            $title_slug = Str::slug($playlist->name,'-');
            $url = $title_slug.'-'.$random;
            $playlist->url = $url;

            if ($request->hasFile('play_img')){
                $image = $request->file('play_img');
                $fileName = Str::random(10).'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('public/images', $image, $fileName);
                $playlist->playlist_pic = $fileName;
            }
            else{
                $playlist->playlist_pic = 'default.jpg';
            }

            $playlist->save();
            $success = 'The playlist was successfully saved!';
            $request->session()->flash('success', $success);

            if ($request->ajax()){
                return \response()->json([
                    'success' => $success
                ]);
            }
            else{
                return Redirect::back();
            }
        }
    }

    public function all()
    {
        $playlists = Playlist::where('owner',Auth::user()->id)->get();
        return view('user.playlistall')->withPlaylists($playlists);

    }

    public function playlistsave(Request $request)
    {
        if (isset($request->songid) && isset($request->playid)){
            $songid = $request->songid;
            $playlist = $request->playid;
            $playlist = Playlist::where('url',$playlist)->first();
            $song = Song::find($songid);
            $duplicate = DB::select("SELECT * from playlist_song where song_id = '$songid' and playlist_id='$playlist->id'");
            if ($duplicate){
                $success = 'The song is already added!';
            }
            else{
                $song->playlists()->attach($playlist);
                $success = 'The song was added!';
            }

            $request->session()->flash('success', $success);

            if ($request->ajax()){
                return \response()->json([
                    'success' => $success
                ]);
            }
            else{
                return Redirect::back();
            }
        }
    }




    public function playlistedit($url)
    {
        $playlist = Playlist::where('url',$url)->first();

        if ($playlist->owner === Auth::user()->id){
            return view('user.playlistedit')->withPlaylist($playlist);
        }
        return redirect('/playlist/'.$url);

    }


    public function playlistupdate($url, Request $request)
    {
        if (!is_null($url)){
            $playlist = Playlist::where('url',$url)->first();
            if (!is_null($playlist) && $playlist->owner === Auth::user()->id){
                $playlist->name = $request->playname;
                $playlist->save();

            }
        }
        return redirect('/playlist/'.$url);

    }

    public function removefromplay($id,$play)
    {
        $playlist = Playlist::find($play);

        if (!is_null($playlist) && $playlist->owner === Auth::user()->id){
            $song = Song::find($id);
            if (!is_null($song)){
                $song->playlists()->detach($play);

                return \response()->json([
                    'success' => 'Song Removed From Playlist!'
                ]);
            }
        }

    }

    public function playlistdelete($url)
    {
        $playlist = Playlist::where('url',$url)->first();
        $playlist->songs()->detach();

        $playlist->delete();

        return \redirect('/');


    }

}

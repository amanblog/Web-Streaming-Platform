<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Song;
use Illuminate\Http\Request;

class UserController extends Controller
{
//==main home page====================================================================================
    public function home() {
        $songs = Song::all()->sortByDesc('id')->take(20);

        $artists = Artist::all()->sortByDesc('id')->take(20);

        if (isset($_GET['req'])) {
            if ($_GET['req']=='ajax'){
                return \response()->json(view('welcomeajax')->withSongs($songs)->withArtists($artists)->render());
            }
        }else{
            return view('welcome')->withSongs($songs)->withArtists($artists);
        }

    }


//==to show song page==============================================================================
    public function play($id){
        $song = Song::where('url',$id)->first();

        if (isset($_GET['req'])){
            if ($_GET['req']=='ajax') {
                return \response()->json(view('user.playajax')->withSong($song)->render()); //---------> This is the single partial which contains the updated info!
            }
            if ($_GET['req']=='playbar'){
                $song = Song::find($id);
                foreach($song->albums as $album){ $album->path;};
                return \response()->json([$song,$album->path]);
            }
        }


        else{
            return view('user.play')->withSong($song);//---------> This view should include the partial for the initial state! (first load of the page);
        }
    }


//==to show album page============================================================================

    public function album($id){
        $album = Album::where('path',$id)->first();

        if (isset($_GET['req'])){
            if ($_GET['req']=='ajax') {
                return \response()->json(view('user.albumajax')->withAlbum($album)->render()); //---------> This is the single partial which contains the updated info!
            }
        }

        else{
            return view('user.album')->withAlbum($album);//---------> This view should include the partial for the initial state! (first load of the page);
        }
    }//function album()


//==to show artist================================================================================

    public function artist($id)
    {
        $artist = Artist::where('url',$id)->first();

        if (isset($_GET['req'])){
            if ($_GET['req']=='ajax') {
                return \response()->json(view('user.artistajax')->withArtist($artist)->render()); //---------> This is the single partial which contains the updated info!
            }
        }

        else{
            return view('user.artist')->withArtist($artist);//---------> This view should include the partial for the initial state! (first load of the page);
        }
    } //function artist()

//==search page=================================================================================

    public function search($arg)
    {
        $songs = Song::where('title', $arg)->orWhere('title', 'like', '%' . $arg . '%')->get();
        $artists = Artist::where('name', $arg)->orWhere('name', 'like', '%' . $arg . '%')->get();
        $albums = Album::where('title', $arg)->orWhere('title', 'like', '%' . $arg . '%')->get();
        return \response()->json(view('search')->withSongs($songs)->withArtists($artists)->withArg($arg)->withAlbums($albums)->render());
    }

}

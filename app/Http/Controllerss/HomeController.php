<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function error()
    {
        return view('error');
    }

    public function genre()
    {
        $genres = Genre::all();
        return view('genre')->withGenres($genres);
    }

    public function addGenre(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:genres|string',
        ]);

        $genre = new Genre;
        $genre->name = $request->name;
        $genre->save();

        return redirect('/genres');
    }

    public function csvGenre(Request $request)
    {
        if ($request->hasFile('genre-csv')){
            $file = $request->file('genre-csv');

            //File Details
            $filename = Str::random(10);
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            $maxFileSize = 2097152;
            if ($fileSize <= $maxFileSize){
                Storage::putFileAs('public/genre-csv', $file, $filename);
                $filepath = public_path('storage/genre-csv/'.$filename);

                //Reading File
                $file = fopen($filepath,"r");

                $importData = [];
                $i=0;

                while(($filedata = fgetcsv($file, 1000, ",")) !== FALSE){
                    $num = count($filedata);
                    for ($c=0; $c < $num; $c++) {
                        $importData[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);

                foreach ($importData as $data){
                    $genre = new Genre;
                    $genreExist = Genre::where('name', $data[0])->first();
                    if (is_null($genreExist)){
                        $genre->name = $data[0];
                        $genre->save();
                    }

                }

                $request->session()->flash('success', 'The genres were successfully added!');
                return redirect('/genres');
            }
        }
    }

    public function updateGenre(Request $request, $id)
    {
        $gen = Genre::find($id);
        $this->validate($request,[
            'name' => 'alpha_dash|required|max:255|unique:genres',
        ]);
        $gen->name = $request->name;
        $gen->save();
        return redirect('/genres');
    }

    public function destroyGenre($id)
    {
        $genre = Genre::find($id);
        $i=0;
        foreach ($genre->songs as $song){$i++;}
        if ($i>0){

            $fail = 'Cannot delete Genre when it is associated with a song';
            return \response()->json([
                'failure' =>$fail,

            ]);
        }
        else{

            $genre->delete();
            $success = 'The Genre has been successfully deleted';

            return \response()->json([
                'success' => $success,

            ]);

        }
//        return \response()->json([
//            'success' => $genre->songs,
//
//        ]);
//        $genre->songs()->detach();


    }


}

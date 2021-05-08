<?php

namespace App\Http\Controllers;

use App\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function top()
    {
        $tops = DB::select("SELECT song_id, (`1` + `2` +`3` +`4`+`5`+`6`+`7`+`8`+`9`+`10`+`11`+`12`+`13`+`14`+`15`+`16`+`17`+`18`+`19`+`20`+`21`+`22`+`23`+`24`+`25`+`26`+`27`+`28`+`29`+`30`) as totallall from charts order by totallall desc limit 10");

        if (isset($_GET['req'])){
            if ($_GET['req']=='ajax') {
                return \response()->json(view('charts.topajax')->withTops($tops)->render());
            }
        }
        else{
            return view('charts.top')->withTops($tops);
        }

    }

    public function trending()
    {
        $trends = DB::select("SELECT song_id from charts order by `31` desc limit 10");
        if (isset($_GET['req'])){
            if ($_GET['req']=='ajax') {
                return \response()->json(view('charts.trendingajax')->withTrends($trends)->render());
            }
        }
        else{
            return view('charts.trending')->withTrends($trends);
        }
    }
}

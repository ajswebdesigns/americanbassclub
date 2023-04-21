<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function tournamentInfo($id)
    {
        $tournament = DB::table('tournaments')->where('id', $id)->where('is_deleted', 0)->where('end_date', '>=', date('Y-m-d'))->orWhere('id', 10)->first();
        if(@$tournament){
            return view("tournament_details", compact('tournament'));
        }
        return redirect()->back();
    }
}

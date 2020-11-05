<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Board;
use\Closure;
use Illuminate\Support\Facades\Auth;        // Need for get user login

// use Illuminate\Support\Facades\DB;
//   $board->ownerId=DB::table('users')->select('id')->get();

// $uid = Auth::User()->id;
class BoardController extends Controller
{
    public function index()
    {
        return view ('board.board', ["boards"=>Board::all()->where('ownerId', Auth::User()->id)] );
    }

    public function store(Request $request)
    {
        $board=new Board();                         // Step1 > Create
                                                    // Step2 > Loadin data
        $board->ownerId = Auth::User()->id;         //  from user login
        $board->boardName=$request->boardName;

        $board->save();                             // Step3 > Push in Table

        return back();
    }

}
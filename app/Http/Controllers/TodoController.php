<?php

// namespace App\Http\Controllers\Todo;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Todo;
use App\Task;
use App\Comment;
use App\Background;
use App\Board;
use App\BoardUser;
use App\User;


class TodoController extends Controller
{
    public function show($board_id)
    {
        // $sharing = User::with('boards')->where('id' , '!=' , Auth::User()->id)->get();

        // All users except Me
        $sharing = User::where('id' , '!=' , Auth::User()->id)->get();
        // dd($sharing);

        // RECUP TABLES DE l'USER
        // $sharingBoard = $sharing->boards();
        // dd($sharingBoard);

        $identity = User::where('id' , '==', BoardUser::where('user_id')->get());
        // dd($identity);

        // foreach ($sharing as $share ) {
        //     // dd($share->boards);
        // }

        $bb = Board::with('users.boards')->where('user_id' , '!=' , Auth::User()->id)->get();



        // $myPivot = BoardUser::where('board_id', '==', $board_id)->select('user_id');
        $myPivot = BoardUser::all()->where('board_id', '==', $board_id);




        $myBoard = Board::all();
        $myTodo = Todo::where('board_id', $board_id)->get();            // apres le Get >> Collection
        $myTask =  Task::all();
        $myComment = Comment::all();
        $myBackground = Background::all();

        return view ('todo', [
            "board_id" => $board_id,
            "myBoard" => $myBoard,
            "myTodo" => $myTodo,
            "myTask" => $myTask,
            "myComment" => $myComment,
            "myBackground" => $myBackground,

            "sharing" => $sharing,
            "myPivot" => $myPivot,
        ]);

    }

    public function store(Request $request, $board_id)
    {

        $request->validate(
            [
                'todoName' => 'required',
            ]);

        $td = new Todo();
            $td->owner_id = Auth::User()->id;
            $td->todoName=$request->todoName;
            $td->board_id=$board_id;
        $td->save();

        return back();
    }

    public function destroy($del_id)
    {
        // Master Delete >> web.php
        // $del = Todo::find($del_id);
        // $del->delete();

        // return back();
    }

                public function update(Request $request, $edit_id)
                {

                $request->validate(
                    [
                        'tdName' => 'required',
                    ]);

                    $cos = Todo::find( $edit_id);

                    $cos->todoName = $request->tdName;

                    $cos->save();

                    return back();
                }
}

        // $myTodo = DB::table('todos')->where('board_id', $board_id)->get();
        // $myTodo = Todo::where('board_id', $board_id)->get()->pluck('id')->toArray();
        //table all id from Todo
        // $myTask= DB::table('tasks')->get();
        // $myComment= DB::table('comments')->get();

        // $myBoard = Board::where('user_id' , '==' , Auth::User()->id)->get();

        // $sharing = User::all()->where('id' , '!=' , Auth::User()->id);
        // $sharing = User::where('id' , '!=' , Auth::User()->id)->get();

        // $pivot = Pivot::all();

        // $myBoard = Board::all()->where('user_id' , '==' , Auth::User()->id)->get();

        // $myTodo = Todo::where('board_id', $board_id)->get();            // apres le Get >> Collection
        // $myTask =  Task::all();
        // $myComment = Comment::all();
        // $myBackground = Background::all();

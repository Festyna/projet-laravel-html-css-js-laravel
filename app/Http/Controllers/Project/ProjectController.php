<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Todo;
use Illuminate\Support\Facades\Auth;        // Need for get user login

class ProjectController extends Controller
{
    public function index()
    {
        return view ('project.project', ["todos"=>Todo::all()->where(Board::where('boarId',$id))] );
    }


    public function store()
    {
        return back();
    }

}

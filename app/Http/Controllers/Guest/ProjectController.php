<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::orderBy("date", "DESC")->paginate(6);
        return view("guest.index", compact("projects"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function search(Request $request){
        $projects=Project::where("title", "LIKE", $request->title."%")->orderBy("date", "DESC")->paginate(6);
        return view("guest.index", compact("projects"));
    }
}

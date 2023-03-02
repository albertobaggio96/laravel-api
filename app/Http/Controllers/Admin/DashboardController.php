<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $projects=Project::orderBy("date", "DESC")->paginate(6);
        return view("admin.dashboard", compact("projects"));
    }
}

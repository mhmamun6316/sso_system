<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function addProject(Request $request){

        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);

        $project = new Project();
        $project->name = $request->project_name;
        $project->description = $request->project_description;
        $project->token = $token;
        $project->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Role;
use App\Models\Technology;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    protected $rules=[
        "title"=>"required|string|min:2|max:100|unique:projects,title",
        "date"=>"required|date",
        "preview"=>"required|image|max:300",
        "type_id"=> "required|exists:types,id",
        "technologies"=> "array|exists:technologies,id"
    ];
    protected $errorsMessage=[
        "title.required"=>"Title è un campo obbligatorio",
        "title.min"=>"Title deve contenere almeno 2 caratteri",
        "title.max"=>"Title non può avere più di 100 caratteri",
        "title.unique"=>"Title esiste già",

        "date.required"=>"Date è un campo obbligatorio",
        "date.date"=>"formato della data deve essere una data valida",
        
        "preview.required"=>"Preview è un campo obbligatorio",
        "preview.img"=>"Preview deve essere un immagine valido",
        "preview.max"=>"Preview non può avere più di 300 kilobytes",

        "type_id.required"=>"Type è un campo obbligatorio",
        "type_id.exists"=>"Type è deve esistere sul db",


    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleValue = Auth::user()->roles->pluck('id')->contains(1);
        
        if($roleValue){
            $projects=Project::orderBy("date", "DESC")->paginate(10);
        }else 
            $projects=Project::where('user_id', Auth::user()->id)->orderBy("date", "DESC")->paginate(10);
        
        return view("admin.project.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly< created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= $this->rules;
        $errorsMessage= $this->errorsMessage;
        $data= $request->validate($rules, $errorsMessage);
        $data["author"]= Auth::user()->name;
        $data["slug"]= Str::slug($data["title"]);
        $data["preview"]= Storage::put("img", $data["preview"]);

        $newProject= new Project();
        $newProject->fill($data);
        $newProject->save();
        $newProject->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route("admin.projects.show", $newProject->slug)->with("message", "$newProject->title è stato creato con successo")->with("alert-type", "success");
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $nextProject = Project::where("date", ">", $project->date)->orderBy("date")->first();
        $prevProject = Project::where("date", "<", $project->date)->orderBy("date", "DESC")->first();

        return view("admin.project.show", compact("project", "nextProject", "prevProject"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types= Type::all();
        $technologies= Technology::all();
        return view('admin.project.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $rules= $this->rules;
        $errorsMessage= $this->errorsMessage;
        $rules["title"]= ["required", "string", "min:2", "max:100", Rule::unique("projects")->ignore($project->id) ];
        $data= $request->validate($rules, $errorsMessage);

        if($request->hasFile("preview") && $project->isNotUrl()){
            Storage::delete($project->preview);
        }

        $data["preview"]= Storage::put("img", $data["preview"]);

        $project->update($data);
        $project->technologies()->sync($data['technologies'] ?? []);


        return redirect()->route("admin.projects.show", compact("project"))->with("message", "$project->title è stato modificato con successo")->with("alert-type", "success");
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route("admin.projects.index")->with("message", "$project->title è stato spostato nel cestino")->with("alert-type", "warning");
    }

    /**
     * Display a listing of trash.
     * 
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed(){
        $trashProjects = Project::onlyTrashed()->get();
        return view("admin.project.trashed", compact("trashProjects"));
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */

    public function forceDelete(Project $project){

        if($project->isNotUrl()){
            Storage::delete($project->preview);
        }

        $project->forceDelete();

        return redirect()->route("admin.projects.trashed")->with("message", "$project->title è stato cancellato definitivamente")->with("alert-type", "warning");
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */

    public function restore(Project $project){

        $project->restore();

        return redirect()->route("admin.projects.trashed")->with("message", "$project->title è stato ripristinato")->with("alert-type", "success");
    }

    /**
     * search filter by title
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $projects=Project::where("title", "LIKE", $request->title."%")->orderBy("date", "DESC")->paginate(6);
        return view("admin.project.index", compact("projects"));
    }

    public function clearType(Project $project){

        $type = $project->type;
        $project->type_id = null;
        $project->update();

        return redirect()->route('admin.types.index');
    }
}

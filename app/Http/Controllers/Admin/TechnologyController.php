<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    protected $rules = [
        'technology'=> 'required|min:2|max:10|unique:technologies,technology',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technology.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technology.create', ['technology'=>new technology]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= $this->rules;
        $data= $request->validate($rules);
        $data['slug'] = Str::slug($data['technology']);

        $newtechnology = new technology();

        $newtechnology->fill($data);
        $newtechnology->save();
        $newtechnology->slug .= "-$newtechnology->id";
        $newtechnology->update();

        return redirect()->route('admin.technologies.show', $newtechnology->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(technology $technology)
    {
        return view('admin.technology.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(technology $technology)
    {
        return view('admin.technology.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, technology $technology)
    {
        $rules= $this->rules;
        $rules['technology']= ['required', 'string', 'min:2', 'max:10', Rule::unique('technologies')->ignore($technology->id)];
        $data= $request->validate($rules);
        $data['slug']= Str::slug($data['technology'])."-$technology->id";

        $technology->update($data);

        return redirect()->route('admin.technologies.show', compact('technology'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

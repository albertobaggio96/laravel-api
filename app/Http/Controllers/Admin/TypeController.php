<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $rules = [
        'type'=> 'required|min:2|max:10|unique:types,type'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create', ['type'=>new Type]);
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

        $newType = new Type();
        $newType->fill($data);
        $newType->save();

        return redirect()->route('admin.types.show', $newType->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $rules= $this->rules;
        $rules['type']= ['required', 'string', 'min:2', 'max:10', Rule::unique('types')->ignore($type->id)];
        $data= $request->validate($rules);

        $type->update($data);

        return redirect()->route('admin.types.show', compact('type'));
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

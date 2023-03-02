@extends('layouts.app')

@section('content')
    @include("admin.partials.form", ["route"=>"admin.projects.update", "method"=>"PUT", "project"=>$project, "button"=>"update"])
@endsection
@extends('layouts.app')

@section('content')
  @include("admin.partials.form", ["route"=>"admin.projects.store", "method" => "POST", "project"=> $project, "button"=>"create"])
@endsection
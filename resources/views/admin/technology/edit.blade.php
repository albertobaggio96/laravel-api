@extends('layouts.app')

@section('content')
    @include("admin.partials.technologyForm", ["route"=>"admin.technologies.update", "method"=>"PUT", "technology"=>$technology, "button"=>"update"])
@endsection
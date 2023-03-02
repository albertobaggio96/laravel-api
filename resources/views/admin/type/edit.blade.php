@extends('layouts.app')

@section('content')
    @include("admin.partials.typeForm", ["route"=>"admin.types.update", "method"=>"PUT", "type"=>$type, "button"=>"update"])
@endsection
@extends('layouts.app')

@section('content')
  @include("admin.partials.technologyForm", ["route"=>"admin.technologies.store", "method" => "POST", "technology"=> $technology, "button"=>"create"])
@endsection
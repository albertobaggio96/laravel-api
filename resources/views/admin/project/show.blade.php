@extends('layouts.app')

@section('content')
    <section class="container text-center my-5">

      @if (session("message"))
        <div class="alert alert-{{ session('alert-type') }} mb-5">
          {{ session("message") }}
        </div>
      @endif

      <img src="{{ filter_var($project->preview, FILTER_VALIDATE_URL)  ? $project->preview : asset('storage/'. $project->preview)}}" alt="{{ $project->title }}" class="preview">

      <h1>{{ $project->title }}</h1>
      <h3>
        Technoligies:
        @foreach($project->technologies as $technology)
          {{ $technology->technology }}
        @endforeach
      </h3>
      <h3>Author: {{ $project->author }}</h3>
      <div>date: {{ $project->date }}</div>
      <div class="d-flex mt-2">
        <a href="{{ route("admin.projects.show", $prevProject->slug ?? "") }}" class="@if(!isset($prevProject)) disabled @endisset me-auto btn-prev">Prev</a>

        <a href="{{ route("admin.projects.index") }}" class="py-2 px-4 btn-arrow bg-black"><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="{{ route("admin.projects.edit", $project->slug) }}" class="btn-edit py-2 px-4"><i class="fa-solid fa-pen-to-square"></i></a>
        <form class="d-inline delete-element" action="{{ route("admin.projects.destroy", $project->slug) }}" method="POST" data-element-name="{{ $project->title }}">
          @csrf
          @method("DELETE") 
          <button type="submit" class="btn btn-delete px-4" value="delete"><i class="fa-solid fa-trash-can-arrow-up"></i><span>Delete</span></button>
        </form>

        <a href="{{ route("admin.projects.show", $nextProject->slug ?? "") }}" class="@if(!isset($nextProject)) disabled @endisset  btn-next ms-auto">Next</a>
      </div>
    </section>
@endsection

@section("js")
  @vite('resources/js/deleteConfirm.js')
@endsection
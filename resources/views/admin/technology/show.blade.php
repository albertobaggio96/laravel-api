@extends('layouts.app')

@section('content')
  <section class="text-center pt-5">

    <h1>{{ $technology->technology }}</h1>
    <h2>{{ $technology->id }}</h2>

    @foreach ($technology->projects as $project)
      <article class="border border-4">
        <img src="{{ filter_var($project->preview, FILTER_VALIDATE_URL)  ? $project->preview : asset('storage/'. $project->preview)}}" alt="{{ $project->title }}" class="preview mt-3">
    
        <h1>{{ $project->title }}</h1>
        <h3>
          Technoligies:
          @foreach($project->technologies as $technology)
            {{ $technology->technology }}
          @endforeach
        </h3>
        <h3>Author: {{ $project->author }}</h3>
        <div>date: {{ $project->date }}</div>
      </article>
    @endforeach

  </section>
@endsection
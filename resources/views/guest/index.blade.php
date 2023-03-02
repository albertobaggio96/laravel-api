@extends('layouts.guest')

@section('content')
    <section id="guest-projects">
      <div class="container">
        <div class="row">
          @foreach ($projects as $project)
          <article class="flip-card col-4 g-5">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="{{ filter_var($project->preview, FILTER_VALIDATE_URL)  ? $project->preview : asset('storage/'. $project->preview)}}" class="img-fluid">
              </div>
              <div class="flip-card-back">
                <h1>{{ $project->title }}</h1>
                <p>{{ $project->date }}</p>
                <p>{{ $project->author }}</p>
              </div>
            </div>
          </article>
          @endforeach
          <section class="pt-3">

            {{ $projects->links() }}
          </section>
        </div>
      </div>
      

    </section>
@endsection
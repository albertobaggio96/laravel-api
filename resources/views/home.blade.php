@extends('layouts.app')
@section('content')
    <section id="home-page" class="d-flex justify-content-center align-items-center">
        <div class="container text-center">
            <h1>HEY, I'M ALBERTO BAGGIO</h1>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste iusto laborum quaerat earum! Ex alias laboriosam, consequatur error quas eveniet perspiciatis perferendis, nisi facere ipsa atque in incidunt deserunt expedita.</p>
            <h2>Take a look at my project</h2>
            <a href="{{ route("guest.projects.index") }}" class="btn btn-two">Go to projects</a>
        </div>
    </section>
@endsection
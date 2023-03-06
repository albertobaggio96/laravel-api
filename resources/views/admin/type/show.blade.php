@extends('layouts.app')

@section('content')
    <section class="text-center pt-5">

        <h1>{{ $type->type }}</h1>
        <h2>{{ $type->id }}</h2>

        @foreach ($type->projects as $project)
            <article class="border border-4">
                <img src="{{ filter_var($project->preview, FILTER_VALIDATE_URL) ? $project->preview : asset('storage/' . $project->preview) }}"
                    alt="{{ $project->title }}" class="preview mt-3">

                <h1>{{ $project->title }}</h1>
                <h3>
                    Technoligies:
                    @foreach ($project->technologies as $technology)
                        {{ $technology->technology }}
                    @endforeach
                </h3>
                <h3>Author: {{ $project->author }}</h3>
                <div>date: {{ $project->date }}</div>
                <form class="d-inline delete-element" action="{{ route('admin.projects.clear-type', $project->slug) }}"
                    method="POST" data-element-name="{{ $type->type }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete px-4" value="delete"><i
                            class="fa-solid fa-trash-can-arrow-up"></i><span>Delete</span></button>
                </form>
            </article>
        @endforeach


    </section>
@endsection

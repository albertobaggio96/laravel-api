@extends('layouts.app')

@section('content')
<section  class="container mt-5">

  @if (session("message"))
    <div class="alert alert-{{ session('alert-type') }}">
      {{ session("message") }}
    </div>
  @endif

  <div class="text-center pb-4">
    <a href="{{ route("admin.projects.create") }}" class="btn btn-primary">Add new Project</a>
    <a href="{{ route("admin.projects.trashed") }}" class="btn btn-secondary">trash</a>
    <form class="d-flex ms-auto d-inline w-25" action="{{ route("admin.projects.search") }}" method="POST">
      @csrf
      <input class="form-control me-2" name="title">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
  </div>
  <table class="table table-dark table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">#id</th>
        <th scope="col">title</th>
        <th scope="col">author</th>
        <th scope="col">date</th>
        <th scope="col">preview</th>
        <th scope="col">type</th>
        <th scope="col">technologies</th>
        <th scope="col">option</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td>{{ $project->author }}</td>
            <td>{{ $project->date }}</td>
            <td><img src="{{ filter_var($project->preview, FILTER_VALIDATE_URL)  ? $project->preview : asset('storage/'. $project->preview)}}" alt="{{ $project->title }}" class="preview"></td>
            <td>{{ $project->type->type ?? 'type non definito' }}</td>
            <td>
              @foreach ($project->technologies as $technology)
                {{ $technology->technology}}
              @endforeach
            </td>
            <td>
              <a href="{{ route("admin.projects.show", $project->slug) }}" class="btn btn-show px-4"><i class="fa-solid fa-eye"></i></a>
              <a href="{{ route("admin.projects.edit", $project->slug) }}" class="btn btn-edit px-4"><i class="fa-solid fa-pen-to-square"></i></a>
              <form class="d-inline delete-element" action="{{ route("admin.projects.destroy", $project->slug) }}" method="POST" data-element-name="{{ $project->title }}">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-delete px-4" value="delete"><i class="fa-solid fa-trash-can-arrow-up"></i><span>Delete</span></button>
              </form>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $projects->links() }}
</section>
@endsection

@section("js")
  @vite('resources/js/deleteConfirm.js')
@endsection
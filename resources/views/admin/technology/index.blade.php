@extends('layouts.app')

@section('content')
    <section class="container mt-5">

        @if (session('message'))
            <div class="alert alert-{{ session('alert-technology') }}">
                {{ session('message') }}
            </div>
        @endif

        <div class="text-center pb-4">
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">Add new Project</a>
        </div>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">technology</th>
                    <th scope="col">count</th>
                    <th scope="col">options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                        <td>{{ $technology->technology }}</td>
                        <td>{{ count($technology->projects) }}</td>
                        <td>
                            <a href="{{ route('admin.technologies.show', $technology->slug) }}" class="btn btn-show px-4"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.technologies.edit', $technology->slug) }}" class="btn btn-edit px-4"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline delete-element"
                                action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST"
                                data-element-name="{{ $technology->technology }}">
                                @csrf
                                @method('DELETE')
                                <button technology="submit" class="btn btn-delete px-4" value="delete"><i
                                        class="fa-solid fa-trash-can-arrow-up"></i><span>Delete</span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@section('js')
    @vite('resources/js/deleteConfirm.js')
@endsection
@endsection

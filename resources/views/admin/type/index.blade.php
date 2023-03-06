@extends('layouts.app')

@section('content')
    <section class="container mt-5">

        @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
        @endif

        <div class="text-center pb-4">
            <a href="{{ route('admin.types.create') }}" class="btn btn-primary">Add new Project</a>
        </div>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">type</th>
                    <th scope="col">count</th>
                    <th scope="col">options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->type }}</td>
                        <td>{{ count($type->projects) }}</td>
                        <td>
                            <a href="{{ route('admin.types.show', $type->slug) }}" class="btn btn-show px-4"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.types.edit', $type->slug) }}" class="btn btn-edit px-4"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline delete-element" action="{{ route('admin.types.destroy', $type->slug) }}"
                                method="POST" data-element-name="{{ $type->type }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete px-4" value="delete"><i
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

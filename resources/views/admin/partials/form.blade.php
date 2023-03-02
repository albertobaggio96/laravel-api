@if($errors->any())
<div class="alert alert-danger container mt-5">
  controlla i campi inseriti
</div>
@endif
<form class="container my-5" action="{{route($route, $project->slug)}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @method($method)

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" maxlength="100" name="title" value="{{old('title', $project->title) }}">
      @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    <div class="mb-3">
      @foreach ($technologies as $technology)
      <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}" 
        @if ($errors->any())
          @checked(in_array($technology->id, old('technologies', [])))
        @else
          @checked($project->technologies->contains($technology->id))
        @endif>
      <label class="form-check-label me-3">
        {{ $technology->technology }}
      </label>
      @endforeach

    </div>
    <div class="mb-3">
      <label for="preview" class="form-label">preview</label>
      <input type="file" id="preview" class="form-control @error('preview') is-invalid @enderror" maxlength="250" name="preview" value="{{old('preview', $project->preview) }}">
      @error('preview')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="date" class="form-label">date</label>
      <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date', $project->date) }}">
      @error('date')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="type">Select type of project</label>
      <select id="type" class="form-select" name="type_id">
        @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
  </form>
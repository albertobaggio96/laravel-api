@if($errors->any())
<div class="alert alert-danger container mt-5">
  controlla i campi inseriti
</div>
@endif
<form class="container my-5" action="{{route($route, $technology->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @method($method)

    <div class="mb-3">
      <label for="technology" class="form-label">technology</label>
      <input technology="text" id="technology" class="form-control @error('technology') is-invalid @enderror" maxlength="10" name="technology" value="{{old('technology', $technology->technology) }}">
      @error('technology')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    <button technology="submit" class="btn btn-primary">{{ $button }}</button>
  </form>
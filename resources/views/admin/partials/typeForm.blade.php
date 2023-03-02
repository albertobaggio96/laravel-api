@if($errors->any())
<div class="alert alert-danger container mt-5">
  controlla i campi inseriti
</div>
@endif
<form class="container my-5" action="{{route($route, $type->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @method($method)

    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <input type="text" id="type" class="form-control @error('type') is-invalid @enderror" maxlength="10" name="type" value="{{old('type', $type->type) }}">
      @error('type')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
  </form>
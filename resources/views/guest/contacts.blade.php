@extends('layouts.app')

@section('content')
    <section class="container">
      @if($errors->any())
      <div class="alert alert-danger container mt-5">
        controlla i campi inseriti
      </div>
      @endif
      <form class="container my-5" action="{{route('guest.contacts.store')}}" method="POST">
          @csrf
          
          <div class="mb-3">
            <label for="contact-name" class="form-label">Name</label>
            <input type="text" id="contact-name" class="form-control @error('name') is-invalid @enderror" maxlength="50" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="contact-email" class="form-label">Email  </label>
            <input type="email" id="contact-email" class="form-control @error('email') is-invalid @enderror" maxlength="100" name="email" value="{{old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="contact-message" class="form-label">Title</label>
            <textarea name="message" class="form-control @error('title') is-invalid @enderror"  id="contact-message" cols="30" rows="10">{{ old('message') }}</textarea>
            @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
          </section>
      @endsection
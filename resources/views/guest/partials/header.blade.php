<nav class="navbar bg-light">
  <div class="container d-flex align-items-center py-2">
    <h1 class="fs-3 me-4">Projects</h1>
    <a class="nav-link active me-4 lh-lg" aria-current="page" href="{{ url("/") }}">Home</a>
    <a class="nav-link active me-4" aria-current="page" href="{{ route("guest.projects.index") }}">See all</a>
    <form class="d-flex ms-auto" action="{{ route("guest.search") }}" method="POST">
      @csrf
      <input class="form-control me-2" name="title">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
  </div>
</nav>
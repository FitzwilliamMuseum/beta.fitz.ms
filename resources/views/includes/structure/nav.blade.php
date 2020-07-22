<!-- Nav bars -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
  aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarText">
  <ul class="navbar-nav mr-auto">

    <li class="nav-item active">
      <a class="nav-link" href="{{ URL::to('/') }}">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ URL::to('/visit-us') }}">Visit us</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      About us</a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ URL::to('/about-us') }}">About the Museum</a>
        <a class="dropdown-item" href="{{ URL::to('/collections') }}">Collection areas</a>
        <a class="dropdown-item" href="{{ URL::to('/departments') }}">Departments</a>
        <a class="dropdown-item" href="{{ URL::to('/galleries') }}">Galleries</a>
        <a class="dropdown-item" href="{{ URL::to('/about-us/press-room') }}">Press room</a>
        <a class="dropdown-item" href="{{ URL::to('/about-us/directors') }}">Our directors</a>
      </div>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ URL::to('/exhibitions') }}">Exhibitions</a>
    </li>
    <!-- <li class="nav-item active">
      <a class="nav-link" href="https://my.fitzmuseum.cam.ac.uk">Events</a>
    </li> -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ URL::to('/news') }}">News</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Objects and art works</a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ URL::to('/objects-and-artworks/') }}">An introduction</a>
        <a class="dropdown-item" href="{{ URL('https://collection.beta.fitz.ms') }}">Search the collection</a>
        <a class="dropdown-item" href="{{ URL::to('/objects-and-artworks/highlights/') }}">Collection highlights</a>
        <a class="dropdown-item" href="{{ URL::to('/objects-and-artworks/audio-guide/') }}">Audio guide</a>
        <a class="dropdown-item" href="{{ URL::to('/objects-and-artworks/image-library/') }}">Image library</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Learning</a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ URL::to('/learning') }}">Learn with us</a>
        <a class="dropdown-item" href="/learning/look-think-do">Look, Think, Do</a>
        <a class="dropdown-item" href="/learning/resources">Resources</a>
      </div>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ URL::to('/support-us') }}">Support us</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Our research</a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ URL::to('/research') }}">Research at the museum</a>
        <a class="dropdown-item" href="/research/projects">Research projects</a>
        <a class="dropdown-item" href="/research/staff-profiles">Researcher profiles</a>
        <a class="dropdown-item" href="{{ URL::to('/research/online-resources/') }}">Online resources</a>
      </div>
    </li>
</ul>
{{ \Form::open(['url' => url('search/results'),'method' => 'GET', 'class' => 'form-inline ml-auto']) }}
  <label for="search" class="sr-only">Search: </label>
  <input id="query" name="query" type="text" class="form-control mr-sm-2"
  placeholder="Search our site" required value="{{ old('query') }}" aria-label="Your query">
  <button type="submit" class="btn btn-outline-light" id="searchButton" aria-label="Submit your search">Search</button>
{!! Form::close() !!}
</div>
</nav>

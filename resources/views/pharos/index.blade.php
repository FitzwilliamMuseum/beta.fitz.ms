@extends('layouts/layout')
@section('title','Pharos - highlights of our collection')

@section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/img_20190105_153947.jpg')
@section('hero_image_title', "The inside of our Founder's entrance")
@section('content')
<div class="row">
  @foreach($pharos['data'] as $record)

  <div class="col-md-4 mb-3">
    <div class="card card-body h-100">
      @if(!is_null($record['image']))
      <img class="img-fluid" src="{{ $record['image']['data']['thumbnails'][4]['url']}}"/>
        @endif
    <div class="container h-100">

      <div class="contents-label mb-3">
        <h3>
          <a href="/objects-and-artworks/pharos/{{ $record['slug']}}">{{ $record['title']}}</a>
        </h3>
        <p class="card-text">{{ substr(strip_tags(htmlspecialchars_decode($record['description'])),0,200) }}...</p>

      </div>
    </div>
    <a href="/objects-and-artworks/pharos/{{ $record['slug']}}" class="btn btn-dark">Read more</a>
  </div>

</div>
@endforeach

</div>


<nav aria-label="Page navigation">
  {{ $paginator->links() }}
</nav>
@endsection
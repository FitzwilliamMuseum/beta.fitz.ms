@extends('layouts/layout')
@section('title','Collection Contexts')
@section('description', 'A collection of objects from the collection of the Fitzwilliam Museum')
@section('keywords', 'museum,highlights,collection,objects')
@section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/img_20190105_153947.jpg')
@section('hero_image_title', "The inside of our Founder's entrance")

@section('content')
<div class="row">
  @foreach($context as $record)
  <div class="col-md-4 mb-3">
    <div class="card card-body h-100">
      @if(!is_null($record[0]['hero_image']))
        <a href="/objects-and-artworks/highlights/context/{{ $record[0]['section'] }}/"><img class="img-fluid" src="{{ $record[0]['hero_image']['data']['thumbnails'][4]['url']}}"
        alt="{{ $record[0]['hero_image']['title'] }}" loading="lazy"
        width="{{ $record[0]['hero_image']['data']['thumbnails'][4]['width'] }}"
        height="{{ $record[0]['hero_image']['data']['thumbnails'][4]['height'] }}"/></a>
      @endif
      <div class="container h-100">
        <div class="contents-label mb-3">
          <h3>
            <a href="/objects-and-artworks/highlights/context/{{ $record[0]['section'] }}">{!! ucfirst(str_replace('-',' ', $record[0]['section'])) !!}</a></h3>
        </div>
      </div>
      <a href="/objects-and-artworks/highlights/context/{{ $record[0]['section'] }}"
      class="btn btn-dark">Read more</a>
    </div>
  </div>
  @endforeach
</div>
@endsection

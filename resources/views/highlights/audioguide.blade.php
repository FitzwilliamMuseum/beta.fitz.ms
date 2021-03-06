@extends('layouts.layout')
@section('title','Our audio guide')
@section('description', 'A collection of objects from the collection of the Fitzwilliam Museum')
@section('keywords', 'museum,highlights,collection,objects')
@section('hero_image',env('CONTENT_STORE') . 'img_20190105_153947.jpg')
@section('hero_image_title', "The inside of our Founder's entrance")

@section('content')
<div class="row">
  @foreach($stops['data'] as $record)
  <div class="col-md-4 mb-3">
    <div class="card  h-100">
      @if(!is_null($record['hero_image']))
        <a href="/objects-and-artworks/audio-guide/{{ $record['slug']}}"><img class="img-fluid" src="{{ $record['hero_image']['data']['thumbnails'][4]['url']}}"
        alt="{{ $record['hero_image_alt_text'] }}" loading="lazy"
        width="{{ $record['hero_image']['data']['thumbnails'][4]['width'] }}"
        height="{{ $record['hero_image']['data']['thumbnails'][4]['height'] }}"/></a>
      @endif
      <div class="card-body h-100">
        <div class="contents-label mb-3">
          <h3 class="lead">
            <a href="/objects-and-artworks/audio-guide/{{ $record['slug']}}">@markdown($record['title'])</a></h3>
          @if(!empty($record['stop_number']))
            <h4 class="lead text-info">
              Stop number: {{ $record['stop_number']}}
            </h4>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection

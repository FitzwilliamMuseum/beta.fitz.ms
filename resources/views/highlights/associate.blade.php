@extends('layouts/layout')
@foreach($pharos['data'] as $object)
  @section('title', $object['title'])
  @section('description', $object['meta_description'])
  @section('keywords', $object['meta_keywords'])

  @if(!empty($object['hero_image']))
    @section('hero_image', $object['hero_image']['data']['full_url'])
    @section('hero_image_title', $object['hero_image_alt_text'])
  @else
    @section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/img_20190105_153947.jpg')
    @section('hero_image_title', "The inside of our Founder's entrance")
  @endif

  @section('content')
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    @markdown($object['body'])
  </div>
  @endsection

  @if(!empty($records))
  @section('mlt')
  <div class="container">
    <h3>Other pathways and stories you might like</h3>
    <div class="row">
      @foreach($records as $record)
      <div class="col-md-4 mb-3">
        <div class="card card-body h-100">
          @if(!is_null($record['image']))
            <a href="/objects-and-artworks/highlights/context/{{ $record['section'][0]}}/{{ $record['slug'][0] }}"><img class="img-fluid" src="{{ $record['smallimage'][0]}}"
            alt="Highlight image for {{ $record['title'][0] }}" loading="lazy"/></a>
          @endif
          <div class="container h-100">
            <div class="contents-label mb-3">
              @if(isset($record['section']))
                <h3>
                  <a href="/objects-and-artworks/highlights/context/{{ $record['section'][0]}}/{{ $record['slug'][0] }}">{{ $record['title'][0]}}</a>
                </h3>
              @else
                <a href="/objects-and-artworks/highlights/context/{{ $record['slug'][0] }}">{{ $record['title'][0] }}</a>
              @endif
            </h3>

          </div>
        </div>
        @if(isset($record['section']))
          <a href="/objects-and-artworks/highlights/context/{{ $record['section'][0]}}/{{ $record['slug'][0]}}" class="btn btn-dark">Read more</a>
        @else
          <a href="/objects-and-artworks/highlights/context/{{ $record['slug'][0]}}" class="btn btn-dark">Read more</a>
        @endif
      </div>

    </div>
    @endforeach
  </div>
</div>
  @endsection
@endif
@endforeach

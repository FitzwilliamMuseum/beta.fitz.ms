@extends('layouts.layout')

@foreach($pages['data'] as $page)
  @section('title', $page['title'])
  @section('hero_image', $page['hero_image']['data']['thumbnails'][10]['url'])
  @section('hero_image_title', $page['hero_image_alt_text'])
  @section('description', $page['meta_description'])
  @section('keywords', $page['meta_keywords'])
    @section('content')
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 ">
    @markdown($page['body'])
    </div>
    @endsection
@endforeach

@section('resources-plans')
  <div class="container">
    <h2 class="lead">Gallery activities for families</h2>
    <div class="row">
      @foreach($activities['data'] as $resource)
      <div class="col-md-4 mb-3">
        <div class="card  h-100">
          @if(!is_null($resource['hero_image']))
            <a href=" {{ $resource['activity_gdoc_link'] }}"><img class="img-fluid" src="{{ $resource['hero_image']['data']['thumbnails'][4]['url']}}"
            alt="A highlight image for {{ $resource['title'] }}"
            width="{{ $resource['hero_image']['data']['thumbnails'][4]['width'] }}"
            height="{{ $resource['hero_image']['data']['thumbnails'][4]['height'] }}"
            loading="lazy"/></a>
          @endif
          <div class="card-body h-100">
            <div class="contents-label mb-3">
              <h3 class="lead">
                <a class="stretched-link" href="{{ $resource['activity_gdoc_link'] }}">{{ $resource['title'] }}</a>
              </h3>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection

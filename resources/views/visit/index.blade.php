@extends('layouts/visitus')
@section('title', 'Visit us')
@section('hero_image', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/founders.jpg')
@section('hero_image_title', "The Museum's founder's building")
@section('parallax_home', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/old_g3.jpg')


@section('opening-hours')
  <h2>When we're open</h2>
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    @include('includes.elements.opening')
  </div>
@endsection

@section('content')

  @foreach($pages['data'] as $page)
  @section('description', $page['meta_description'])
  @section('keyword', $page['meta_keywords'])
  <div class="col-12 shadow-sm p-3 mt-3 mx-auto mb-3 rounded">
    <h2>{{ $page['title']}}</h2>
    @markdown($page['body'])
  </div>
  @endforeach
@endsection

@section('map')
@map([
    'lat' => 52.200278,
    'lng' => 0.119444,
    'zoom' => 18,
    'minZoom' => 16,
    'maxZoom' => 18,
    'markers' => [
        [
            'title' => 'Find the museum',
            'lat' => 52.200278,
            'lng' => 0.119444,
            'popup' => '<h3>The Museum</h3><p>We are located here</p>',

        ],
    ],
])
@endsection

@section('associated_pages')
<div class="container">
  <div class="row">
    @foreach($associated['data'] as $project)
    <div class="col-md-4 mb-3">
      <div class="card card-body h-100">
        @if(!is_null($project['hero_image']))
        <a href="{{ $project['section']}}/{{ $project['slug']}}"><img class="img-fluid" src="{{ $project['hero_image']['data']['thumbnails'][4]['url']}}"
        alt="{{ $project['hero_image_alt_text'] }}"
        width="{{ $project['hero_image']['data']['thumbnails'][4]['width'] }}"
        height="{{ $project['hero_image']['data']['thumbnails'][4]['height'] }}"
        loading="lazy"/></a>
        @endif
        <div class="container h-100">
          <div class="contents-label mb-3">
            <h3>
              <a href="{{ $project['section']}}/{{ $project['slug']}}">{{ $project['title']}}</a>
            </h3>
          </div>
        </div>
        <a href="{{ $project['section']}}/{{ $project['slug']}}" class="btn btn-dark">Read more</a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

@section('floorplans')
<ul id="floor-plans">
@foreach($floors['data'] as $floor)
  <li><a href="{{$floor['file']['data']['full_url']}}">{{$floor['title']}}</a></li>
@endforeach
</ul>
@endsection

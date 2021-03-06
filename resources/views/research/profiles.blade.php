@extends('layouts/layout')
@section('title','Researcher profiles')
@section('hero_image',env('CONTENT_STORE') . 'baroque.jpg')
@section('hero_image_title', 'The baroque feasting table by Ivan Day in Feast and Fast')
@section('description', 'A page detailing research active staff for the Fitzwilliam Museum')
@section('keywords', 'research,active,museum, archaeology, classics,history,art')
  @section('content')
  <div class="row">
      @foreach($profiles['data'] as $profile)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          @if(!is_null($profile['profile_image']))
          <div class="embed-responsive embed-responsive-1by1">
              <a href="{{ route('research-profile', $profile['slug']) }}"><img class="img-fluid embed-responsive-item" src="{{ $profile['profile_image']['data']['thumbnails'][2]['url']}}"
            alt="Profile image for {{ $profile['display_name'] }}"
            width="{{ $profile['profile_image']['data']['thumbnails'][2]['width'] }}"
            height="{{ $profile['profile_image']['data']['thumbnails'][2]['height'] }}"
            loading="lazy"/></a>
          </div>
          @endif
          <div class="card-body">
            <div class="contents-label mb-3">
            <h3 class="lead">
              <a href="{{ route('research-profile', $profile['slug']) }}">{{ $profile['display_name'] }}</a>
            </h3>
            </div>
          </div>
        </div>
      </div>
      @endforeach
  </div>
  @endsection

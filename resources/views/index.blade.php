@extends('layouts.home')

@section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/founders.jpg')
@section('hero_image_title','The founder\'s building of the museum')
@section('parallax_home', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/old_g3.jpg')
@section('parallax_two', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/confection.jpg')
@section('parallax_three', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/25th_november_057.jpg')
@section('parallax_four', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/e1a3159c12ca0f5091e3e9e5000ad4d0-landscape.jpg')
@section('parallax_three_lower', 'https://fitz-cms-images.s3.eu-west-2.amazonaws.com/25th_november_057.jpg')
@section('description', 'This is the Beta Website for the Fitzwilliam Museum, the University of Cambridg\'s principal museum')
@section('keywords', 'fitzwilliam, museum, cambridge, university, art, design, archaeology')
@section('title', 'The Fitzwilliam Museum')

@section('content')
  "Discover one of the greatest art collections of the nation"
@endsection

@section('news')
  @foreach($news['data'] as $project)
  <div class="col-md-4 mb-3">
    <div class="card card-body h-100">
      @if(!is_null($project['field_image']))
        <a href="news/{{ $project['slug']}}"><img class="img-fluid" src="{{ $project['field_image']['data']['thumbnails'][4]['url']}}"
      alt="{{ $project['field_image_alt_text'] }}" /></a>
      @endif
      <div class="container h-100">
        <div class="contents-label mb-3">
          <h3>
            <a href="news/{{ $project['slug']}}">{{ $project['article_title']}}</a>
          </h3>
        </div>
      </div>
      <a href="news/{{ $project['slug']}}" class="btn btn-dark">Read more</a>
    </div>
  </div>
  @endforeach
@endsection

@section('research')
  @foreach($research['data'] as $project)
  <div class="col-md-4 mb-3">
    <div class="card card-body h-100">
        @if(!is_null($project['hero_image']))
          <a href="research/projects/{{ $project['slug']}}"><img class="img-fluid" src="{{ $project['hero_image']['data']['thumbnails'][4]['url']}}"
          alt="{{ $project['hero_image_alt_text'] }}" loading="lazy"
          width="{{ $project['hero_image']['data']['thumbnails'][4]['width'] }}"
          height="{{ $project['hero_image']['data']['thumbnails'][4]['height'] }}" /></a>
        @endif
        <div class="container h-100">
          <div class="contents-label mb-3">
            <h3>
              <a href="research/projects/{{ $project['slug']}}">{{ $project['title']}}</a>
            </h3>
          </div>
        </div>
      <a href="research/projects/{{ $project['slug']}}" class="btn btn-dark">Read more</a>
    </div>
  </div>
  @endforeach
@endsection

@section('themes')
  @foreach($objects['data'] as $theme)
  <div class="col-md-4 mb-3">
    <div class="card card-body h-100">
      @if(!is_null($theme['image']))
      <a href="objects-and-artworks/highlights/{{ $theme['slug']}}"><img class="img-fluid" src="{{ $theme['image']['data']['thumbnails'][4]['url']}}"
      alt="{{ $theme['image_alt_text'] }}"
      loading="lazy"
      height="{{ $theme['image']['data']['thumbnails'][4]['height'] }}"
      width="{{ $theme['image']['data']['thumbnails'][4]['width'] }}"/></a>
      @endif
      <div class="container h-100">
        <div class="contents-label mb-3">
          <h3>
            <a href="objects-and-artworks/highlights/{{ $theme['slug']}}">{{ $theme['title']}}</a>
          </h3>
        </div>
      </div>
      <a href="objects-and-artworks/highlights/{{ $theme['slug']}}" class="btn btn-dark">Read more</a>
    </div>
  </div>
  @endforeach
@endsection

@section('twitter')
  @include('includes.social.tweets')
@endsection



@section('youtube-list')
  @include('includes.social.youtubelist')
@endsection

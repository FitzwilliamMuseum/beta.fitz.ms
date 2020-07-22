@extends('layouts/layout')
@foreach($pharos['data'] as $record)
  @section('keywords', $record['meta_keywords'])
  @section('description', $record['meta_description'])
  @section('title', $record['title'])
  @section('hero_image', $record['image']['data']['full_url'])
  @section('hero_image_title', $record['image_alt_text'])
  @section('content')
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    <figure class="figure float-right p-3">
      <img src="{{ $record['image']['data']['thumbnails']['7']['url']}}"
      alt="{{ $record['image_alt_text'] }}" class="img-fluid"
      loading="lazy"
      height="{{ $record['image']['data']['thumbnails']['7']['height'] }}"
      width="{{ $record['image']['data']['thumbnails']['7']['width'] }}"
      />
      <figcaption class="figure-caption text-right">{{$record['image_alt_text']}}</figcaption>
      <span class="btn btn-wine m-1 p-2 share">
        <a href="{{ URL::to( $record['image']['data']['full_url'] ) }}"
         download><i class="fas fa-download mr-2"></i>  Download image</a>
      </span>
      <span class="btn btn-dark p-2">
      <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Licence" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a>
      </span>
      @if(isset($record['custom_print_url']))
      <span class="btn btn-wine m-1 p-2 share">
      <a href="{{ $record['custom_print_url'] }}"><i class="fas fa-shopping-cart"></i> Buy a print</a>
      </span>
      @endif
    </figure>
    @markdown($record['description'])
  </div>

  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    <h3>Further information</h3>
    <ul>
      <li>Collections ID: {{$record['adlib_id']}}</li>
      @if(!is_null($record['place_of_origin']))
        <li>Place of origin: {{ $record['place_of_origin'] }}</li>
      @endif
      @if(!is_null($record['date']))
        <li>Date: {{ $record['date'] }}</li>
      @endif
      @if(!is_null($record['maker'] ))
        <li>Maker: {{ $record['maker'] }}</li>
      @endif
      @if(!is_null($record['material'] ))
        <li>Material: {{ $record['material'] }}</li>
      @endif
      @if(!is_null($record['map']))
        <li>Map coordinates: {{ $record['map']['lat'] }}, {{$record['map']['lng']}}</li>
      @endif
    </ul>
  </div>

  @endsection

  @if(!is_null($record['map']))
  @section('map')
  @map(
    [
      'lat' => $record['map']['lat'],
      'lng' => $record['map']['lng'],
      'zoom' => 6,
      'markers' => [
        ['title' => 'Place of origin',
        'lat' => $record['map']['lat'],
        'lng' => $record['map']['lng'],
        'popup' => 'Place of origin',],
        ],
    ]
  )
  @endsection
  @endif

  @section('youtube')
  @if(!empty($record['youtube_id']))
  <div class="container">
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded ">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" title="A video from YouTube related to {{ $record['title'] }}"
        src="https://www.youtube.com/embed/{{$record['youtube_id']}}" frameborder="0"
        allowfullscreen></iframe>
      </div>
    </div>
  </div>
  @endif
  @endsection

  @section('sketchfab-collection')
    @if(!empty($record['sketchfab_id']))
    <div class="container">
      <h2>3D scan</h2>
      <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
        <div class="embed-responsive embed-responsive-1by1">
          <iframe title="A 3D model of {{ $record['title'] }}" class="embed-responsive-item"
          src="https://sketchfab.com/models/{{ $record['sketchfab_id']}}/embed?"
          frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
        </div>
      </div>
    </div>
    @endif
  @endsection


  @if(!empty($record['audio_guide']))
  @section('audio-guide')
  @include('includes.elements.audio-guide')
  @endsection
  @endif

  @if(!empty($record['associated_pharos_content']))
  @section('pharos-pages')
  <div class="container">
    <h3>Associated content</h3>
    <div class="row">
      @foreach($record['associated_pharos_content'] as $pharosassoc)
      <div class="col-md-4 mb-3">
        <div class="card card-body h-100">
          @if(!is_null($pharosassoc['pharos_pages_id']['hero_image']))
            <a href="/objects-and-artworks/highlights/context/{{ $pharosassoc['pharos_pages_id']['section']}}/{{ $pharosassoc['pharos_pages_id']['slug']}}"><img class="img-fluid" src="{{ $pharosassoc['pharos_pages_id']['hero_image']['data']['thumbnails'][4]['url']}}"
            alt="{{ $pharosassoc['pharos_pages_id']['hero_image_alt_text'] }}"
            loading="lazy"/></a>
          @else
            <img src="https://fitz-cms-images.s3.eu-west-2.amazonaws.com/fvlogo.jpg" class="rounded img-fluid"  />
          @endif
          <div class="container h-100">
            <div class="contents-label mb-3">
              <h3><a href="/objects-and-artworks/highlights/context/{{ $pharosassoc['pharos_pages_id']['section']}}/{{ $pharosassoc['pharos_pages_id']['slug']}}">{{ $pharosassoc['pharos_pages_id']['title']}}</a></h3>
            </div>
          </div>
          <a href="/objects-and-artworks/highlights/context/{{ $pharosassoc['pharos_pages_id']['section']}}/{{ $pharosassoc['pharos_pages_id']['slug']}}" class="btn btn-dark">Read more</a>
        </div>

      </div>
      @endforeach
    </div>
  </div>
  @endsection
  @endif

  @if(!empty($records))
  @section('mlt')
  <div class="container">
    <h3>Other highlight objects you might like</h3>
    <div class="row">
      @foreach($records as $record)
      <div class="col-md-4 mb-3">
        <div class="card card-body h-100">
          @if(!is_null($record['smallimage']))
            <a href="/objects-and-artworks/highlights/{{ $record['slug'][0] }}"><img class="img-fluid" src="{{ $record['smallimage'][0]}}"
            alt="Highlight image for {{ $record['title'][0] }}" loading="lazy"/></a>
          @endif
          <div class="container h-100">
            <div class="contents-label mb-3">
              <h3>
                <a href="/objects-and-artworks/highlights/{{ $record['slug'][0] }}">{{ $record['title'][0] }}</a>
              </h3>
              <!-- <p class="card-text">
                {{ substr(strip_tags(htmlspecialchars_decode($record['description'][0])),0,200) }}...
              </p> -->
            </div>
          </div>
          <a href="/objects-and-artworks/highlights/{{ $record['slug'][0]}}" class="btn btn-dark">Read more</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endsection
  @endif
@endforeach

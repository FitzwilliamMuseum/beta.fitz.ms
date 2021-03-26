@extends('layouts/exhibitions')

@foreach($exhibitions['data'] as $coll)
    @section('keywords', $coll['meta_keywords'])
    @section('description', $coll['meta_description'])
    @section('title', $coll['exhibition_title'])
    @section('hero_image', $coll['hero_image']['data']['full_url'])
    @section('hero_image_title', $coll['hero_image_alt_text'])

    @section('content')
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 ">
      @markdown($coll['exhibition_narrative'])
      @if(isset($coll['exhibition_abstract']))
        @markdown($coll['exhibition_abstract'])
      @endif
    </div>

    @if( isset($coll['exhibition_url']) || isset($coll['exhibition_start_date']))
    <h3>Exhibition details</h3>
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 ">
      <ul>
        @if(isset($coll['exhibition_url']))
          <li>
            <a href="{{ $coll['exhibition_url']  }}">Exhibition website</a>
          </li>
        @endif
        @if(isset($coll['exhibition_start_date']))
          <li>
            Exhibition run: {{  Carbon\Carbon::parse($coll['exhibition_start_date'])->format('l dS F Y') }} to
            {{  Carbon\Carbon::parse($coll['exhibition_end_date'])->format('l dS F Y') }}
          </li>
        @endif
      </ul>
    </div>
    @endif

    @if(!empty($coll['exhibition_files']))
    <h3>Exhibition files</h3>
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 ">
      <ul>
        @foreach($coll['exhibition_files'] as $file)
          <li>
            <a href="{{ $file['directus_files_id']['data']['full_url'] }}">{{ $file['directus_files_id']['title'] }}</a>
          </li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(isset($coll['youtube_id']))
      <h3>
        Exhibition film
      </h3>
        <div class="col-12 shadow-sm p-3 mx-auto mb-3 ">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" title="A film related to {{ $coll['exhibition_title'] }}"
            loading="lazy"
            src="https://www.youtube.com/embed/{{$coll['youtube_id']}}" frameborder="0"
            allowfullscreen></iframe>
          </div>
        </div>
      @endif
    @endsection

    @if(!empty($coll['associated_curators']))
      @section('curators')
        <div class="container">
          <h3>Associated curators</h3>
          <div class="row">
            @foreach($coll['associated_curators'] as $curator)
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                @if(!is_null($curator['staff_profiles_id']['profile_image']))
                <div class="embed-responsive embed-responsive-1by1">
                  <a href="{{ route('research-profile', $curator['staff_profiles_id']['slug']) }}"><img
                    class="img-fluid embed-responsive-item" src="{{ $curator['staff_profiles_id']['profile_image']['data']['thumbnails'][7]['url']}}"
                  loading="lazy"
                  alt="{{ $curator['staff_profiles_id']['profile_image_alt_text'] }}"
                  height="{{ $curator['staff_profiles_id']['profile_image']['data']['thumbnails'][7]['height'] }}"
                  width="{{ $curator['staff_profiles_id']['profile_image']['data']['thumbnails'][7]['width'] }}"
                  /></a>
                </div>
                @endif
                <div class="card-body">
                  <div class="contents-label mb-3">
                    <h3>
                      <a href="{{ route('research-profile', $curator['staff_profiles_id']['slug']) }}">{{ $curator['staff_profiles_id']['display_name']}}</a>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      @endsection
    @endif

    @if(!empty($coll['exhibition_partners'] ))
      @section('research-funders')
        <div class="container">
          <h3>Funders and partners</h3>
          <div class="row">
            @foreach($coll['exhibition_partners'] as $partner)
            <div class="col-md-4 mb-3">
              <div class="card  h-100">
                @if(!is_null( $partner['partner']['partner_logo']))
                <div class="embed-responsive embed-responsive-4by3">
                  <img class="img-fluid embed-responsive-item" src="{{ $partner['partner']['partner_logo']['data']['thumbnails'][4]['url']}}"
                  alt="Logo for {{ $partner['partner']['partner_full_name']}}"
                  height="{{ $partner['partner']['partner_logo']['data']['thumbnails'][4]['height'] }}"
                  width="{{ $partner['partner']['partner_logo']['data']['thumbnails'][4]['width'] }}"
                  loading="lazy"/>
                </div>
                @else
                <div class="embed-responsive embed-responsive-4by3">
                  <img class="img-fluid embed-responsive-item" src="https://content.fitz.ms/fitz-website/assets/gallery3_roof.jpg?key=directus-large-crop"
                  alt="The Fitzwilliam Museum's Gallery 3 roof"
                  loading="lazy"/>
                </div>
                @endif
                <div class="card-body">
                  <div class="contents-label mb-3">
                    <h3>
                      <a href="{{ $partner['partner']['partner_url']}}">{{ $partner['partner']['partner_full_name']}}</a>
                    </h3>
                    <p>{{ $partner['partner']['partner_type'][0]}}</p>
                  </div>
                </div>

              </div>

            </div>
            @endforeach
          </div>
        </div>
      @endsection
    @endif

    @if(!empty($coll['associated_departments']))
      @section('departments')
        <div class="container">
          <h3>Associated departments</h3>
          <div class="row">
            @foreach($coll['associated_departments'] as $gallery)
            <div class="col-md-4 mb-3">
              <div class="card  h-100">
                @if(!is_null($gallery['departments_id']['hero_image']))
                <div class="embed-responsive embed-responsive-4by3">
                <a href="{{ route('department', $gallery['departments_id']['slug']) }}"><img class="img-fluid embed-responsive-item" src="{{ $gallery['departments_id']['hero_image']['data']['thumbnails'][4]['url']}}"
                loading="lazy" alt="Highlight image for {{ gallery['departments_id']['hero_image_alt_text'] }}"
                height="{{ $gallery['departments_id']['hero_image']['data']['thumbnails'][4]['height'] }}"
                width="{{ $gallery['departments_id']['hero_image']['data']['thumbnails'][4]['width'] }}"
                /></a>
                </div>
                @endif
                <div class="card-body ">
                  <div class="contents-label mb-3">
                    <h3>
                      <a href="/departments/{{ $gallery['departments_id']['slug']}}">{{ $gallery['departments_id']['title']}}</a>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      @endsection
    @endif


    @if(!empty($coll['exhibition_carousel']))
    @section('excarousel')
      <style>
      .exhibition-carousel {
          color: black!important;
          position: inherit!important;
          margin-top: 500px;
          /* max-width: 100%!important;
          width:100% !important; */
      }

      .carousel-control-prev-icon,
.carousel-control-next-icon {

  background-image: none;
}

.carousel-control-next-icon:after
{
  content: '>';
  font-size: 55px;
  color: black;
}

.carousel-control-prev-icon:after {
  content: '<';
  font-size: 55px;
  color: black;
}


ol.carousel-indicators li,
ol.carousel-indicators li.active {

  background: white;
}

ol.carousel-indicators li.active {
  background: black;
}
      </style>
        <div class="bd-example mb-3">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item">
                <img class="d-block w-100" alt="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_one_alt_text'] }}" src="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_one']['data']['thumbnails'][5]['url'] }}" >
                <div class="carousel-caption w-100 d-none d-md-block text-black exhibition-carousel">
                  <h5 class="text-black">{{ $coll['exhibition_carousel'][0]['carousels_id']['image_one_alt_text'] }}</h5>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" alt="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_two_alt_text'] }}" src="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_two']['data']['thumbnails'][5]['url'] }}" >
                <div class="carousel-caption d-none d-md-block text-black exhibition-carousel">
                  <h5>{{ $coll['exhibition_carousel'][0]['carousels_id']['image_two_alt_text'] }}</h5>
                </div>
              </div>
              <div class="carousel-item active">
                <img class="d-block w-100" alt="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_three_alt_text'] }}" src="{{ $coll['exhibition_carousel'][0]['carousels_id']['image_three']['data']['thumbnails'][5]['url'] }}" >
                <div class="carousel-caption  d-none d-md-block text-black exhibition-carousel">
                  <h5>{{ $coll['exhibition_carousel'][0]['carousels_id']['image_three_alt_text'] }}</h5>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

  @endsection
  @endif

    @if(!empty($coll['associated_galleries']))
    @section('galleries')
      <div class="container">
        <h3>Associated Galleries</h3>
        <div class="row">
          @foreach($coll['associated_galleries'] as $gallery)
          <div class="col-md-4 mb-3">
            <div class="card  h-100">
              @if(!is_null($gallery['galleries_id']['hero_image']))
              <a href="{{ route('gallery', $gallery['galleries_id']['slug']) }}"><img class="img-fluid" src="{{ $gallery['galleries_id']['hero_image']['data']['thumbnails'][4]['url']}}" loading="lazy"
              alt="A highlight image of {{ $gallery['galleries_id']['hero_image_alt_text'] }}"
              height="{{ $gallery['galleries_id']['hero_image']['data']['thumbnails'][4]['height'] }}"
              width="{{ $gallery['galleries_id']['hero_image']['data']['thumbnails'][4]['width'] }}"
              /></a>
              @endif
              <div class="card-body h-100">
                <div class="contents-label mb-3">
                  <h3>
                    <a href="{{ route('gallery', $gallery['galleries_id']['slug']) }}">{{ $gallery['galleries_id']['gallery_name']}}</a>
                  </h3>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endsection
    @endif
  
    @section('360')
      @if(!empty($coll['image_360_pano']))
        <div class="container">
          <h3>360 gallery image</h3>
          <div class="col-12 shadow-sm p-3 mx-auto mb-3">
            <div id="panorama"></div>
          </div>
        </div>
        @section('360_image', $coll['image_360_pano']['data']['full_url']))
      @endif
    @endsection

@endforeach

@if(!empty($records))
@section('mlt')
<div class="container">
  <h3>Similar exhibitions</h3>
  <div class="row">
    @foreach($records as $record)
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        @if(!is_null($record['smallimage']))
        <div class="embed-responsive embed-responsive-4by3">
          <img class="img-fluid embed-responsive-item" src="{{ $record['smallimage'][0]}}"
          alt="Highlight image for {{ $record['title'][0] }}" loading="lazy"/>
        </div>
        @endif
        <div class="card-body ">
          <div class="contents-label mb-3">
            <h3>
              <a href="/visit-us/exhibitions/{{ $record['slug'][0] }}">{{ $record['title'][0] }}</a>
            </h3>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
@endif

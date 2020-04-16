@extends('layouts/exhibitions')

@foreach($exhibitions['data'] as $coll)
@section('keywords', $coll['meta_keywords'])
@section('description', $coll['meta_description'])
@section('title', $coll['exhibition_title'])
@section('hero_image', $coll['hero_image']['data']['full_url'])
@section('hero_image_title', $coll['hero_image_alt_text'])

@section('content')
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded ">
    @markdown($coll['exhibition_narrative'])
  </div>
  @if($coll['youtube_id'])
  <h2>Exhibition film</h2>
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded ">
  <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item "
    src="https://www.youtube.com/embed/{{$coll['youtube_id']}}" frameborder="0"
    allowfullscreen></iframe>
  </div>
</div>
  @endif
@endsection
@if(!empty($coll['associated_curators']))
@section('curators')

<div class="container">
  <h2>Associated curators</h2>
  <div class="row">
@foreach($coll['associated_curators'] as $curator)
<div class="col-md-4 mb-3">
  <div class="card card-body h-100">
    @if(!is_null($curator['staff_profiles_id']['profile_image']))
    <img class="img-fluid" src="{{ $curator['staff_profiles_id']['profile_image']['data']['thumbnails'][7]['url']}}"/>
      @endif
  <div class="container h-100">
    <div class="contents-label mb-3">
      <h3>
        <a href="/research/staff-profiles/{{ $curator['staff_profiles_id']['slug']}}">{{ $curator['staff_profiles_id']['display_name']}}</a>
      </h3>
    </div>
  </div>
  <a href="/research/staff-profiles/{{ $curator['staff_profiles_id']['slug']}}" class="btn btn-dark">Read more</a>
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
      <h2>Associated departments</h2>
      <div class="row">
    @foreach($coll['associated_departments'] as $gallery)
    <div class="col-md-6 mb-3">

      <div class="card card-body h-100">
        @if(!is_null($gallery['departments_id']['hero_image']))
        <img class="img-fluid" src="{{ $gallery['departments_id']['hero_image']['data']['thumbnails'][4]['url']}}"/>
        @endif
      <div class="container h-100">
        <div class="contents-label mb-3">
          <h3>
            <a href="/departments/{{ $gallery['departments_id']['slug']}}">{{ $gallery['departments_id']['title']}}</a>
          </h3>
        </div>
      </div>
      <a href="/departments/{{ $gallery['departments_id']['slug']}}" class="btn btn-dark">Read more</a>
    </div>

    </div>
    @endforeach
      </div>
    </div>
    @endsection
    @endif




  @if(!empty($coll['associated_galleries']))
  @section('galleries')

  <div class="container">
    <h2>Associated Galleries</h2>
    <div class="row">
  @foreach($coll['associated_galleries'] as $gallery)
  <?php
  // dd($gallery);
  ?>
  <div class="col-md-6 mb-3">

    <div class="card card-body h-100">
      @if(!is_null($gallery['galleries_id']['hero_image']))
      <img class="img-fluid" src="{{ $gallery['galleries_id']['hero_image']['data']['thumbnails'][4]['url']}}"/>
      @endif
    <div class="container h-100">
      <div class="contents-label mb-3">
        <h3>
          <a href="/galleries/{{ $gallery['galleries_id']['slug']}}">{{ $gallery['galleries_id']['gallery_name']}}</a>
        </h3>
      </div>
    </div>
    <a href="/galleries/{{ $gallery['galleries_id']['slug']}}" class="btn btn-dark">Read more</a>
  </div>

  </div>
  @endforeach
    </div>
  </div>
  @endsection
  @endif




@endforeach
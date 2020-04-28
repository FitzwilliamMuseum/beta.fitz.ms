@extends('layouts.layout')
@foreach($projects['data'] as $project)
@section('keywords', $project['meta_keywords'])
@section('description', $project['meta_description'])
@section('title', $project['title'])
@section('hero_image', $project['hero_image']['data']['full_url'])
@section('hero_image_title', $project['hero_image_alt_text'])
@section('content')
<div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
  @markdown($project['project_overview'])
  @if($project['project_url'])
  <ul>
    <li>Project website: <a href="{{ $project['project_url']}}">{{ $project['project_url']}}</a></li>
  </ul>
  @endif
</div>
@endsection

@if(!empty($project['project_partnerships'] ))
@section('research-funders')
<div class="container">
  <h2>Funders and partners</h2>
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    <ul>
      @foreach($project['project_partnerships'] as $partner)
      <li>{{ $partner['partner']['partner_full_name']}} : {{ $partner['partner']['partner_type'][0]}}</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
@endif


@if(isset($project['outcomes']))
@section('research-projects')
<div class="container">
  <h2>Outcomes of the project</h2>
  <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
    @markdown($project['outcomes'])
  </div>
</div>
@endsection
@endif
@endforeach

@if(!empty($records))
@section('mlt')
<div class="container">
  <h3>Other research projects you might like</h3>
  <div class="row">

    @foreach($records as $record)

    <div class="col-md-4 mb-3">
      <div class="card card-body h-100">
        @if(!is_null($record['thumbnail']))
        <img class="img-fluid" src="{{ $record['thumbnail'][0]}}"/>
        @else
        <img class="img-fluid" src="https://content.fitz.ms/fitz-website/assets/gallery3_roof.jpg?key=directus-large-crop"/>
        @endif
        <div class="container h-100">

          <div class="contents-label mb-3">
            <h3>
              <a href="/research/projects/{{ $record['slug'][0]}}">{{ $record['title'][0]}}</a>
            </h3>
            <p class="card-text">{{ substr(strip_tags($record['description'][0]),0,200) }}...</p>

          </div>
        </div>
        <a href="/research/projects/{{ $record['slug'][0]}}" class="btn btn-dark">Read more</a>
      </div>

    </div>
    @endforeach
  </div>
</div>
@endsection
@endif

@extends('layouts.layout')
@section('title','Search results')
@section('hero_image','https://fitz-cms-images.s3.eu-west-2.amazonaws.com/img_20190105_153947.jpg')
@section('hero_image_title', "The inside of our Founder's entrance")

@section('content')
<div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
  {{ \Form::open(['url' => url('search/results'),'method' => 'GET']) }}
  <div class="row center-block">
    <div class="col-lg-6 center-block searchform">
      <div class="input-group">
        <input type="text" id="query" name="query" value="" class="form-control mr-4"
        placeholder="Search our site" required value="{{ old('query') }}">
        <span class="input-group-btn">
          <button class="btn btn-dark" type="submit">Search...</button>
        </span>
      </div>
    </div>
  </div>
  @if(count($errors))
  <div class="form-group">
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif
  {!! Form::close() !!}
</div>
<h2>Search results</h2>
<div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
  <p>
    Your search for <strong>{{ $queryString }}</strong> returned <strong>{{ $number }}</strong> results.
  </p>
</div>

  @if(!empty($records))

  @foreach($records as $result)
    <div class="col-12 shadow-sm p-3 mx-auto mb-3 rounded">
      <h3><a href="/{{ $result['url'][0]}}">{{ $result['title'][0]}}</a></h3>
      @if(isset($result['pubDate']))
      <h4class="text-muted">{{  Carbon\Carbon::parse($result['pubDate'][0])->format('l dS F Y') }}</h4>
      @endif
      @if(isset($result['searchImage']))
        <img src="{{$result['searchImage'][0]}}" class="img-fluid rounded float-right" />
      @endif
      <p>
        @if(!empty($result['description'][0]))
          {{ substr(strip_tags(htmlspecialchars_decode($result['body'][0])),0,200) }}...
        @endif
      </p>
      @if(isset($result['mimetype']))
      @if(!is_null($result['mimetype'] && $result['mimetype'] == 'application\pdf'))
        <p><a href="{{$result['url'][0]}}">{{$result['url'][0]}}</a></p>
      @else
        <p><a href="{{URL::to('/')}}/{{$result['url'][0]}}">{{URL::to('/')}}/{{$result['url'][0]}}</a></p>
      @endif
      @endif
      <p>
        <span class="badge badge-dark p-2">@contentType($result['contentType'][0])</span>
        @if(isset($result['mimetype']))
        @if(!is_null($result['mimetype'] && $result['mimetype'] == 'application\pdf'))
        <span class="badge badge-dark p-2">
          <i class="fas fa-file-pdf mr-2"></i>
          <i class="fa fa-download mr-2" aria-hidden="true"></i> @humansize($result['filesize'][0],2)
        </span>
        @endif
        @endif
      </p>
      </div>
  @endforeach
  <nav aria-label="Page navigation">
    {{ $paginate->links() }}
  </nav>

@else
  <p>No results to display.</p>
@endif
</div>
</div>
@endsection

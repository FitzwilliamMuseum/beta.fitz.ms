<div class="row">
  @foreach($tweets as $tweet)
  <div class="col-md-4 mb-3">
    <div class="card h-100">
      @if(isset($tweet->extended_entities))
      @foreach($tweet->extended_entities as $entity)
      <div class="embed-responsive embed-responsive-4by3">
        <a href="{{ Twitter::linkTweet($tweet) }}"><img class="img-fluid  embed-responsive-item" src="{{ $entity[0]->media_url_https }}:small"
        width="680" height="672" loading="lazy" alt="An image from Twitter"/></a>
      </div>
      @endforeach
      @else
      <div class="embed-responsive embed-responsive-4by3">
        <a href="{{ Twitter::linkTweet($tweet) }}"><img class="img-fluid twitter embed-responsive-item" src="https://pbs.twimg.com/profile_images/1057934206368710656/NE1KayiE.jpg"/></a>
      </div>
      @endif
      <div class="card-body">
        <div class="contents-label mb-3">
          <p>{!! Twitter::linkify($tweet->full_text) !!}</p>
          <p>Retweets: {{ $tweet->retweet_count }} Favourited: {{ $tweet->favorite_count }}</p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

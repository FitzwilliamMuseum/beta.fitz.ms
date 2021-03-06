<!DOCTYPE html>
<html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/  dc: http://purl.org/dc/terms/  foaf: http://xmlns.com/foaf/0.1/  og: http://ogp.me/ns#  rdfs: http://www.w3.org/2000/01/rdf-schema#  schema: http://schema.org/  sioc: http://rdfs.org/sioc/ns#  sioct: http://rdfs.org/sioc/types#  skos: http://www.w3.org/2004/02/skos/core#  xsd: http://www.w3.org/2001/XMLSchema# ">
<head>

    @include('includes.structure.meta')

    @include('includes.css.css')

    @hasSection('map')
      @mapstyles
    @endif

    @include('includes.structure.manifest')
    @yield('jsonld')
    @include('googletagmanager::head')
</head>
<body class="doc-body">
  @include('googletagmanager::body')

  @include('includes.structure.accessibility')

  @include('includes.structure.nav')

  @include('includes.structure.head')
  @include('includes.structure.open')

  @hasSection('timeline')
    @include('includes.css.timeline-css')
  @endif

  @hasSection('360')
    @include('includes.css.photosphere-css')
  @endif

  <div class="container mt-3">
    @include('includes.structure.breadcrumb')
    @yield('press-contact')
    @yield('content')

    @yield('adlib')
    @yield('timeline')
  </div>

  @yield('immunity')
  
  @hasSection('collection-parallax')
    @include('includes.structure.parallax')
  @endif
  @hasSection('theme-carousel')
    @yield('theme-carousel')
  @endif

  @hasSection('collection-parallax')
    @include('includes.structure.parallax')
  @endif

  @hasSection('period-carousel')
    @yield('period-carousel')
  @endif

  @hasSection('collection-parallax')
    @include('includes.structure.parallax')
  @endif

  @hasSection('context-carousel')
    @yield('context-carousel')
  @endif

  @hasSection('collection-parallax')
    @include('includes.structure.parallax')
  @endif

  @hasSection('map')
  <div class="container-fluid map-box mb-3">
    @yield('map')
  </div>
  @endif
    @yield('associated_pages')

    @hasSection('cons-areas')
      @yield('cons-areas')
    @endif

    @yield('releases')
    @yield('resources-plans')
    @yield('diy')
    @yield('publications')
    @yield('research-projects')
    @yield('exhibitions-curated')
    @yield('departments-affiliated')
    @yield('research-funders')
    @yield('themes')
    @yield('collections')
    @yield('departments')
    @yield('curators')
    @yield('galleries')
    @yield('360')
    @yield('youtube')
    @yield('sms')
    @yield('youtube-playlist')
    @yield('sketchfab-collection')
    @yield('sketchfab')
    @yield('audio-guide')
    @yield('pharos-pages')
    @yield('twitter')
    @yield('mlt')
    @yield('shopifyPrints')
    @yield('shopify')

  @include('includes.structure.emailsignup')
  @include('includes.structure.share')

  @include('includes.structure.footer')

  @include('includes.structure.modal')

  @hasSection('lookanswers')
    @yield('lookanswers')
  @endif

  @hasSection('thinkanswers')
    @yield('thinkanswers')
  @endif

  @hasSection('doanswers')
    @yield('doanswers')
  @endif

  @include('includes.scripts.javascript')

  @hasSection('360')
    @include('includes.scripts.photosphere-js')
  @endif

  @hasSection('map')
    @mapscripts
    @include('includes.scripts.mapjs')
  @endif

  @hasSection('timeline')
    @include('includes.scripts.timeline-js')
  @endif

  @hasSection('datepicker')
    @yield('datepicker')
  @endif
</body>
</html>

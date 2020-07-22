<!DOCTYPE html>
<html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/  dc: http://purl.org/dc/terms/  foaf: http://xmlns.com/foaf/0.1/  og: http://ogp.me/ns#  rdfs: http://www.w3.org/2000/01/rdf-schema#  schema: http://schema.org/  sioc: http://rdfs.org/sioc/ns#  sioct: http://rdfs.org/sioc/types#  skos: http://www.w3.org/2004/02/skos/core#  xsd: http://www.w3.org/2001/XMLSchema# ">
<head>

  @include('includes.structure.meta')

  @include('includes.css.css')

  @include('includes.structure.manifest')
</head>
<body class="doc-body">

  @include('includes.structure.accessibility')

  @include('includes.structure.nav')

  @include('includes.structure.head')

  @include('includes.structure.beta')

  <div class="container-fluid parallax parallax-home text-center">
  </div>

  <div class="container mt-3">
    <h2>What's happening</h2>
    <div class="row">
      @yield('news')
    </div>
  </div>

  <div class="container-fluid parallax second-parallax-home">
  </div>

  @include('includes.structure.thingstodo')

  <div class="container-fluid parallax second-parallax-home mt-3">
  </div>

  <div class="container-fluid remove mt-4">
    <div class="container"><h2>Visit our galleries in 360 vision</h2></div>
    <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://poly.google.com/view/4GQfIK8JYDB/embed?chrome=min"
    frameborder="0" style="border:none;" allowvr="yes" allow="vr; xr; accelerometer; magnetometer; gyroscope; autoplay;"
     allowfullscreen="1" mozallowfullscreen="1" webkitallowfullscreen="true" onmousewheel="" ></iframe>
    </div>
  </div>

  <div class="container mt-3">
    <h2>Collections highlights</h2>
    <div class="row">
      @yield('themes')
    </div>
  </div>

  <div class="container-fluid">
    <div class="negative-padding">
      @include('includes.structure.carousel')
    </div>
  </div>

  <div class="container mt-3">
    <h2>Our research</h2>
    <div class="row">
      @yield('research')
    </div>
  </div>

  <div class="container-fluid parallax third-parallax-home mb-3">
  </div>

  <div class="container ">
    <h2>Our Twitter profile</h2>
    @yield('twitter')
  </div>

  <div class="container-fluid parallax third-parallax-home-lower mb-3">
  </div>

  <!-- <div class="container ">
    <h2>Our Instagram profile</h2>
    @yield('instagram')
  </div> -->
  
  <div class="container-fluid parallax fourth-parallax-home mb-3">
  </div>

  <div class="container ">
    <h2>Watch us</h2>
    @yield('youtube-list')
  </div>

  @include('includes.structure.share')

  @include('includes.structure.footer')
  @include('includes.structure.modal')
  @include('includes.scripts.javascript')

</body>
</html>

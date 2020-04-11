    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">

    <title>The Fitzwilliam Museum - @yield('title')</title>
    <!-- Canonical link -->
    <link rel="canonical" href="{{ URL::current() }}" />

    <!-- Open graph -->
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="{{ URL::to('/') }}" />
    <meta property="og:site_name" content="The Fitzwilliam Museum" />
    <meta property="og:image" content="{{ URL::to('/images/') }}" />

    <!-- Twitter card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:site" content="@yield('twitter_id', '@fitzmuseum_uk')" />
    <meta name="twitter:image" content="{{ URL::to('/images/') }}" />
    <meta name="twitter:creator" content="@yield('twitter_id', '@fitzmuseum_uk')" />

    <!-- Humans text -->
    <link type="text/plain" rel="author" href="{{ URL::to('/humans.txt') }}" />

    <script type="application/ld+json">
    {"publisher":{"@type":"Organization","logo":{"@type":"ImageObject","url":"https://feast-and-fast.fitzmuseum.cam.ac.uk/images/logos/FitzLogo.png"}},
    "headline":"Feast &amp; Fast","@type":"WebSite","url":"https://feast-and-fast.fitzmuseum.cam.ac.uk/",
    "name":"Feast &amp; Fast",
    "description":"Food defines us as individuals, communities, and nations: we are what we eat and, equally, what we don’t eat. When, where, why, how and with whom we eat are crucial to our identity. Feast &amp; Fast presents novel approaches to understanding the history and culture of food and eating.","@context":"https://schema.org"}</script>
    <!-- End Jekyll SEO tag -->

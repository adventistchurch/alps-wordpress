@php
  $theme_color = get_alps_option('theme_color');
  $alpsVersion = \App\Core\ALPSVersions::get();

  $stylesUrl = $alpsVersion['styles']['main'];
  if ($theme_color && isset($alpsVersion['styles']['themes'][$theme_color])) {
      $stylesUrl = $alpsVersion['styles']['themes'][$theme_color];
  }
@endphp
<head>

  @php wp_head() @endphp

  @php
    $schemamarkup = get_post_meta(get_the_ID(), 'schemamarkup', true);
    if(!empty($schemamarkup)) {
      echo $schemamarkup;
    }
  @endphp

  <link rel="stylesheet" type="text/css" href="{{ $stylesUrl }}" media="all">
  <script src="{{ $alpsVersion['scripts']['head'] }}" type="text/javascript" async></script>
</head>

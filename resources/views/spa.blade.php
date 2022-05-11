@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'facebookAuth' => config('services.facebook.client_id'),
    'googleAuth' => config('services.google.client_id'),
];
$appJs = mix('dist/js/app.js');
$appCss = mix('dist/css/app.css');
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"
        content="Bine ai venit în călătoria ta experiențială!
                Urcă-te la bord și lasă-te purtat de tot ce vei experimenta.
                Aici vei regăsi diversitate de momente ca o shaorma cu de toate.
                În funcție de personalitatea ta vei afla cum muzica te poate influența și vei străluci în lumina inimii.
                Vor fi videouri săptămânale motivaționale, cu dans experiențial, cu recomandări nutriționale și cu multe altele.
                De asemenea poți citi povești de viață care să-ți dea de gândit și poți auzi unele lucruri haioase.
                Te-ai pregătit? Îndată am și pornit.
                Explorează-ți toate simțurile și pornește în călătoria ta!"
  >

  <title>{{ config('app.name') }}</title>
  <link rel="preload" href="{{ url('images/pages/home/carousel-v1/Carousel-img0_495.webp') }}" as="image">
  <link rel="stylesheet" href="{{ (str_starts_with($appCss, '//') ? 'http:' : '').$appCss }}">
</head>
<body>
  <div id="app"></div>

  <script>
    window.config = @json($config);
  </script>

  <script src="{{ (str_starts_with($appJs, '//') ? 'http:' : '').$appJs }}"></script>
</body>
</html>

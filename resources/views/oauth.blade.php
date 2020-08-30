<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head></head>
    <body>
        <h3>QRauth</h3>
        <p>{{$application_name}}</p>
        <p>{{$application_homepage_url}}</p>
        <p>{!!QrCode::backgroundColor(237, 241, 246)->size(300)->errorCorrection('H')->generate($encoded);!!}</p>
    </body>
</html>

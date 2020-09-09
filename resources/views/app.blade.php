<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ env('APP_ENV') }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>App</title>
        <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}" />
    </head>
    <body>
        @inertia
        @routes
        <script>window.Statamic = @json($statamic)</script>
        <script src="{{ mix('/js/site.js') }}"></script>
    </body>
</html>

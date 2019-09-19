<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <a href=" {{ route('patient.auth.login') }}">Patient Sign In</a>
        <a href=" {{ route('admin.auth.login') }}">Admin Sign In</a>
    </body>
</html>

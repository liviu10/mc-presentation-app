<html>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }} | {{ config('app.owner_name') }}</title>
    <!-- BOOTSTRAP V5 CSS IMPORT LINK -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- LOCAL CSS PROPERTIES -->
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
    </head>
    <body>

        <h1>Welcome to my newsletter, {{ $full_name }}!</h1>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio maxime aperiam odit assumenda. Voluptatem facere accusamus, rerum assumenda, eligendi repellat modi ut sed vel animi reiciendis quia, voluptatum hic sunt pariatur. Deleniti quam ut cumque voluptate quos adipisci, ab molestiae tempora ex quas dicta voluptatibus modi deserunt non! Eligendi esse mollitia accusamus, placeat totam et sint molestiae optio, at nemo quia repudiandae nam error voluptate quas harum fugiat, labore accusantium. Dicta magnam tenetur debitis aliquid quisquam praesentium sit aliquam neque ad, ex expedita molestiae nihil tempore ut reiciendis obcaecati porro amet nostrum. Facilis nostrum doloribus facere obcaecati voluptates amet illum ipsa totam deleniti alias ex, soluta ducimus molestias. Sint quas iste sapiente tempora voluptatum, quidem dicta eos autem soluta eius qui voluptatem ratione necessitatibus aperiam odit inventore quaerat reiciendis illum vitae quis alias fugiat nostrum. Eos nesciunt harum unde autem ipsam eaque deleniti alias. Modi autem illum quidem quo fuga?
        </p>

    <!-- BOOTSTRAP V5 BUNDLE WITH POPPER.JS IMPORT LINK -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- GOOGLE CHARTS IMPORT LINK -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
    </body>
</html>
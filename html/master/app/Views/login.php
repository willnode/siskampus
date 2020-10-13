<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= module_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="POST">
            <img class="mb-4" src="<?= static_url('logo.png') ?>" alt="" width="72">
            <h1 class="h3 mb-3 font-weight-normal">Mohon masuk</h1>
            <input type="text" name="username" class="form-control" placeholder="ID" required autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?= $site->long_name ?></p>
        </form>
    </main>



</body>

</html>
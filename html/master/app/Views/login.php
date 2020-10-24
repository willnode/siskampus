<!--__________________      ____________________
   /  __/___/ \ |  |  \    /  |      \   /   __/
  /  /__/___\  \|  |   \  /   |  __  |  |   /__
 /_______   /  __  |    \/    |  |/  /  |__   /
     /  /  /  / |  |  \    /  |  |  /|  |/   /
 ___/  /  /  /__|  |  |\  /|  |  |_/_|  |   /
/_____/__/__/   |__|__| \/ |__|__|______|__/
https://github.com/willnode/siskampus/-->

<!doctype html>
<html lang="id">

<head>
    <?= view('head') ?>
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
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?> <?= \Config\Services::site()->shared->long_name ?></p>
        </form>
    </main>

</body>

</html>
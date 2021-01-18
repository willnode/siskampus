<!DOCTYPE html>
<html lang="en">
<?= view('head') ?>

<body class="text-center" style="background: url(https://web.unwaha.ac.id/wp-content/uploads/2020/09/IMG_20190624_105818.jpg) center/cover #007711; position: relative">
    <style>
        form {
            border-radius: 10px;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-sizing: content-box;
            width: calc(100% - 30px) !important;
            border: 2px solid whitesmoke;
            background: #0003;
        }

        form a {
            font-weight: bold;
            color: var(--light);
        }

        .signin-group>button {
            width: 100%;
            margin-bottom: .5em;
            background: white;
        }


        .text-shadow {
            text-shadow: 0px 0px 2px black;
        }

        .floating {
            position: absolute;
            left: 10px;
            bottom: 10px;
        }

        .floating a {
            color: #fff6;
            transition: color 0.2s;
        }

        .floating a:hover {
            color: white;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            opacity: .8;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid white;
        }

        .separator::before {
            margin-right: .5em;
        }

        .separator::after {
            margin-left: .5em;
        }
    </style>
    <div class="justify-content-center container d-flex flex-column" style="min-height: 100vh; max-width: 476px">
        <p><a href="/"><img src="<?= static_url('logo.png') ?>" alt="Logo" width="150px"></a></p>
        <form method="POST" name="loginForm" class="container shadow d-flex flex-column justify-content-center pb-1 pt-3 text-white">
            <?= csrf_field() ?>
            <h1 class="mb-4">Daftar Akun</h1>
            <?php if ($message) : ?>
				<div class="alert alert-danger">
					<?= $message ?>
				</div>
			<?php endif ?>
            <input type="text" name="username" placeholder="NIM" class="form-control mb-2" required>
            <input type="password" name="password" autocomplete="new-password" placeholder="Password Baru" class="form-control mb-2" required minlength="8">
            <p>Registrasi ini hanya diperlukan untuk mahasiswa yang belum pernah mengakses sistem yang baru sebelumnya</p>
            <input type="submit" value="Daftar" class="btn-primary btn btn-block mb-3">
            <div class="separator mb-3">Atau</div>
            <a href="/login" class="btn d-flex align-items-center btn-light border-secondary mb-2">
                <span class="mx-auto">Masuk</span>
            </a>
        </form>
    </div>
</body>

</html>
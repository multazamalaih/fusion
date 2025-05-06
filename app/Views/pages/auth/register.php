<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Fusion</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url() ?>/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Alata', sans-serif;
            background: #f8f9fc url('img/bg-login.png') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-box h2 {
            margin-bottom: 30px;
            font-weight: 600;
            color: #000;
        }

        .register-box input {
            width: 92%;
            margin: 0 auto 15px auto;
            display: block;
            padding: 12px 16px;
            margin-bottom: 15px;
            border: 1px solid #43b600;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
        }

        .register-box button {
            font-family: 'Alata';
            background-color: #43b600;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-box button:hover {
            background-color: #3ba200;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #000;
        }

        .login-link a {
            color: #ff4800;
            text-decoration: none;
            font-weight: bold;
        }

        .is-invalid {
            border: 1px solid red !important;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2>Register</h2>
        <?php if (session()->getFlashdata('error')) : ?>
            <div style="background-color: #d4edda; color:rgb(194, 21, 21); padding: 12px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #c3e6cb;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form action="/register" method="post">
            <?= csrf_field() ?>
            <div>
                <input type="username" name="nama" placeholder="Nama" required value="<?= old("username") ?>" class="<?= validation_show_error('username') ? 'is-invalid' : "" ?>">
                <?php if (validation_show_error("username")) : ?>
                    <div style="color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                        <?= validation_show_error('username') ?>
                    </div>
                <?php endif; ?>

            </div>
            <div>
                <input type="email" name="email" placeholder="Email" required value="<?= old("email") ?>" class="<?= validation_show_error('email') ? 'is-invalid' : "" ?>">
                <?php if (validation_show_error("email")) : ?>
                    <div style="color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                        <?= validation_show_error('email') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Password" required class="<?= validation_show_error('password') ? 'is-invalid' : "" ?>">

            </div>
            <?php if (validation_show_error("password")) : ?>
                <div style="color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                    <?= validation_show_error('password') ?>
                </div>
            <?php endif; ?>

            <div class="password-wrapper">
                <input type="password" id="konfirmasi" name="konfirmasi" placeholder="Ulangi Password" required class="<?= validation_show_error('konfirmasi') ? 'is-invalid' : "" ?>">
            </div>
            <?php if (validation_show_error("konfirmasi")) : ?>
                <div style="color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                    <?= validation_show_error('konfirmasi') ?>
                </div>
            <?php endif; ?>


            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Sudah punya akun ? <a href="/login"> Login <strong> disini</strong></a>
        </div>
    </div>

</body>

</html>
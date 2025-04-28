<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fusion</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url() ?>/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Alata', sans-serif;
            background: #f8f9fc url('img/bg-login.png') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 40px 24px;
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            font-weight: 600;
        }

        .login-box input {
            width: 92%;
            margin: 0 auto 15px auto;
            display: block;
            padding: 12px 16px;
            margin-bottom: 15px;
            border: 1px solid #43b600;
            border-radius: 10px;
            outline: none;
        }

        .login-box button {
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

        .login-box button:hover {
            background-color: #3ba200;
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
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

    <div class="login-box">
        <h2>Login</h2>
        <?php if (session()->getFlashdata('success')) : ?>
            <div style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #c3e6cb;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div style="background-color: #d4edda; color:rgb(194, 21, 21); padding: 12px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #c3e6cb;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form action="/login" method="post">
            <div>
                <input type="email" placeholder="Email" name="email" required class="<?= session()->getFlashdata("errorEmail") ? "is-invalid" : "" ?>" value="<?= old("email") ?>">
                <?php if (session()->getFlashdata("errorEmail")) : ?>
                    <div style="color: red; font-size: 12px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                        <?= session()->getFlashdata("errorEmail") ?>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" required class="<?= session()->getFlashdata("errorPassword") ? "is-invalid" : "" ?>">
                <?php if (session()->getFlashdata("errorPassword")) : ?>
                    <div style="color: red; font-size: 12px; margin-top: -10px; margin-bottom: 10px; text-align: left;">
                        <?= session()->getFlashdata("errorPassword") ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="register-link">
            Belum punya akun ? <a href="/register"> Daftar disini</a>
        </div>
    </div>

</body>

</html>
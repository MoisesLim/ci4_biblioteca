
    <style>
        .form-group {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 55%;
            right: 10px;
            cursor: pointer;
        }
    </style>
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row">
        <center><h1>Seja Bem-vindo a Biblioteca da EEEP Walter Ramos</h1><br></center>
        <div class="col-md-4 offset-md-4">
            <h2>Faça Login Para Continuar</h2>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email'); ?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                    <span class="toggle-password" onclick="togglePassword()"><i class="fa fa-eye"></i></span>
                </div><br>
                <button type="submit" class="btn btn-dark">Entrar</button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('senha');
        var toggleIcon = document.querySelector('.toggle-password i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>

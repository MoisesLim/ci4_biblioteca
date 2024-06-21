<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca EEEP Walter Ramos de Araújo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .navbar{
            height: 61.5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .header {
            background-color: #004080;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .welcome-message {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .welcome-message h1 {
            color: #004080;
        }
        .button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #003366;
        }
        .login-form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: auto;
        }
        .user-profile {
            display: flex;
            align-items: center;
        }
        .user-profile img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        
.mini-card {
    display: none;
    position: absolute;
    top: 70px;
    right: 10px;
    width: 200px;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
    </style>
</head>
<body>

    <header class="header">
        <h1>Biblioteca EEEP Walter Ramos de Araújo</h1>
    </header>

    <div class="container">
        <div class="welcome-message">
            <h1>Bem-vindo!</h1>
            <p>Seja bem-vindo à biblioteca da EEEP Walter Ramos de Araújo. Aqui, promovemos o conhecimento, a leitura e a pesquisa. Nossa biblioteca oferece uma vasta coleção de livros, revistas, jornais e acesso a materiais digitais para enriquecer o aprendizado de nossos alunos.</p>
            <p>Estamos comprometidos em criar um ambiente acolhedor e inspirador para todos os estudantes. Sinta-se à vontade para explorar nossos recursos e participar de nossos eventos e atividades.</p>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script para lidar com a formatação de telefone
        function formatTelefone(telefone) {
            telefone = telefone.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
            telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2"); // Coloca parênteses ao redor dos dois primeiros dígitos e espaço depois
            telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2"); // Coloca um hífen entre o quinto e o sexto dígitos
            return telefone;
        }

        document.getElementById('telefone').addEventListener('input', function (e) {
            e.target.value = formatTelefone(e.target.value);
        });

        // Script para lidar com o logout
        document.getElementById('logout').addEventListener('click', function() {
            // Aqui você pode adicionar o código para encerrar a sessão
            alert('Sessão encerrada');
            // Redirecionar para a página de login ou início
            window.location.href = 'login.html';
        });
    });
    function toggleCard() {
    const miniCard = document.getElementById('miniCard');
    if (miniCard.style.display === 'block') {
        miniCard.style.display = 'none';
    } else {
        miniCard.style.display = 'block';
    }
}


    </script>
</body>
</html>

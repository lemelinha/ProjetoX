<?php
    if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
        header('Location: /');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->pageTitle ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body id='login'>
    <form>
        <h1 onclick="window.location.href='/'" style="cursor: pointer">Study IQ</h1>
        <p>Inicie sua sessão</p>
        <input type="text" name="identifier" placeholder="Usuário ou Email" required>
        <input type="password" name="password" placeholder="Senha" required>
        <input type="submit" value="Entrar">
        <p id='retorno' style='height: 16px'></p>
        <p>Não tem conta? <a href="/register" id="register">Registre-se</a></p>
    </form>
    <script>
        $('form').on('submit', function(e) {
            e.preventDefault()

            var retorno = $(this).find('#retorno')

            $.ajax({
                url: '/login/auth',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize()
            })
            .done(function (data) {
                if (!data.auth) {
                    retorno.text('Usuário ou senha errados')
                    return
                }
                window.location.href = '/'
            })
            .fail(function () {
                retorno.text('OPS! Erro interno do servidor')
            })
        })
    </script>
</body>
</html>
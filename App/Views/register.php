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
        <p>Registre-se</p>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="user" placeholder="Usuário" required maxlength="50">
        <input type="password" id='pass' name="password" placeholder="Senha" required>
        <input type="password" id='confirmPass' placeholder="Confirme sua senha" required>
        <input type="submit" value="Registrar">
        <p id='retorno' style='height: 16px'></p>
        <p>Já tem uma conta? <a href="/login" id="register">Entrar</a></p>
    </form>
    <script>
        $('form').on('submit', function(e) {
            e.preventDefault()

            var retorno = $(this).find('#retorno')
            var pass = $(this).find('#pass')
            var confirmPass = $(this).find('#confirmPass')

            if (pass.val() != confirmPass.val()){
                pass.css('border', '1px solid #f00')
                confirmPass.css('border', '1px solid #f00')
                retorno.text('As senhas nao coincidem');
                return
            }
            pass.css('border', 'none')
            confirmPass.css('border', 'none')
            retorno.text('')

            $.ajax({
                url: '/register/register',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize()
            })
            .done(function (data) {
                if (data?.error) {
                    retorno.text(data.error)
                    return
                }
                if (data?.register && data.register) {
                    window.location.href = '/'
                }
            })
            .fail(function(a, b, c) {
                retorno.text('OPS! Erro interno do servidor')
            })
        })
    </script>
</body>
</html>
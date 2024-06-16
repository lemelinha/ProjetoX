<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->pageTitle ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body id='layout'>
    <header>
        <h1>Study IQ</h1>
        <?php
            if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])){ ?> 
                <div style='display: flex; align-items: center; column-gap: 10px'>
                    <h2>Bem-vindo <?= $_SESSION['logged']['user'] ?></h2>
                    <a class="btn" href="/logout">Sair</a>
                </div>
        <?php 
            } else { ?> 
                <a class="btn" href="/login">Login</a>
        <?php } ?>
    </header>
    <!--<?php $this->renderView($this->page->view, $this->page->viewDirectory); ?>-->
</body>
</html>
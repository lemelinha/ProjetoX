<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->pageTitle ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/cdd96683ff.js" crossorigin="anonymous"></script>
</head>
<body id='mainLayout'>
    <header>
        <h1>Study IQ</h1>
        <?php
            if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])){ ?> 
                <div style='display: flex; align-items: center; column-gap: 10px; flex-wrap: wrap'>
                    <h2>Bem-vindo <?= $_SESSION['logged']['user'] ?></h2>
                    <?php if ($_SESSION['logged']['user'] == $_ENV['ADMIN_USER']) { ?>
                        <a class='btn' href="/admin">Área do Admin</a>
                    <?php } ?>
                    <a class="btn" href="/logout">Sair</a>
                </div>
        <?php 
            } else { ?> 
                <a class="btn" href="/login">Login</a>
        <?php } ?>
    </header>
    <main>
        <h1>Banco de perguntas</h1>
        <a class='btn' id='add-pergunta' href="/add/pergunta"><i class="fa-solid fa-plus"></i>Adicionar Pergunta</a>
        <section>
            <form id="perguntas-filtro">
                <select name="materia">
                    <option value="" selected>Todas</option>
                    <option value="1">materia 1</option>
                    <option value="2">materia 2</option>
                </select>
                <select name="materia">
                    <option value="" selected>Todas</option>
                    <optgroup label='materia 1'>
                        <option value="1">submateria 1</option>
                        <option value="2">submateria 2</option>
                    </optgroup>
                    <optgroup label='materia 2'>
                        <option value="1">submateria 1</option>
                        <option value="2">submateria 2</option>
                    </optgroup>
                </select>
            </form>
            <section>
                
            </section>
        </section>
    </main>
    <!--<?php $this->renderView($this->page->view, $this->page->viewDirectory); ?>-->
</body>
</html>
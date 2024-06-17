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
<body id='adminLayout'>
    <header>
        <h1>Study IQ</h1>
        <h2>Área do Admin</h2>
        <nav>
            <a class='nav-btn' href="/admin/materias">Cadastrar Matéria</a>
            <a class='nav-btn' href="/admin/submaterias">Cadastrar SubMatéria</a>
            <a class='nav-btn' href="/logout">Sair</a>
        </nav>
    </header>
    <?php $this->renderView($this->page->view, $this->page->viewDirectory) ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $this->url("/assets/css/main.css") ?>">
    <?php $this->renderSection("style", $args); ?>
    <title><?php $this->renderSection("title", $args); ?></title>
</head>
<body>
    <header>
        <ul>
            <li><a href="<?php $this->url("/") ?>">Home</a></li>
            <li><a href="<?php $this->url("/formtest") ?>">formtest</a></li>
        </ul>
    </header>

    <main>
        inside layout <?php echo date('Y-m-d H:i:s'); ?> <br/>
        <?php $this->renderSection("content", $args); ?>
    </main>

    <footer></footer>
    <script src="<?php $this->url("/assets/js/main.js") ?>"></script>
    <?php $this->renderSection("script", $args); ?>
</body>
</html>
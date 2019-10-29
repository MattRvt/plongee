<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->_title ?></title>
        <?php require_once 'views/templateInfo/Head.php'; ?>
    </head>
    <body>
        <header id="header">
            <?php require_once 'views/templateInfo/Header.php'; ?>
        </header>
        <main>
            <?php echo $content ?>
            <?php require_once 'views/templateInfo/Modal.php'; ?>
        </main>
        <?php require_once 'views/templateInfo/Footer.php'; ?>
        <script type="text/javascript" src="controller/javascript/materialize.min.js"></script>
    </body>
</html>
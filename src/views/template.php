<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8" />
        <title><?php echo $this->_title ?></title>
    </head>
    <body>
        <div id="header">
            <?php require_once 'views/templateInfo/Header.php'; ?>
        </div>
        <?php echo $content ?>
        <?php require_once 'views/templateInfo/Footer.php'; ?>
    </body>
</html>
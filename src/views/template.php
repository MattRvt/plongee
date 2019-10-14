<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->_title ?></title>
        <?php require_once 'views/templateInfo/Head.php'; ?>
    </head>
    <body>
        <div id="header">
            <?php require_once 'views/templateInfo/Header.php'; ?>
        </div>
        <?php echo $content ?>
        <?php require_once 'views/templateInfo/Footer.php'; ?>
        <?php require_once 'views/templateInfo/Modal.php'; ?>
    </body>
</html>
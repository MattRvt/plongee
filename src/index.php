<html>
    <head>

    </head>
    <body>
        <?php
            include_once 'settings.php';
            include_once('BDD/DbConnector.php');

            $dbreader = new DbConnector();
            $pdo = $dbreader->getConnection();
            $statement = $dbreader->prepStatement($pdo,"select * from plo_aptitude");
            $res = $dbreader->execStatement($statement);
            print_r($res);
        ?>
    </body>
</html>
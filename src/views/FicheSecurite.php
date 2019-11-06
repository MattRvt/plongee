<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plongee</title>
    <script type="text/javascript">
        function f(){
            window.print();
            //setTimeout("closePrintView()", 500);
        }

        function closePrintView() {
            document.location.href = 'ListePlongee';
        }
    </script>
    <?php
        require_once('model/modelPlongee.php');
        $reader = new modelPlongee();
        var_dump($_GET);
        $req = $reader->getMatch($_GET['date'], $_GET['moment']);
        var_dump($req);
        ?>
</head>
<body onload="f();">
<input type="text" value="nonon"/>
</body>
</html>
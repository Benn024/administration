<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <table>
            <form method='POST'>
                <br />
                <br />
                <input type="text" placeholder="Sök klass" name="searchkls">
                <input type="submit" value="SÖK" name="knapp">
                <br />
            </form>     
            <br />
        </table>
        
        
        
        
        <?php
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_NAME", "berzanapp");
        define("DB_PASSWORD", "");

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

        if(isset($_POST["knapp"])){
            $form1 = $_POST["searchkls"];
//            var_dump($form1);
        }

        $sql = "SELECT * FROM users WHERE klass='$form1'";
//        echo $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $klslist = $stmt->fetchAll();
        echo "<table class='bord' border='1'>";
        foreach ($klslist as $person) {
          
                        echo "<tr>";
                        echo "<td>";
                        echo $person["fornamn"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["efternamn"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["anvnamn"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["losenord"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["iv"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["mail"];
                        echo "</td>";
                        echo "<td>";
                        echo $person["klass"];
                        echo "</td>";
                        echo "</tr>";
                        echo "</form>";
        }
        ?>
    </body>
</html>

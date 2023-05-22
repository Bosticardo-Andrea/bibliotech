<?php
session_start();
require("./testata.php");
?>
<link rel="stylesheet" type="text/css" href="./style/stilLibro.css">

<body>
</br></br>
    <div class="container">
        <?php
        $stmt = $conn->prepare("SELECT libri.*, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie, AVG(commenti.Valutazione) AS ValutazioneMedia
        FROM libri
        LEFT JOIN categorielibri ON libri.Id = categorielibri.IdLibro
        LEFT JOIN categorie ON categorie.Id = categorielibri.IdCat
        LEFT JOIN commenti ON libri.Id = commenti.IdL
        WHERE libri.Id = ?
        GROUP BY libri.Id;"
        );
        $stmt->bind_param("s",$_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();
        $stmt = $conn->prepare("SELECT utenti.Id
        FROM utenti
        JOIN storico ON utenti.Id = storico.IdU
        WHERE storico.IdL = ?
        AND storico.DataRestituzione IS NULL"
        );
        $stmt->bind_param("s",$_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $utenti = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($_SESSION['login'])) {
            if($rows['Stato'] == "0"){
                echo "<a href= ./API/prenota.php?id=".$_GET['id']."><button type=submit'>PRENOTA</button></a>";
            }else{
                echo '<button type="submit" disabled="disabled" style="background-color: #cccc; color: #000; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer;">PRENOTA</button>';
            }
            foreach ($utenti as $item){
                if($_SESSION['id'] == $item['Id']){
                echo "<a href= ./API/restituisci.php?id=".$_GET['id']."><button type=submit>Restitutisci</button></a>";
                break;
            }
        }
    }
        print_r("<img src=./img/" . $_GET['id'] . ".jpg alt=Descrizione della foto style='width: 760px; height: 400px;>");
        echo "<img src=./img/" . $_GET['id'] . ".jpg alt=Descrizione della foto style='width: 760px; height: 400px;>";
        echo "<p>NPagine: " . $rows["NPagine"] . "</p>";
        echo "<p>ISBN: " . $rows["ISBN"] . "</p>";
        echo "<p>ISBN: " . $rows["Autore"] . "</p>";
        echo "<p>Condizioni:" . $rows["Condizioni"] . "</p>";
        echo "<p>categorie:" . $rows["categorie"] . "</p>";
        echo "<p>Valutazione Media: " . round($rows["ValutazioneMedia"], 1) . "</p>";
        if($rows['Stato'] == "0"){
            echo("<p>Stato: Libero </p>");
          }else{
            echo("<p>Stato: Preso</p>");
          }
        $stmt = $conn->prepare("SELECT Nome,Cognome,Commento,Valutazione
                                FROM utenti,libri,commenti
                                WHERE libri.Id = " . $_GET["id"] . "
                                AND libri.Id = commenti.IdL
                                AND commenti.IdU= utenti.Id");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($result->num_rows > 0) {
            foreach ($rows as $row) {

                echo "<div class='comment'><p>Commento scritto da <b>" . $row["Nome"] . " ".$row["Cognome"].":</b></p>";
                echo "<p><i>- " . $row["Commento"] . "</i></p>";
                echo "<div class='rating'><p class='label' style=color:black;>Valutazione:" . round($row["Valutazione"], 1) . "</p>";
                $valutazione = $row["Valutazione"];
                $intero = floor($valutazione);
                $decimale = $valutazione - $intero;
                for ($i = 0; $i < $intero; $i++) {
                    echo '<span>&#9733;</span>';
                }

                if ($decimale >= 0.5) {
                    echo '<span>&#9733;</span>';
                    $i++;
                } else if ($decimale > 0) {
                    echo '<span>&#9735;</span>';
                    $i++;
                }

                for ($i; $i < 5; $i++) {
                    echo '<span>&#9734;</span>';
                }
                echo "</div></div>";
            }
        } else {
            echo "<p>Non ci sono ancora commenti per questo evento</p>";
        }
        $id = $_GET['id'];
        if (isset($_SESSION['login'])) {
            echo '<form action="../php/registra_commento.php"
             method="post">
                    <div>
                <label for="Commento">Commento:</label>
                <textarea id="Commento" name="Commento" required></textarea>
            </div>
            <div>
                <label for="Valutazione">Valutazione:</label>
                <select id="Valutazione" name="Valutazione" required>
                    <option value="5">Scegli una valutazione</option>
                    <option value="1">&#9733;</option>
                    <option value="2">&#9733;&#9733;</option>
                    <option value="3">&#9733;&#9733;&#9733;</option>
                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                </select>
            </div>
            <input type="hidden" name="id" value=' . $id . ' >
            <div class="btn">
                <input class="btn-submit" type="submit" value="INVIA" />
            </div>
            </form>';
        }
        

echo"</div>
</br></br></br></br></br></br></br></br></br>";
?>

</body>
<?php
require("./footer.php");
?>
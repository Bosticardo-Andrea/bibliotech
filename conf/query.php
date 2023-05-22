<?php
function CreaGrigliaIndex($conn,$bookN,$author)
{
    if (($bookN == null) && ($author == null)){
        $stmt = $conn->prepare("SELECT libri.*, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie
                                FROM libri
                                JOIN categorielibri ON libri.Id = categorielibri.IdLibro
                                JOIN categorie ON categorie.Id = categorielibri.IdCat
                                GROUP BY libri.Id");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return array($rows, $result);
    }elseif($author == null){
        $initial = strtoupper(substr($bookN, 0, 1)); // Prende solo l'iniziale e la converte in maiuscolo
        $stmt = $conn->prepare("SELECT libri.*, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie
        FROM libri
        JOIN categorielibri ON libri.Id = categorielibri.IdLibro
        JOIN categorie ON categorie.Id = categorielibri.IdCat
        WHERE (libri.Titolo IS NULL AND libri.Autore LIKE CONCAT(?, '%'))
        OR (libri.Titolo LIKE CONCAT(?, '%'))
        OR (libri.Autore IS NULL AND libri.Titolo LIKE CONCAT(?, '%'))
        OR (libri.Autore LIKE CONCAT(?, '%'))

        GROUP BY libri.Id");
        $stmt->bind_param("ssss", $initial,$initial,$initial,$initial);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return array($rows, $result);
    }else{
        $stmt = $conn->prepare("SELECT libri.*, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie
                                    FROM libri
                                    JOIN categorielibri ON libri.Id = categorielibri.IdLibro
                                    JOIN categorie ON categorie.Id = categorielibri.IdCat
                                    WHERE libri.Autore LIKE CONCAT('%', ?, '%')
                                    AND libri.Titolo  LIKE CONCAT('%', ?, '%')
                                    GROUP BY libri.Id");
        $stmt->bind_param("ss", $bookN,$author);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return array($rows, $result);

    }
}
function loginCheck($conn, $psw, $email)
{
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE Email = ? AND Psw = ?");
    $stmt->bind_param("ss", $email, $psw);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
    return $row;
}
function Delete($conn)
{
    $stmt = $conn->prepare("DELETE FROM Libri WHERE id = ?");
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $conn->close();
}

function stampaStorico($conn)
{
    $stmt = $conn->prepare("SELECT libri.Id,libri.ISBN, libri.Titolo, utenti.Nome, utenti.Cognome, storico.DataPreso, storico.DataRestituzione
    FROM libri
    LEFT JOIN storico ON libri.id = storico.IdL
    LEFT JOIN utenti ON utenti.id = storico.IdU
    WHERE storico.IdL IS NOT NULL
    GROUP BY libri.Id, libri.Titolo, utenti.Nome, utenti.Cognome, storico.DataPreso, storico.DataRestituzione");

    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return array($rows, $result);
}

function libri($conn)
{
    $stmt = $conn->prepare("SELECT libri.*,posizioni.Nome as nome_pos, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie, COUNT(commenti.Id) AS num_commenti, AVG(commenti.Valutazione) as media_comm
    FROM libri
    JOIN categorielibri ON libri.Id = categorielibri.IdLibro
    JOIN categorie ON categorie.Id = categorielibri.IdCat
    JOIN posizioni ON posizioni.Id = libri.idPosizione
    LEFT JOIN commenti ON libri.Id = commenti.IdL
    GROUP BY libri.Id");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return array($rows, $result);
}
function ricercaLibro($conn,$id){
    $stmt = $conn->prepare("SELECT libri.*,posizioni.Nome as nome_pos, GROUP_CONCAT(categorie.Nome SEPARATOR ', ') AS categorie, COUNT(commenti.Id) AS num_commenti, AVG(commenti.Valutazione) as media_comm
    FROM libri
    JOIN categorielibri ON libri.Id = categorielibri.IdLibro
    JOIN categorie ON categorie.Id = categorielibri.IdCat
    JOIN posizioni ON posizioni.Id = libri.idPosizione
    LEFT JOIN commenti ON libri.Id = commenti.IdL
    GROUP BY libri.Id");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return array($rows, $result);
}
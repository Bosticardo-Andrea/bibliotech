<?php
session_start();
require("./testata.php");
?>
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .label {
        font-weight: bold;
    }

    .comment {
        margin-top: 20px;
        padding: 10px;
        border-radius: 5px;
        background-color: #f0f0f0;
    }

    .comment p {
        margin: 0;
    }

    .rating {
        margin-top: 20px;
        font-size: 24px;
    }

    .rating span {
        color: gold;
    }

    .rating span:hover,
    .rating span:hover~span {
        color: orange;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }

    textarea {
        height: 100px;
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }

    select {
        height: 40px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    option {
        color: #333;
    }

    button {
        background-color: #008CBA;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover {
        background-color: #006B87;
    }

    .btn {
        /* center all elements */
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .btn-submit {
        background-color: rgb(0, 115, 255);
        color: white;
        border-radius: 5px;
        width: 130px;
        height: 50px;
        transition: background-color 0.2s ease-in-out;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .btn-submit:hover {
        background-color: rgb(0, 90, 200);
    }
</style>

<body>
    <div class="container">
        <?php
        $stmt = $conn->prepare("SELECT libri.Id, libri.Titolo, libri.Condizioni, libri.NPagine, libri.ISBN, GROUP_CONCAT(Categorie.Nome SEPARATOR ', ') AS Categorie, AVG(commenti.Valutazione) AS ValutazioneMedia
        FROM libri
        JOIN categorielibri ON libri.Id = categorielibri.IdLibro
        JOIN categorie ON categorie.Id = categorielibri.IdCat
        LEFT JOIN commenti ON libri.Id = commenti.IdL
        WHERE stato = 0
        AND libri.id = 2
        GROUP BY libri.Id");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();
        echo "<h1>" . $rows["Titolo"] . "</h1>";
        echo "<img src=../img/" . $_GET['id'] . ".jpg alt=Descrizione della foto style='width: 760px; height: 400px;>";
        echo "<p>NPagine: " . $rows["NPagine"] . "</p>";
        echo "<p>ISBN: " . $rows["ISBN"] . "</p>";
        echo "<p>Condizioni:" . $rows["Condizioni"] . "</p>";
        echo "<p>Categorie:" . $rows["Categorie"] . "</p>";
        echo "<p>Valutazione Media: " . round($rows["ValutazioneMedia"], 1) . "</p>";
        echo "<p>Categoria:" . $rows['Categorie'] . "</p>";
        ?>
    </div>

    </br></br></br></br></br></br></br></br></br>

</body>
<?php
require("./footer.php");
?>
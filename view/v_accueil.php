<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(".chiffres").keyup(function(event) {
            var value = jQuery(this).val();
            value = value.replace(/[^0-9]+/g, '');
            jQuery(this).val(value);
        });
    });
</script>




<form method="post">
    <h1 class='titre'> Commande Chèque Déjeuner </h1>

    <?php

    if ($message) echo "<h2>" . $message . "</h2>"; ?>

    <table border="0">
        <tr>
            <td align=right class='text'>Nom :</td>
            <td align=left><input class='select' type="text" name="nom" id="nom" size="12" style="width:130px; height:25px;" value="" required></td>
        </tr>
        <tr>
            <td align=right class='text'>Prénom :</td>
            <td align=left><input class='select' type="text" name="prenom" id="prenom" size="12" style="width:130px; height:25px;" required value=""></td>
        </tr>
        <tr>
            <td align=right class='text'>Numéro Agent :</td>
            <td align=left><input class='select' type="text" name="numeroAgent" id="numeroAgent" size="12" style="width:130px; height:25px;" required value=""></td>
        </tr>
        <tr>
            <td align=right class='text'>Pour le mois de :</td>
            <td align=left><select class='selectMenu' name="mois" id="mois" size="1" style="width:135x; height: 30px;" required>
                    <?php
                    for ($i = 0; $i < count($result); $i++) {

                        $selected = "";
                        $r = explode("/", $result[$i]);

                        if ($result[$i] == date("n/Y"))  $selected = "selected='selected'";

                        echo "<option $selected value='" . $result[$i] . "'>" . $calendrier[$r[0]] . "/" . $r[1] . "</option>";
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td align=right class='text'>Nombre de chèques souhaités :</td>
            <td align=left><input class='select' type="text" class="chiffres" name="nombreCheque" id="nombreCheque" format="NN" size="12" style="width:22px; height:25px;" required maxlength="2">

            </td>
        </tr>
        <tr>
            <td align=right class='text'>Type (chèques ou carte) :
                <input type="radio" required id="type" name="type" value="0"></br></br></br></br></br>
                <input type="radio" id="type2" name="type" value="1">
            </td>
            <td align=left></br>
                <div>

                    <label for="type"><img src="ressources/img/chequier.webp" style="width:100px; height:100px;" alt="" /></label>
                </div>

                <div>

                    <label for="type2"><img src="ressources/img/cb.jpg" style="width:80px; height:50px;" alt="" /></label>
                </div>
</form>
</td>
</tr>
<tr>
    <td colspan="2" align=center>
    <br>
        <input type="submit" class="select" value="Valider ma commande" formaction="?action=validationCommande">
    </td>
</tr>
</table>
<br><br><br>

<?php

if (($results3[0]['netusername'] == "FLEBO331") || ($results3[0]['netusername'] == "DALAB331")) {
?>
    <br><br>
    <input align=center type="button" class="select" value="Admin" style="width:80px; height:30px" name="bouton" onclick='document.location.href="?action=admin";'>
    <br><br>
<?php
}
?>

<br>
<h1 class='titre'> Vos commandes </h1>
<br>

<table width="70%" class="tablecpog-design">
    <tbody>
        <th>Date de la commande</th>
        <th>Pour le mois de</th>
        <th>Nombre</th>
        <th>Type</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Numéro agent</th>
    </tbody>
    <?php
    $jour = date("Y-m-d");
    foreach ($results2  as $row) //Boucle qui effectue le nbr de ligne pour la creation du tableau 
    {
        $jourCommande = Outils::dateFR1($row['dateCommande']);
        if ($row['type'] == '0') $type1 = "'ressources/img/chequier.webp'  width='70' height='70'";
        if ($row['type'] == '1') $type1 = "'ressources/img/cb.jpg'  width='50' height='30'";
    ?>
        <tr>
            <td><?php echo $jourCommande; ?></td>
            <td><?php echo $row['dateEnr']; ?></td>
            <td><?php echo $row['nombreCheque']; ?></td>
            <td><?php echo "<img src= $type1"; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['numeroAgent']; ?></td>
        </tr>

    <?php } ?>
</table>
</br></br></br></br>
<script>
    function suppr(id) {

        if (confirm("Voulez vous vraiment supprimer cette commande ?")) {
            alert('Supression effectuer');
            location.href = "?action=supprimer&id=" + id;
        }
    }
</script>

<script>
    function modif(id,nom,prenom,numero) {
      
       location.href = "?action=admin&modifier=1&id=" + id +"&nom=" + nom + "&prenom=" + prenom + "&numeroAgent=" + numero;

    }
</script>


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

<?php
if ($_GET['nom']=="") $n = $_REQUEST['nom'];
else if ($_GET['nom']==$_REQUEST['nom']) $n = $_GET['nom'];
if ($_GET['prenom']=="") $p = $_REQUEST['prenom'];
else if ($_GET['prenom']==$_REQUEST['prenom']) $p = $_GET['prenom'];
if ($_GET['numeroAgent']=="") $a = $_REQUEST['numeroAgent'];
else if ($_GET['numeroAgent']==$_REQUEST['numeroAgent']) $a = $_GET['numeroAgent'];
?>

<Table border='0'>
    <tr>
        <td>
            <form method="post">

                <h1 class='titre'> Gestion des commandes </h1>
                <table border='0'>
                    <tr>
                        <td align=right class="text">Nom :</td>
                        <td align=left><input class="select" type="text" name="nom" id="nom" value="<?php echo $n ?>"></td>
                    </tr>
                    <tr>
                        <td class="text" align=right>Prénom :</td>
                        <td align=left><input class="select" type="text" name="prenom" id="prenom" value="<?php echo $p ?>"></td>
                    </tr>
                    <tr>
                        <td class="text" align=right>Numéro Agent :</td>
                        <td align=left><input class="select" type="input" name="numeroAgent" id="numeroAgent" value="<?php echo $a ?>"></td>
                    </tr>
    </tr>
    <tr>
        <td class="text" align=right>Trier par :</td>
        <td align=left><select class="select" name="trier" id="trier" value="" size="1" style="width:300px; height: 35px;">
                <option value="">
                <option value="ORDER BY dateCommande DESC">Date de commande de la plus récente
                <option value="ORDER BY dateCommande ASC">Date de commande de la moins récente
                <option value="ORDER BY dateEnr DESC"> Date du mois du plus récent
                <option value="ORDER BY dateEnr ASC"> Date du mois du moins récent
                <option value="ORDER BY nombreCheque ASC"> Par nombre de chèque du plus petit
                <option value="ORDER BY nombreCheque DESC"> Par nombre de chèque du plus grand
                <option value="ORDER BY type"> Par type
                <option value="ORDER BY nom"> Par nom de A-Z
                <option value="ORDER BY prenom"> Par prénom de A-Z
                <option value="ORDER BY numeroAgent"> Par numéro d'agent
            </select></td>
    </tr>
    <tr>
        <td class="text" align=right>Type (chèques ou carte) :


        </td>
        <td>

            <input type="radio" id="type" name="type" value="0">
            <label for="type"><img src="ressources/img/chequier.webp" width="90" height="70" style="vertical-align:middle" title="truc" />
            </label>

            <BR>

            <input type="radio" id="type2" name="type" value="1">
            <label for="type2"><img src="ressources/img/cb.jpg" width="80" height="50" style="vertical-align:middle" title="truc" />
            </label>


        </td>
    </tr>
    <tr>
        <td  align=center>
            <br>     
            <input type="submit" class="select" style="width:80px; height:30px;" value="Vider" formaction="?action=reset">
        </td>
        <td align=left>
        <br>  
        <input type="submit" class="select" style="width:80px; height:30px;" value="Filtrer" formaction="?action=admin">
        </td>
    </tr>

</table>

</form>



</br></br>





<input type="button" value="Retour" class="select" style="width:80px; height:30px" name="bouton" onclick='document.location.href="?action=accueil";'>
</br></br>
</br>

<h2 class='titre'> Toutes les commandes : <?php echo count($results) ?></h2>


<table width="70%" cellpadding="10px" class="tablecpog-design">
    <tbody>
        <th>Date de la commande</th>
        <th>Pour le mois de</th>
        <th>Nombre</th>
        <th>Type</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Numéro agent</th>
        <th>Modification</th>
        <th>Supprimer</th>
    </tbody>
    <?php
    $jour = date("Y-m-d");
    foreach ($results  as $row) //Boucle qui effectue le nbr de ligne pour la creation du tableau 
    {
        $jourCommande = Outils::dateFR1($row['dateCommande']);
        if ($row['type'] == '0') $type1 = "'ressources/img/chequier.webp'  width='70' height='70'";
        if ($row['type'] == '1') $type1 = "'ressources/img/cb.jpg'  width='50' height='30'";
        $url=$row['id'].",\"".$row['nom']."\",\"".$row['prenom']."\",\"".$row['numeroAgent']."\"";
        
    ?>
        <tr>
            <td><?php echo $jourCommande; ?></td>
            <td><?php echo $row['dateEnr']; ?></td>
            <td><?php echo $row['nombreCheque']; ?></td>
            <td><?php echo "<img src= $type1"; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['numeroAgent']; ?></td>
            <?php echo " <td style='width:40px; height:40px;' align=center bgcolor=grey > <img src='ressources/img/modif.png' width='25' height='25' onclick='modif(".$url.")'></td>
            <td style='width:40px; height:40px;' align=center bgcolor=grey > <img src='ressources/img/30070.png' width='25' height='25' onclick='suppr(" . $row['id'] . ")'></td>"; ?>
        </tr>
    <?php } ?>
</table>

</br>
<h3>Export CSV</h3>
<a href="export/file.csv"><img src='ressources/img/logoCsv.png' height="50" width="50"></a>

<td valign="top">

    <?php // echo "?action=admin&modifier=1&id=" . $id . "&nom=" . $_REQUEST['nom'] ?>



    <?php
    if ($_REQUEST['modifier']) {
        include('view/v_detail.php');
    }
    ?>

</td>

</table>
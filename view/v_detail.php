  <h2 class='titre'> Modification de la commande <?php echo $_REQUEST['id'] ?> </h2>

  <?php
    //$monUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //echo $_REQUEST['id'];
    $ty = $results3[0]['type'];
    ?>

  <form method="post" action="?action=admin&save=1">
      <table border="0" cellspacing="20" >
          <tr>
              <td align=right class="text">Nom :</td>
              <td align=left><input class="select" type="text" name="nom" id="nom" size="12" style="width:130px; height:25px;" value="<?php echo $results3[0]['nom'] ?>" required></td>
          </tr>
          <tr>
              <td align=right class="text">Prénom :</td>
              <td align=left><input class="select" type="text" name="prenom" id="prenom" size="12" style="width:130px; height:25px;" value="<?php echo $results3[0]['prenom'] ?>"></td>
          </tr>
          <tr>
              <td align=right class="text">Numéro Agent :</td>
              <td align=left><input class="select" type="text" name="numeroAgent" id="numeroAgent" size="12" style="width:130px; height:25px;" value="<?php echo $results3[0]['numeroAgent'] ?>"></td>
          </tr>
          <tr>
              <td align=right class="text">Pour le mois de :</td>
              <td align=left><select class="select" name="mois" id="mois" size="1" style="width:130px; height: 30px;" required>
                      <?php
                        for ($i = 0; $i < count($result5); $i++) {

                            $selected = "";
                            $r = explode("/", $result5[$i]);

                            if ($result5[$i] == $results3[0]['dateEnr'])  $selected = "selected='selected'";

                            echo "<option $selected value='" . $result5[$i] . "'>" . $calendrier[$r[0]] . "/" . $r[1] . "</option>";
                        }
                        ?>
                  </select></td>
          </tr>
          <tr>
              <td align=right class="text">Nombre de chèques souhaités :</td>
              <td align=left><input class="select" type="text" class="chiffres" name="nombreCheque" id="nombreCheque" format="NN" size="12" style="width:22px; height:25px;" value="<?php echo $results3[0]['nombreCheque'] ?>" required maxlength="2">

              </td>
          </tr>
          <tr>
              <td align=right class="text">Type (chèques ou carte) :


              </td>
              <td>

                  <input type="radio" id="type3" name="type12" value="0" <?php if ($ty == 0) echo "checked" ?>>
                  <label for="type3"><img src="ressources/img/chequier.webp" width="90" height="70" style="vertical-align:middle" title="truc" />
                  </label>

                  <BR>

                  <input type="radio" id="type4" name="type12" value="1" <?php if ($ty == 1) echo "checked" ?>>
                  <label for="type4"><img src="ressources/img/cb.jpg" width="90" height="70" style="vertical-align:middle" title="truc" />
                  </label>


              </td>
          </tr>
      </table>
      <input align=left type="submit" class="select" style="width:170px; height:50px;" value="Valider la modification" formaction="?action=validationModif&id=<?php echo $_REQUEST['id'] ?>">
  </form>
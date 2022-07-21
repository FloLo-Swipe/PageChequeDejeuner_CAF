<?php

// --------------------  Mes includes 
include "conf/conf.php";
include "ressources/outils/outils.php";



// --------------------  Header 
include "view/v_header.php";

// --------------------  Appel Classe PDO
include "model/m_pdo.php";
$pdo = MyPdo::getPdo(); 

// --------------------  Appel Controlleur
include "controller/c_controlleur.php";

// --------------------  Footer
include "view/v_footer.php";

<?php
  session_start();
  require_once "lib/connect.php";
  require_once "lib/utils.php";

  ob_start();
  
  $db = connectDb();

  $module = "";

  if (isUserLogged()) {
    $module = "main.php";
    if (!empty($_GET["module"])) 
      $module = authorizeModuleAccess($db, $_GET["module"]);
  } else {
    $module = "login.php";
  }

  require "lib/modules/".$module;

  require "components/header.php";
  if (!empty($module)) {
    renderModule($db);
  }
  require "components/footer.php";

  $db->close();
  ob_end_flush();
?>
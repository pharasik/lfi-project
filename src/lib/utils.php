<?php
  function isUserLogged() {
    return isset($_SESSION["user_id"]);
  }

  function getLoggedUserId() {
    return $_SESSION["user_id"];
  }

  function setLoggedUserId($id) {
    $_SESSION["user_id"] = $id;
  }

  function authorizeModuleAccess($db, $requestedModule) {
    if ($requestedModule === "logout") {
      return "logout.php";
    }

    $module = "main.php";

    $query = "SELECT path, name FROM permissions INNER JOIN modules ON permissions.module_id = modules.id WHERE permissions.user_id = ".getLoggedUserId();
    if ($result = $db->query($query)) {
      foreach ($result as $row) {
        if ($row["path"] === $requestedModule) {
          $module = $requestedModule.".php";
          break;
        }
      }
      $result->free_result();
    }
    return $module;
  }

  function makeNav($db) {
    $query = "SELECT path, name FROM permissions INNER JOIN modules ON permissions.module_id = modules.id WHERE permissions.user_id = ".getLoggedUserId();
    $html = "";
    if ($result = $db->query($query)) {
      foreach ($result as $row) {
        $html .= "<li><a href='?module=".$row["path"]."'>".$row["name"]."</a></li>";
      }
      $result->free_result();
    }
    $html .= "<li><a href='?module=logout'>Wyloguj</a></li>";
    return $html;
  }
?>
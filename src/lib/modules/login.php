<?php
  function loginUser($db, $login, $password) {
    $password = sha1($password);
    $query = "SELECT id, password FROM users WHERE users.login = '".$login."'";
    $inDb = false;
    if ($result = $db->query($query)) {
      foreach ($result as $row) {
        if ($row["password"] === $password) {
          setLoggedUserId($row["id"]);
          $inDb = true;
          break;
        }
      }
      $result->free_result();
    }
    return $inDb;
  }

  function renderModule($db) {
    if (!empty($_POST["login"]) && !empty($_POST['password'])) {
      if (loginUser($db, $_POST["login"], $_POST["password"])) {
        header("Location: index.php");
        exit();
      }
    }

    echo <<<END
    <form action="" method="POST">
      <label for="login">Login</label>
      <input name="login" type="text"><br>
      <label for="password">Hasło</label>
      <input name="password" type="password"><br>
      <input type="submit" value="Zaloguj">
    </form>
    END;
  }
?>
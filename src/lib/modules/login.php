<?php
  function loginUser($db, $login, $password) {
    $password = sha1($password);
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $query = "SELECT id, password FROM users WHERE users.login = '".$login."';";
    $query .= "INSERT INTO login_logs (ip, timestamp) VALUES ('$ip', NOW());";
    $inDb = false;
    if ($db->multi_query($query)) {
      if ($result = $db->store_result()) {
          while ($row = $result->fetch_assoc()) {
              if ($row["password"] === $password) {
                  setLoggedUserId($row["id"]);
                  $inDb = true;
                  break;
              }
          }
          $result->free();
      }
      
      while ($db->more_results() && $db->next_result()) {
          $result = $db->store_result();
          if ($result) {
              $result->free();
          }
      }
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
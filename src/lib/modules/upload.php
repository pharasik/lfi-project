<?php
  function checkFile($file, $dstPath) {
    $uploadOk = true;

    if (file_exists($dstPath)) {
      $uploadOk = false;
    }

    if ($file["size"] > 200000) {
      $uploadOk = false;
    }

    if (!str_contains($dstPath, ".pdf")) {
      $uploadOk = false;
    }

    return $uploadOk;
  }

  function renderModule($db) {
    if (isset($_POST["submit"])) {
      $dstPath = "uploads/".$_FILES["file"]["full_path"];
      if (checkFile($_FILES["file"], $dstPath)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $dstPath)) {
          header("Location: index.php");
          exit();
        }
      }
    }

    echo <<<END
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="file">Podaj plik do przesłania</label><br>
      <input name="file" type="file"><br>
      <input name="submit" type="submit" value="Prześlij">
    </form>
    END;
  }
?>
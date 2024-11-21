<?php
  function renderModule($db) {
    echo "<p>Wylogowano</p>";
    unset($_SESSION['user_id']);
  }
?>
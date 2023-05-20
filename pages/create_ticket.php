<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../classes/session.class.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../classes/department.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/createticket.tpl.php');

  $db = getDatabaseConnection();
  $departments_get = Department::getDepartments($db);

  drawHeader($session);
  drawTicketForm($departments_get, $tags_get);
  drawFooter();
?>
<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../../classes/session.class.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    die(header('Location: ../../pages/index.php'));
  }

  require_once(__DIR__ . '/../../database/connection.db.php');
  require_once(__DIR__ . '/../../classes/department.class.php');
  require_once(__DIR__ . '/../../utils/validation.php');

  $db = getDatabaseConnection();

  if (!valid_token($_POST['csrf']) || !valid_new_department($db, $_POST['new_category'])) {
    die(header('Location: ../../pages/index.php'));
  }

  $department_name = strtolower(str_replace(" ", "_", $_POST['new_category']));
  $fileName = "../../images/departments/" . $department_name . ".png";
  move_uploaded_file($_FILES['departmentImage']['tmp_name'], $fileName);

  try {
    Department::addDepartment($db, htmlentities($_POST['new_category']));
  } 
  catch (PDOException $e) {
    $session->addMessage('error', 'Failed to create department');
  }

  header('Location: ../../pages/index.php');
?>
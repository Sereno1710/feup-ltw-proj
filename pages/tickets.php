<?php
  declare(strict_types=1);

  require_once(__DIR__ . '/../classes/session.class.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../classes/ticket.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');

  $db = getDatabaseConnection();

  $tickets = Ticket::searchTickets($db, $session->getId());

  drawHeader($session);
  drawTicketSearchBar();
  drawTickets($tickets);
  drawFooter();
?>
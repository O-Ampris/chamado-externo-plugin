<?php

function plugin_chamadoexterno_install() {
  global $DB;

  if (!$DB->tableExists('glpi_plugin_chamadoexterno_dados')) {
    $query = "
      CREATE TABLE `glpi_plugin_chamadoexterno_dados` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `ticket_id` INT UNSIGNED NOT NULL,
        `responsavel_externo` TEXT,
        `prazo_externo` DATETIME,
        `status_externo` ENUM('pendente', 'em_progresso', 'concluido') DEFAULT NULL,
        `date_mod` DATETIME DEFAULT NULL,
        `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY (`ticket_id`),
        FOREIGN KEY (`ticket_id`) REFERENCES `glpi_tickets` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";

    $DB->queryOrDie($query, "Erro ao criar tabela glpi_plugin_chamadoexterno_dados");
  }

  return true;
}

function plugin_chamadoexterno_uninstall() {
  return true;
}

function plugin_chamadoexterno_ticket_tab($params) {
  $ticket = $params['item'];
  
  if (get_class($ticket) != "Ticket") {
    return false;
  }
  
  $ticketID = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $ticket = null;
  
  if ($ticketID > 0) {
    global $DB;
    
    $query = "SELECT * FROM glpi_plugin_chamadoexterno_dados WHERE ticket_id = $ticketID";
    $res = $DB->query($query);

    if ($res && $res->num_rows > 0) {
      $ticket = $res->fetch_assoc();
    }
  }

  include_once __DIR__ . '/front/chamadoexterno-ticket.php';
}

function plugin_chamadoexterno_item_add(CommonDBTM $item) {
  if (get_class($item) == 'Ticket') { 
    global $DB;
    
    $ticket_id = $item->getID();
    
    $resp_ext = isset($_POST['externo-resp']) ? trim($DB->escape($_POST['externo-resp'])) : null;
    $prazo_ext = isset($_POST['prazo_ext_date']) ? date("Y-m-d H:i:s", strtotime($DB->escape($_POST['prazo_ext_date']))) : null;
    $status_ext = isset($_POST['status_ext_dd']) ? trim($DB->escape($_POST['status_ext_dd'])) : null;
    
    $insertQuery = "INSERT INTO glpi_plugin_chamadoexterno_dados (ticket_id, responsavel_externo, prazo_externo, status_externo) VALUES ($ticket_id, " . 
      (is_null($resp_ext) ? "NULL" : "'" . $DB->escape($resp_ext) . "'") . ", " . 
      (is_null($prazo_ext) ? "NULL" : "'" . $DB->escape($prazo_ext) . "'") . ", " . 
      (is_null($status_ext) ? "NULL" : "'" . $DB->escape($status_ext) . "'") . 
    ");";
    $DB->query($insertQuery);
  }
  return true;
}

function plugin_chamadoexterno_item_update(CommonDBTM $item) {
  if (get_class($item) != 'Ticket') {
    return true;
  }

  global $DB;

  $ticket_id = $item->getID();

  $resp_ext = isset($_POST['externo-resp']) ? trim($DB->escape($_POST['externo-resp'])) : null;
  $prazo_ext = isset($_POST['prazo_ext_date']) ? date("Y-m-d H:i:s", strtotime($DB->escape($_POST['prazo_ext_date']))) : null;
  $status_ext = isset($_POST['status_ext_dd']) ? trim($DB->escape($_POST['status_ext_dd'])) : null;

  $query = "SELECT id FROM glpi_plugin_chamadoexterno_dados WHERE ticket_id = $ticket_id";
  if ($DB->query($query)->num_rows > 0) {
    $updateQuery = "
      UPDATE glpi_plugin_chamadoexterno_dados
        SET responsavel_externo = " . (is_null($resp_ext) ? "NULL" : "'" . $DB->escape($resp_ext) . "'") .", 
        prazo_externo = " . (is_null($prazo_ext) ? "NULL" : "'" . $DB->escape($prazo_ext) . "'") .", 
        status_externo = " . (is_null($status_ext) ? "NULL" : "'" . $DB->escape($status_ext) . "'") ."
      WHERE ticket_id = $ticket_id;
    ";
    $DB->query($updateQuery);
  } else {
    $insertQuery = "INSERT INTO glpi_plugin_chamadoexterno_dados (ticket_id, responsavel_externo, prazo_externo, status_externo) VALUES ($ticket_id, " . 
      (is_null($resp_ext) ? "NULL" : "'" . $DB->escape($resp_ext) . "'") . ", " . 
      (is_null($prazo_ext) ? "NULL" : "'" . $DB->escape($prazo_ext) . "'") . ", " . 
      (is_null($status_ext) ? "NULL" : "'" . $DB->escape($status_ext) . "'") . 
    ");";
    $DB->query($insertQuery);
  }
  return true;
}


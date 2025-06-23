<?php

function plugin_chamadoexterno_install() {
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

  include_once __DIR__ . '/front/chamadoexterno-ticket.php';
}


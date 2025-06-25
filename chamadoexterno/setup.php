<?php

define('PLUGIN_CHAMADOEXTERNO_VERSION', '1.0.0');

function plugin_init_chamadoexterno() {
  global $PLUGIN_HOOKS;

  $PLUGIN_HOOKS['csrf_compliant']['chamadoexterno'] = true;
  $PLUGIN_HOOKS['post_item_form']['chamadoexterno'] = 'plugin_chamadoexterno_ticket_tab';
  $PLUGIN_HOOKS['item_add']['chamadoexterno'] = [
    'Ticket' => 'plugin_chamadoexterno_item_add'
  ];
  $PLUGIN_HOOKS['pre_item_update']['chamadoexterno'] = [
    'Ticket' => 'plugin_chamadoexterno_item_update'
  ];

}

function plugin_version_chamadoexterno() {
  return [
    'name' => 'Chamado Externo',
    'version' => PLUGIN_CHAMADOEXTERNO_VERSION,
    'author' => '<a href="https://github.com/O-Ampris">Fabio Araújo</a>',
    'license' => 'GPLv2+',
    'homepage' => 'https://github.com/O-Ampris/chamado-externo-plugin',
  ];
}

function plugin_chamadoexterno_check_prerequisites() {
  return true;
}

function plugin_chamadoexterno_check_config($verbose = false) {
  if (true) {
    return true;
  }

  if ($verbose) {
    echo __('Installed / not configured', 'chamadoexterno');
  }
  return false;
}
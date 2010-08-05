<?php
// $Id: node_service.inc,v 1.1.2.11.2.10 2010/02/20 23:50:05 heyrocker Exp $

/**
 * @file
 *  Link general node functionalities to services module.
 */

/**
 * Returns a specified node.
 *
 * @param $nid
 *   Number. The node ID.
 * @param $fields
 *   Array (optinonal). The node fields needed. If its empty,
 *   all fields will be returned
 * @return
 *   Object. The node object with all wanted fields.
 */
function mwc_service_get($nid, $fields = array()) {
  global $user;
  $node = node_load(array('nid' => $nid));

  if ($node) {
    // Apply field level content permissions
    if (module_exists('content') && variable_get('services_use_content_permissions', FALSE)) {
      $content_fields = content_fields(NULL, $node->type);
      foreach ($content_fields as $field_name => $field_info) {
        if (isset($node->$field_name)) {
          $access = module_invoke_all('field_access', 'view', $field_info, $user, $node);
          if (in_array(FALSE, $access)) {
            unset($node->$field_name);
          }
        }
      }
    }
    $result = services_node_load($node, $fields);
  }
  else {
    $result = services_error(t('Could not find the node.'), 404);
  }

  return $result;
}


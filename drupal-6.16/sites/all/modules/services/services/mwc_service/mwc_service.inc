<?php
// $Id: mwc_service.inc,v 1.1.2.11.2.10 2010/02/20 23:50:05 heyrocker Exp $

/**
 * @file
 *  Link general node functionalities to services module.
 */

/**
 * Returns a specified node.
 *
 * @param $task
 *   Number. The task id switch 
 *                             1 : Send mail contact 
 *                             2 : Send mail Bestil information
 *                             3 : Send mail Tell A Friend 
 *                             4 : Register Newletter 
 *                             5 : Send mail Feed Back 
 * @param $fields
 *   Array (optinonal). The node fields needed. If its empty,
 *   all fields will be returned
 * @return
 *   Object. The node object with all wanted fields.
 */
function mwc_service_contact($task=0, $fields = array()) {  
  switch($task){
    case 1:  
              $result = _mwc_contact($fields);
              break;
    case 2:  
              $result = _mwc_bestil_information($fields);
              break;
    case 3:  
              $result = _mwc_tell_a_friend($fields);
              break;
    case 4:  
              $result = _mwc_register_newletter($fields);
              break;
    case 5:  
              $result = _mwc_feed_back($fields);
              break;
    default:  
              $result = array('Task'=>'Not Found','return'=>false)  ;
     
  }  
  

  return $result;
}

/**
 * Check if the user has the permission to get the
 * node's data thru services.
 *
 * @param $nid
 *   Number. The node ID.
 * @return
 *   Boolean. TRUE if the user has view access.
 */
function mwc_service_contact_access() {
  global $user;
  return user_access('load node data');
}


function mwc_service_referencer($idTerm=0, $page=1) {  
    // Need to known offet start and end
    $offet_start = $offest_end = $pages = 0;
    $num_of_page = 9;
    $offet_start = ($page -1)*$num_of_page ;
    
    
    $result = taxonomy_select_nodes(array($idTerm));
    $items = array(); 
    while ($row = db_fetch_object($result)) {
            $items[] = $row->nid;
    }
    $offest_end = $pages = count($items);
    $pages      =  (int)($pages / $num_of_page)+1;        
    if (($offet_start+$num_of_page -1) < $offest_end )
                   $offest_end = $offet_start+$num_of_page -1 ;
    // Get nodes
    $nodes = array();
    module_load_include('inc', 'node_service', 'node_service');
    if ( $offet_start < $offest_end){
        for($i=$offet_start;$i<=$offest_end;$i++){
            $nodes[] = node_service_get($items[$i],array("nid","type","language","status","title","field_image_small","field_image_big"));       
       
        }
    }
    //var_dump($nodes);
    $result = array('idTerm'=> $idTerm , 'page'=>$page,'pages'=>$pages,'nodes'=>$nodes) ; 
  

  return $result;
}

/**
 * Check if the user has the permission to get the
 * node's data thru services.
 *
 * @param $nid
 *   Number. The node ID.
 * @return
 *   Boolean. TRUE if the user has view access.
 */
function mwc_service_referencer_access() {
  global $user;
  return user_access('load node data');
}

/**
 * Returns a specified node.
 *
 * @param $nid
 *   Number. The node ID.
 * @param $fields
 *   Array (optional). The node fields needed. If its empty,
 *   all fields will be returned
 * @param $teaser
 *   Boolean (optional). Format as teaser.
 * @param $page
  *   Boolean (optional). Format as page.
 * @return
 *   Object. The node object with all wanted fields.
 */
function mwc_service_view($nid, $fields = array(), $teaser = FALSE, $page = FALSE) {
  $node = services_node_load(node_build_content(node_load($nid), $teaser, $page), $fields);

  if (!$node) {
    return services_error(t("Could not find the node."), 404);
  }

  return $node;
}

/**
 * Check if the user has the permission to get the
 * node's formated data thru services.
 *
 * @param $nid
 *   Number. The node ID.
 * @return
 *   Boolean. TRUE if the user has the permission to get the
 *   node's data thru services.
 */
function mwc_service_view_access($nid) {
  global $user;
  $node = node_load($nid);
  return (node_access('view', $node) && user_access('load node data'));
}

function _mwc_contact($fields = array()){
    //var_dump($fields);
    $result = array('Task'=>'Contact-form','return'=>true)  ;
    return  $result; 
}
function _mwc_bestil_information($fields = array()){
    //var_dump($fields); 
    $result = array('Task'=>'Bestil-information','return'=>true)  ;   
    return  $result; 
}
function _mwc_tell_a_friend($fields = array()){
    $result = array('Task'=>'Tell-A-Friend','return'=>true)  ;
    return  $result; 
}
function _mwc_register_newletter($fields = array()){
    $result = array('Task'=>'Register-Newletter','return'=>true)  ;        
    return  $result; 
}
function _mwc_feed_back($fields = array()){
    $result = array('Task'=>'Feed-Back','return'=>true)  ; 
    return  $result; 
}
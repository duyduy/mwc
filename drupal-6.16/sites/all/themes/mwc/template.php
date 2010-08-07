<?php
// $Id: template.php,v 1.21 2009/08/12 04:25:15 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to mwc_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: mwc_breadcrumb()
 *
 *   where mwc is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function mwc_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
//* -- Delete this line if you want to use this function
function mwc_preprocess(&$vars, $hook) {
 // $vars['sample_variable'] = t('Lorem ipsum.');
 //var_dump($vars['template_files']);
 //var_dump($vars['secondary_links']);
 $dir =  drupal_get_path("theme", "mwc");
 drupal_add_js($dir.'/js/mwc.js');
 drupal_add_js($dir.'/js/jquery.validate.pack.js');
}
function _mwc_main_2style($menu){
    $html  = '';      
   if ( isset($menu)){
       $count =0;
       $dir   = _mwc_get_root_template();
       foreach ($menu as $key => $item){
            
            if (stripos($key,'active-trail') !== false){
                $current = "current";
            }else{
                $current = "";
            }
            $count++;
            if ($count == 1)
                $first = '<div class="na_home"><a class="'.$current.'"  href="'.$item['href'].'"><img src="'.$dir.'/css/img/home.png" alt="" /></a> </div>';
            if ($count == 8)
                $end = '<div class="na_kontakt">'.l($item['title'],$item['href'],array('attributes'=>array('class'=>$current))).'</div>';
            if ($count != 1 && $count !=8){
                $html .=  '<li  class="'.$current.'" >'.l($item['title'],$item['href'],array('attributes'=>array('class'=>$current))).'</li>';
            }
       }
       $html = $first .'<div id="tabs7"><ul>'.$html.'</ul></div>'.$end;
   }
   return  $html ; 
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
//* -- Delete this line if you want to use this function
function mwc_preprocess_page(&$vars, $hook) {
  // How to get default directory  ?

  $vars['directory_en'] = _mwc_get_root_template();

  if (isset($vars['node']) && $vars['node']->type =='page') {
     
    $vars['template_files'][] = 'page-'. str_replace('_', '-', $vars['node']->type);
    $vars['template_files'][] = 'page-'. str_replace('_', '-', $vars['node']->type).'-'. $vars['node']->nid;
  }
  
  $vars['secondary_html']= _mwc_main_2style($vars['secondary_links']);
  //var_dump($vars['secondary_html']);
}
function _mwc_get_root_template(){
  $directory     = drupal_get_path('theme','mwc');
  $language_list = language_list();
  $language_en   = $language_list['en'];
  $directory_en  = url($directory,array('language'=>'$language_en'));
  return  $directory_en;
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
//* -- Delete this line if you want to use this function
function mwc_preprocess_node(&$vars, $hook) {
  //$vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // mwc_preprocess_node_page() or mwc_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */
function mwc_preprocess_node_page(&$vars, $hook){
  $node = $vars['node'];
  $vars['template_file'] = 'node-'. $node->nid;
  $vars['directory_en'] = _mwc_get_root_template();
} 

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function mwc_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function mwc_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


function phptemplate_preprocess_page(&$vars){
 $css = $vars['css'];
 //var_dump($css);
 
 
 
 unset($css['all']['module']['profiles/uberdrupal/modules/admin_menu/admin_menu.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/cck/theme/content-module.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/filefield/filefield.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/lightbox2/css/lightbox.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_attribute/uc_attribute.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_order/uc_order.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_product/uc_product.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_store/uc_store.css']);
 unset($css['all']['module']['sites/all/modules/ckeditor/ckeditor.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_catalog/uc_catalog.css']);
 unset($css['all']['module']['profiles/uberdrupal/modules/ubercart/uc_cart/uc_cart_block.css']);
 
 
 unset($css['all']['theme']['sites/all/themes/zen/style.css']); 
 unset($css['all']['theme']['sites/all/themes/mwc/css/html-reset.css']);
 
 unset($css['all']['theme']['sites/all/themes/mwc/css/wireframes.css']); 
 unset($css['all']['theme']['sites/all/themes/mwc/css/page-backgrounds.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/tabs.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/messages.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/pages.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/block-editing.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/blocks.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/navigation.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/panels-styles.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/views-styles.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/nodes.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/comments.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/forms.css']);
 unset($css['all']['theme']['sites/all/themes/mwc/css/fields.css']);

 unset($css['print']['theme']['sites/all/themes/mwc/css/print.css']);
 
 unset($css['all']['module']['modules/node/node.css']);
 unset($css['all']['module']['modules/system/system-menus.css']);
 unset($css['all']['module']['modules/user/user.css']);
 unset($css['all']['module']['modules/system/system.css']);
 unset($css['all']['module']['modules/system/defaults.css']);
 $vars['styles'] = drupal_get_css($css);
}
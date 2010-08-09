<?php
// $Id: node.tpl.php,v 1.10 2009/11/02 17:42:27 johnalbin Exp $
// Page profil danish
/**
 * @file
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $build_mode: Build mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $build_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * The following variables are deprecated and will be removed in Drupal 7:
 * - $picture: This variable has been renamed $user_picture in Drupal 7.
 * - $submitted: Themed submission information output from
 *   theme_node_submitted().
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess()
 * @see zen_preprocess_node()
 * @see zen_process()
 */
?>
<?php json_load(); ?>
<?php 
  // load jQuery UI
  $path = drupal_get_path("theme", "mwc");
  drupal_add_js($path ."/js/jquery-ui-1.7.3.custom/jquery-ui-1.7.3.custom.min.js");
  drupal_add_js($path ."/js/sliding_effect.js");
?>
<?php

?>
<script  type="text/javascript" > 
//  0. Init config 
//  1.Set click  for each taxonomy
//  2.Control 2 screen : show all cateory and each category 
//  3.Extra_effect     
//  4.

//----  0 -----------
    var dataConfig = {} ;
	function data_init(){
		$('.bg_referencer ').each(function(index){
			$(this).attr('id','referencer-'+index);
			
		});		
	}
	function set_click_all_taxonomy(){
	
	}
	function show_all_taxonomy(){}
	function show_one_taxonomy(){}
	function _get_nodes_reference(){}
	function _extra_effect(){
	  // Explore all category sub special category
	  $('#referencer-3').effect("transfer",{ to: $("#title-effect") }, 1000);
	  
	}
	$(function(){
		data_init();
	});
//-----0  ------------

</script>

<div id="main"> 
       	  <div class="bg_tt_kontakt">
		    <div id="title-effect" ></div>
           	<p  class="title3">Referencer</p>
            </div>
            <div class="bg_referencer float_left">
            	<a href="referencer_website.html">
                    <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_1.png" alt="" /></div>
                    <div class="w300 float_right m25t"><img src="<?php print $directory_en ; ?>/css/img/tt_websitere.png" alt="" /></div>
                    <div class="clear"></div>
                </a>
            </div>
            <div class="bg_referencer float_right">
            	<a href="referencer_website.html">
                    <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_2.png" alt="" /></div>
                    <div class="w300 float_right m25t"><img src="<?php print $directory_en ; ?>/css/img/tt_webshopreference.png" alt="" /></div>
                    <div class="clear"></div>
                </a>
            </div>
          <div class="clear"></div>
            <div class="bg_referencer float_left">
            	<a href="referencer_website.html">
                    <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_3.png" alt="" /></div>
                    <div class="w300 float_right m25t">
                        <img src="<?php print $directory_en ; ?>/css/img/tt_portal1.png" alt="" /></div>
                    <div class="clear"></div>
                </a>
            </div>
            <div class="bg_referencer float_right">
            	<a href="referencer_website.html">
                    <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_4.png" alt="" /></div>
                    <div class="w300 float_right m25t"><img src="<?php print $directory_en ; ?>/css/img/tt_sogem1.png" alt="" /></div>
                    <div class="clear"></div>
                </a>
            </div>
          <div class="clear"></div>
            <div class="bg_referencer float_left">
           	  <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_5.png" alt="" /></div>
                
                <div class="w300 float_right m15t">
                    <div class="w143 float_left">
                    	<a href="referencer_logo.html"><img src="<?php print $directory_en ; ?>/css/img/tt_logo.png" alt="" id="Image5" onmouseover="MM_swapImage('Image5','','img/tt_logo_hover.png',1)" onmouseout="MM_swapImgRestore()" /></a>
                        <div class="m10t"><a href="referencer_visitkort.html"><img src="<?php print $directory_en ; ?>/css/img/tt_visitkort.png" alt="" id="Image6" onmouseover="MM_swapImage('Image6','','img/tt_visitkort_hover.png',1)" onmouseout="MM_swapImgRestore()" /></a></div>
                  </div>
                    <div class="w150 float_right">
                    	<a href="referencer_brochure.html"><img src="<?php print $directory_en ; ?>/css/img/tt_brochure.png" alt="" id="Image7" onmouseover="MM_swapImage('Image7','','img/tt_brochure_hover.png',1)" onmouseout="MM_swapImgRestore()" /></a>
                        <div class="m10t"><a href="referencer_banner.html"><img src="<?php print $directory_en ; ?>/css/img/tt_banner.png" alt="" id="Image8" onmouseover="MM_swapImage('Image8','','img/tt_banner_hover.png',1)" onmouseout="MM_swapImgRestore()" /></a></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="bg_referencer float_right">
            	<a href="referencer_website.html">
                    <div class="w143 float_left right"><img src="<?php print $directory_en ; ?>/css/img/icon_main_6.png" alt="" /></div>
                    <div class="w300 float_right m25t"><img src="<?php print $directory_en ; ?>/css/img/tt_flashbanner.png" alt="" /></div>
                    <div class="clear"></div>
                </a>
            </div>
            <div class="clear"></div>
        </div>

<?php return ; ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <?php print $user_picture; ?>

  <?php if (!$page): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($display_submitted || $terms): ?>
    <div class="meta">
      <?php if ($display_submitted): ?>
        <span class="submitted">
          <?php
            print t('Submitted by !username on !datetime',
              array('!username' => $name, '!datetime' => $date));
          ?>
        </span>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="content">
    <?php print $content; ?>
  </div>

  <?php print $links; ?>
</div> <!-- /.node -->

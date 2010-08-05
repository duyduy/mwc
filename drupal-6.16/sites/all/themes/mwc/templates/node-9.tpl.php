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
$node_type = "profil"; 
$result = db_query('SELECT n.nid , n.title FROM {node} n WHERE n.type = '."'$node_type'".' and n.status = 1 and n.language ="da"');
$output_menu = '';
while ($node = db_fetch_object($result))
{    
    $output_menu .= '<li class="sliding-element" ><a href="'.$node->nid.'" >'.$node->title.'</a></li>';
}
?>
<script  type="text/javascript" > 
//  1.Set click and modife css of menu profil 
//  2.Load content follow nid 
//  3.Effect 
 function menu_profil_click(){
	$("#menu-profil li a").bind('click', function() {
	   //alert($(this).attr("href"));
	   $("#menu-profil li a").removeClass("current");
	   $(this).addClass("current");
	   load_content($(this).attr("href"));
	   return false;
	});
	$("#menu-profil li a:first").click();   
	$("#menu-profil li:last").css("background","none");
   	
 }
 function load_content(nid){
    data = {nid: 13, fields: ["nid", "title", "body"]};
	data.nid = nid;
 	Drupal.service('node.get',data,function(status, data) {
       if(status == false) {
			  alert("Fatal error: could not load content");
	   }
	   else {
	       //alert(data.nid + data.body);
		   var html ='';
		   html  = '<div class="bg_tt_profil"><p class="title3">'+data.title+'</p></div>';
		   html += data.body;
		   if (data.nid == 13 ){
		      html += '<br class="clear_left" /><div class="m15t p15b"><a href="kontakt.html" class="button3"></a></div>'; 
		   }
		   
		   //$("#load-content").html(html);
		   effect_extra(html);
	   }
    });	    
 }
 function effect_extra(html){
            var options = {};
     		$("#load-content").hide('clip',options,2000,function(){$(this).show('clip',options,2000).html(html);});
 }
 $(function(){
 	 menu_profil_click();
 });

</script>

<div id="main">
        	<div class="bg_tt_kontakt">
            	<p class="title3">Profil</p>
            </div>
            <div class="w205 float_left m13t">
            	<ul id="menu-profil" class="list_menu p5t">
					<?php print $output_menu ?>
                </ul>
            </div>
            <div id="load-content" class="bg_profil_right m13t">
               <div class="bg_tt_profil"><p class="title3">Loading ...</p></div>
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

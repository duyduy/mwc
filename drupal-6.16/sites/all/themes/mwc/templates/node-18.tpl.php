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
//  1.Set click  for button send , reset and send best-infomation
//  2.Get variable  of each form and send it to server json
//  3.Extra function : validate and show message.
//  4.Advance extra function : serializeObject
function set_click_for_each_form(){
	$("#button-send").click(function(){
       if ($('#feedback-form').valid() == true)
            _extra_show_message('feedback-form'); 
	   //get_variable_and_sent_to_server_json('contact-form');
	   return false;
	});
	$("#button-reset").click(function(){
	   $('#feedback-form').get(0).reset();
	   return false;
	});
}
function get_variable_and_sent_to_server_json(idForm){
    var data = {};
    var options = {}; 
    var html_message = 'Tak for din henvendelse! <br/>Vi vil kontakte dig hurtigst muligt <br/>Med venlig hilsen ';
	data.fields = $('#'+idForm).serializeArray();
	if (idForm =='feedback-form'){data.task = '5';}
	//if (idForm =='bestil-form') {data.task = '2';}
	Drupal.service('mwc.contact',data,function(status, data) {
		   if(status == false) {
				  alert("Fatal error: could not load content");
		   }
		   else {
               
                    if (data.Task =='Feed-Back'){ 
                        $('#feedback-div').hide('pulsate',options,500,function(){
                            
                            $('#feedback-div').html(html_message).css('opacity',1).show('blind',options,1000);
                        })
                    }

              
		   }
	});	 
}
function _extra_validate(){
                                   
                            $("#feedback-form").validate({
                                        errorPlacement: function(error, element) {
                                            //element.hide();
                                        },
                                        showErrors:function(errorMap,errorList){},
                                        invalidHandler: function(form, validator) {
                                            var invalid = validator.errorMap;
                                            var count = 0;
                                            for(key in invalid) {
                                             if (count ==0){
                                                     //
                                                    if (key =='desc'){
                                                       alert($("textarea[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");
                                                    }else{
                                                    
                                                       alert($("input[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");   
                                                    }
                                                    
                                             }
                                             count++;
                                            }

                                        }                                                                                
                                    });

                            

}
function _extra_show_message(idForm){
   var options = {};   
   if (idForm =='feedback-form'){
        $("#button-send").hide('explode',options,500);
        $("#button-reset").hide('explode',options,500,function(){
            $('#feedback-form').parent().parent().attr('id','feedback-div').hide('blind',options,1500,function(){
                $('#feedback-div').html('Loading ...').show('blind',options,1000,function(){
                    get_variable_and_sent_to_server_json(idForm); 
                });
                 
            })
        }); 
   }

   
}
 
 $(function(){
 	 set_click_for_each_form();
     _extra_validate();
 });

</script>

<div id="main">
       
        	<div class="bg_tt_kontakt">
            	<p class="title3">Feedback</p>
            </div>
			
            <div class="bg_levering">
			   <div>
					Udfyld felterne nedenfor for at oprette en konto<br />
					Alle felter markeret <span class="orange">*</span> skal udfyldes!
					<div class="input_form p10t">
						<form action="" id="feedback-form">
						<label class="w115">Kontaktperson:</label>
						<input type="text" value="" class="w245 required"  name="person"/><br />
						<label class="w115">Email:</label>
						<input type="text" value="" class="w245 required email" name="email"/><br />
						<label class="w115">Emne:</label>
						<input type="text" value="" class="w245 required" name="subject" /><br />
						<label class="w115">Din besked:</label>
						<textarea class="w245 h80 required" name="desc"></textarea><br />
						<label class="w115">&nbsp;</label>
						<a href="#" id="button-send" class="bt_send float_left"></a>
						<a href="#" id="button-reset" class="bt_nulstil float_left m5l"></a><br class="clear_left" />
						</form>
					</div>
				</div>
            </div>
	        	
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

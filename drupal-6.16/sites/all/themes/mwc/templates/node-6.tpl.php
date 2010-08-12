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
  drupal_add_js($path ."/js/jquery.flip.min.js");
?>
<?php
 	$taxmenu = "SELECT tid, name FROM {term_data} WHERE vid = 2 ORDER BY weight";
	$result = db_query($taxmenu);
	$terms  = array();
	while ($data = db_fetch_object($result)) {
		$terms[] = $data;	
	}
?>
<script  type="text/javascript" > 
//  0. Init config 
//  1.Set click  for each taxonomy
//  2.Control 2 screen : show all cateory and each category 
//  3.Extra_effect     
//  4.

//----  0 -----------
    var term  = new Array();
    var term_special_stt = new Array(4,5,6,7);
	var dataConfig = {} ;
    var html_theme = {} ;
    <?php
	    $i = 0;
		foreach($terms as $term ){
			print "term[$i]={\"name\":\"".$term->name."\",\"tid\":".$term->tid."} ; \n" ;	
			$i++;					
		}
	 ?>
    dataConfig.term = term ;
    dataConfig.term_special_stt = term_special_stt ;
    html_theme.type1_header='<div class="bg_tt_kontakt">'+
                                '<p class="title3 float_left">Referencer - Website design</p>' +
                                '<span class="float_right"><a href="javascript:_extra_effect(null,1);"><img width="236" height="33" src="<?php print $directory_en ; ?>/css/img/bt_tilbage.jpg"/></a></span>'  +
                                '<br class="clear"/>'
                            '</div>';
    html_theme.type1_block = '<div class="float_left line_left">' +
                                '<div class="center p10t"><a href="#"><img src="img/img_website_1.jpg"/></a></div>'+
                                '<div class="tt_b_logo">'+
                                    '<div class="bg1_b_logo">'+
                                        '<span><a href="#">Andersen Kurer</a></span>'+
                                    '</div>'+
                                '</div>'+
                             '</div>';
    html_theme.type1_paging = '<div id="paging" class="box_pt p15b p15t"><ul></ul><br class="clear"/></div>';
    html_theme.type2_header ='<div class="box_menurefarence">' +
                                '<div class="box_iconrefarence w190 float_left box_boder_right m10r p20l">' +
                                    '<img src="<?php print $directory_en ; ?>/css/img/icon_logodesign.png" /> ' +
                                    '<span class="box_iconrefarence_tt current"><a href="referencer_logo.html">Logo design </a></span>'+
                                    '<br class="clear" /> '  +
                                '</div>'               +
                                '<div class="box_iconrefarence w220 float_left box_boder_right m10r p20l">' +
                                    '<img src="<?php print $directory_en ; ?>/css/img/icon_brochuredesign.png" />'  +
                                    '<span class="box_iconrefarence_tt"><a href="referencer_brochure.html">Brochure design</a></span>' +
                                    '<br class="clear" />' +
                                '</div>'  +
                                '<div class="box_iconrefarence w220 float_left box_boder_right m10r p20l">'+
                                    '<img src="<?php print $directory_en ; ?>/css/img/icon_visitcaredesign.png"/> '+
                                    '<span class="box_iconrefarence_tt"><a href="referencer_visitkort.html">Visitkort design</a></span>'+
                                    '<br class="clear" />'+
                                ' </div>' +
                                '<div class="box_iconrefarence w190 float_left p20l"> '+
                                    '<img src="<?php print $directory_en ; ?>/css/img/icon_bannerdesign.png"  />'+
                                    '<span class="box_iconrefarence_tt"><a href="referencer_banner.html">Banner design </a></span>'+
                                    '<br class="clear" />'+
                                '</div> ' +
                                '<div class="clear"></div>' +
                              '</div>';
    dataConfig.html_theme   = html_theme;
    
//------------End 0 -------------
	
	function data_init(){  
		$('.bg_referencer ').each(function(index){
			$(this).attr('id','referencer-'+index);
		});	
        	
        $('.bg_referencer a').each(function(index){
            
            $(this).bind('click',{term:dataConfig.term[index]},function(e){
                     //alert(e.data.term.name);
                     if ($(this).hasClass('a-special')){
                        show_one_taxonomy(e.data.term.tid,1,3);
                     }else{   
 				        show_one_taxonomy(e.data.term.tid,1,0);
                     }
                     return false;
                });
            if (jQuery.inArray(index, dataConfig.term_special_stt) > -1){  
                $(this).addClass('a-special'); 
            }
        });
	}
	function set_click_all_taxonomy(){
	
	}
	function show_all_taxonomy(){}
	function show_one_taxonomy(idTerm,page,type){
           var data = {};
           data.idTerm = idTerm;
           data.page   = page;  
           _get_all_nodes_in_term(data,type);	
           
           //$.each(data.nodes,function(index,node){
           //    alert(node.nid);
           //});	
	}
	function _get_all_nodes_in_term(data,type_display){
        //var data = {};
        //data.idTerm = 2;
        //data.page   = 1;  
	    Drupal.service('mwc.referencer',data,function(status, data) {
               if(status == false) {
                      alert("Fatal error: could not load content");
                      
               }
               else {
                       render_refer(data,type_display);
                                                          
               }
        });
	}
    function render_refer(data,type_display){
        var data_html = {};
        if (type_display == 0 || type_display == 2 || type_display == 3 || type_display == 4 ){
            var header =  $('<div>'+dataConfig.html_theme.type1_header+'</div>');
                $.each(dataConfig.term,function(i,term){
                    if (term.tid == data.idTerm){                      
                        header.find("p.title3").html(term.name);                       
                    }    
                })           
            var block = $('<div>'+dataConfig.html_theme.type1_block+'</div>');
            var html  ='';
            var i_clear = 0;
            $.each(data.nodes,function(index,node){
                //alert(node.field_image_small[0].filepath);  
                //alert(index);
                if (node.field_image_small)
                    block.find('img').attr('src',Drupal.settings.baseurl + node.field_image_small[0].filepath);
                html += block.html();  
                i_clear ++; 
                if (i_clear % 3 ==0){
                    html += '<div class="line_right"></div>';
                }
            });
			html += '<div class="clear"></div>';
            
            var paging = $('<div>'+dataConfig.html_theme.type1_paging+'</div>');
            var i ;   
            for (i=1;i<=data.pages;i++){ 
                if ( i == data.page){
                    paging.find('ul').append("<li class=\"current\" ><a href='#'>"+i+"</li></a>"); 
                }else{
                    j=2;
                    if (type_display == 4 || type_display ==3 ) j=4;
                        
                    paging.find('ul').append("<li><a href='javascript:show_one_taxonomy(" +data.idTerm+","+i+","+j+");'>"+i+"</li></a>");
                }
            }

            data_html.header  =   header.html();
            data_html.block   =   html         ;
            data_html.paging  =   paging.html();
            
            //html = '<div class="p15t">'+header.html()+html+paging.html()+'</div>';
            
            //$('#main').html(html);
            
        } 
        _extra_effect(data_html,type_display); 
    }
	function _get_nodes_reference(){}
	//var data = {'index':0};
	function _extra_effect(data,effect_type){
	  // Explore all category sub special category
      
      //alert(data);
      if (effect_type == 0 ){                           
          // Change show all term to detail of term
          /*$('#main').flip({direction:'lr',content:'<div class="p15t">'+data.header+data.block+data.paging+'</div>',
                           onBefore: function(){},
                           onEnd: function(){$("#main").removeAttr('style');}   
                           });
          */
          $('#main').height($('#main').height());
          $('#main > .bg_referencer').each(function(index){
              if ( index == 0) {
               $(this).hide('clip',{},510,function(){
                       
                       $('#main').html(data.header+'<div class="p15t" style="display:none;">'+data.block+data.paging+'</div>');
                       $('#main > .p15t').show('explode',{},500,function(){
                           $("#main").removeAttr('style');
                       }); 
               });
              }else{
               $(this).hide('clip',{},500);
              }
          })
          
      }
      if (effect_type== 1){
          // Change show detail of term to all term 
          
          $('#main').flip({direction:'tb',content:dataConfig.html_all_term ,
                           onEnd: function(){$("#main").removeAttr('style');data_init();}   
                           });
      }
      if (effect_type == 2){
          // Show paging 
          $("#main").html('<div class="p15t">'+data.header+data.block+data.paging+'</div>');
      }
      if (effect_type == 3){          
           $('#main').flip({direction:'lr',content:'<div class="p15t">'+data.header+data.block+data.paging+'</div>',
                           onEnd: function(){$("#main").removeAttr('style');
                                              //alert('b');
                                              special_header = $('<div>'+html_theme.type2_header+'</div>');
                                              special_header.find(".box_menurefarence").hide();
                                              $("#main > div.p15t").find('.bg_tt_kontakt').after(special_header.html());
                                              $('.box_menurefarence').show('blind');
                                            }  
                           });
          // add more header
      }
      if (effect_type == 4){
          $('#main > .p15t').height($('#main > .p15t').height());
          $('#main > .p15t > .line_left ').hide();
          $('#main > .p15t > .line_right ').hide(); 
          $('#main > .p15t > .clear ').hide();
          $('#main > .p15t > .box_menurefarence').after(data.block); 
          
      }
	  /*data.index = 3;
	  $('.bg_referencer ').each(function(index){
			if (index != 3 ){
				$(this).flip({
					direction:'lr',
						color    : '#ffffff',
						content  : ' '
				})	
			}
			
	  })	
      */  
	  //$('#referencer-3').effect("transfer",{ to: $("#title-effect") }, 1000);
	  
	}

	$(function(){
		data_init();
        dataConfig.html_all_term = $('#main').html();
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

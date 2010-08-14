<?php
// $Id: node.tpl.php,v 1.10 2009/11/02 17:42:27 johnalbin Exp $

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
 /* 
 *   Javascript render 
 *   1. Input type :  <table> </table>
 *   2. Ouput type : <table> </table> + bind click + function sum price
 *   3. Render process: 
 *     A.
 *          3.1  Convert data from input to array type                 
 *          3.2  Render array type data to ouput type 
 *          3.3  Bind click 
 *          3.4  Valiate extra
 *   4. Code function :
 *      data       = get_table_price(idTable);
 *      table_html = render_table_html(data);
 *      extra_customer_price()
 *      extra_validate
 */
?>
<script type="text/javascript">
   function get_table_price(idTable){
        var data_price =[] ;
        $('#price-table table tr').each(function(index){
            tr = $('<tr>'+$(this).html()+'<tr/>'); //alert(tr.html());
            row_price = [];
            tr.find('td').each(function(){
               //alert($(this).html());
               row_price.push($(this).html());      
            });
            data_price.push(row_price);
        })
        return data_price;   
   }
   function render_table_html(data){
        var tr = {} ;
        tr.first = '<tr>' +
                '<td width="10"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/corn_left_table.jpg" width="10" height="49" /></td>' +
                '<td width="206" class="bg_top_table1 p20l"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/text_feature.png" width="64" height="15" /></td> ' +
                '<td width="181" class="bgtt_cen"> ' +
                    '<div class="bgtt_left"></div>' +
                    '<div class="bgtt_cen">'+
                        '<img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/text_basiepakken1.jpg" width="109" height="19" class="p15t p20l" />        </div>'+
                    '<div class="bgtt_right"></div> '+
                   ' <div class="clear"></div>    </td>'  +
                '<td width="181" class="bg_top_table"><a href="#"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/text_pluspakken.png" width="100" height="19" /></a></td>'+
                '<td width="181" class="bg_top_table"><a href="#"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/text_propakken.png" width="93" height="19" /></a></td>' +
                '<td width="181" class="bg_top_table"><a href="#"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/text_propakken.png" width="93" height="19" /></a></td>'+
                '<td width="10"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/corn_right_table.jpg" width="10" height="49" /></td>' +
              '</tr>' ;
        tr.normal = '<tr>'+
                '<td class="boder_left">&nbsp;</td>' +
                '<td class="boder_bt_d p20l">Unikt design</td>'+
                '<td class="bs1l bs1r p40l"> <a href="#"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/icon5_1.jpg" width="24" height="24" style="float:left" /></a><span style="position:relative; top:5px;">1 oplæg</span></td>'+
                '<td class="boder_bt_d p40l"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/icon5.jpg" width="24" height="24" style="float:left" /><span style="position:relative; top:5px;"> 2 oplæg</span></td>' +
                '<td class="boder_bt_d p40l"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/icon5.jpg" width="24" height="24" style="float:left" /><span style="position:relative; top:5px;">3 oplæg</span></td>' +
                '<td class="boder_bt_d p40l"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/icon5.jpg" width="24" height="24" style="float:left" /><span style="position:relative; top:5px;">3 oplæg</span></td>' +
                '<td class="boder_right">&nbsp;</td>' +
              '</tr>';
        tr.last  ='<tr>' +
                '<td class="boder_left bs1b">&nbsp;</td>' +
                '<td class="col_blue p5t p5b bs1b p20l">Pris</td>' +
                '<td class="col_ogr p5t p5b p40l bs1l bs1r">DKK 9.995,-</td>'+
                '<td class="col_ogr p5t p5b bs1b p40l">DKK 9.995,-</td>'+
                '<td class="col_ogr p5t p5b bs1b p40l">DKK 9.995,-</td>'+
                '<td class="col_ogr p5t p5b bs1b p40l">DKK 9.995,-</td>'  +
                '<td class="boder_right bs1b">&nbsp;</td>' +
              '</tr>';
        var first = 0;
        var last  = data.length -1;
        var html = '';
        $.each(data,function(index){
            tr = "";
            if ( index == first ){
                $.each(data[index],function(jndex){
                    if (jndex != 0)
                    tr += '<td width="181" class="bg_top_table">'+data[index][jndex]+'</td>'

                })
                tr = '<td width="10"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/corn_left_table.jpg" width="10" height="49" /></td>'+
                     '<td width="206" class="bg_top_table1 p20l"></td>'+
                     tr+'<td width="10"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/corn_right_table.jpg" width="10" height="49" /></td>';
                html += '<tr class="1">'+tr+'</tr>';
            }
                    
            if (index == last){
                 $.each(data[index],function(jndex){
                    if (jndex ==0){
                        tr += '<td class="col_blue p5t p5b bs1b p20l">'+data[index][jndex]+'</td>';
                    }else{
                        tr += '<td class="col_ogr p5t p5b bs1b p40l">'+data[index][jndex]+'</td>'
                    }
                 })
                 tr = '<td class="boder_left bs1b">&nbsp;</td>'+tr+'<td class="boder_right bs1b">&nbsp;</td>';
                 html += '<tr>'+tr+'</tr>';            
            }
                   
            if (index != first && index != last){
                $.each(data[index],function(jndex){
                    if (jndex ==0){
                       tr += '<td class="boder_bt_d p20l">'+data[index][jndex]+'</td>' ;               
                     }else{
                       tr += '<td class="boder_bt_d p40l"><img src="'+Drupal.settings.basePath+'sites/all/themes/mwc/css/img/icon5.jpg" width="24" height="24" style="float:left" /><span style="position:relative; top:5px;">'+data[index][jndex]+'</span></td>' ;               
                    }
                })
                tr = '<tr><td class="boder_left">&nbsp;</td>'+tr+'<td class="boder_right">&nbsp;</td></tr>';
                html += '<tr>'+tr+'</tr>'; 
            }
                                   
        })
       return '<table width="100%" cellspacing="0" cellpadding="0" border="0">'+html+'</table>';
   }
   $(function(){
       data_price = get_table_price('price-table'); 
       html =render_table_html(data_price);
       $("#test").html(html);
	   //alert(data_price[0][0]);
   })
   var data_price = [];
</script>
<div id="main">
        	<div class="bg_tt_kontakt">
            	<p class="title3"><?php print $title; ?></p>
            </div>
            <?php //print $content ; ?>
            <div id="price-table"><?php print $field_price[0]["value"] ; ?></div>
            <div id="test"></div>
           
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
    <?php //print $content; ?>
  </div>

  <?php print $links; ?>
</div> <!-- /.node -->

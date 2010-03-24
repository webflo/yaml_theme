<?php
// $Id:$
if (!empty($xml_prolog)) { print $xml_prolog; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <?php print $styles ?>
  <?php print $ie_css ?>
  <?php print $scripts ?>
</head>

<body class="<?php print $body_classes; ?>">
<?php if (isset($fontsize_init)) { print $fontsize_init; } ?>

<div class="page_margins page-center <?=$page_width?>" <?=$page_width_exact?> >
  <div class="page">
    <!-- begin: top -->
    
    <?php if ($top_right||$top_left): ?>
    <div id="top" class="clearfix">
  	  <!-- Subtemplate: 2 Spalten mit 50/50 Teilung -->
  	  <div class="subcolumns">
      		<div id="top-left" class="c50l">
      		  <div class="subcl">
      			  <? if($top_left) { print $top_left; }?>
      		  </div>
      		</div>

          <div id="top-right" class="c50r">
            <div class="subcr">
          	<!-- Inhalt rechter Block -->
          	<? if($top_right || 1) { print $top_right; }?>
            </div>
          </div>
	   </div>
    </div>
    <?php endif; ?>
    <!-- end: top -->
    <!-- begin: header -->
        <?php if ($header_full||$header_left||$header_right||($theme_show_header==1&&($logo||$site_name||$site_slogan))): ?>
	 <div id="header">
        <div id="header_full">
          <? if($header_full) { print $header_full; }?>
        </div>
	
        <?php if ($header_left||$header_right||($theme_show_header==1&&($logo||$site_name||$site_slogan))): ?>
        <div id="header-splitted" class="subcolumns" >
        		<div id="header-left" class="c50l">
          		  <div class="subcl">
          		    <?php if($theme_show_header == 1) {?>
            			  <?php if ($logo) { ?><a href="<?php print $base_path ?>" title="<?php print $site_name?>"><img id="site-logo" class="_trans" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
            			  <?php if ($site_name && !$logo) { ?><h1 id="site-name"><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
            			  <?php if ($site_slogan) { ?><div id="site-slogan"><?php print $site_slogan ?></div><?php } ?>
            			<?php }?>
            			<? if($header_left) { print $header_left; }?>
          		  </div>
        		</div>
        		<div id="header-right" class="c50r">
                  <div class="subcr">
                     <? if($header_right) { print $header_right; }?>
                  </div>
        		</div>
        </div>
	<?php endif ?>
    </div>
	<?php endif ?>
    <!-- end: header -->
    <!-- begin: main navigation #nav -->
    <?php if ($navigation): ?>
    <div id="nav">
        <a id="navigation" name="navigation"></a> <!-- skip anchor: navigation -->
          <?php print $navigation ?>
    </div>
    <?php endif; ?>
    <!-- end: main navigation -->

    <!-- begin: main content area #main -->
    <div id="main">
      <?php if ($mission) { ?>
      <!-- #mission: between main navigation and content -->
      <div id="mission" class="clearfix">
        <?php print $mission ?>
      </div>
      <?php } ?>

      <!-- begin: #col1 - first float column -->
      <?php if (($theme_cols >= 2) && ($left_top||$left_middle||$left_bottom)): ?>
      <div id="col1">
        <div id="col1_content" class="clearfix">
          <div id="col1_inside">
       	    <?php if ($left_top): ?>
      			  <div class="left_top">
      				  <?php print $left_top ?>
      			  </div>
            <?php endif; ?>
    			  <?php if ($left_middle): ?>
      			  <div class="left_middle">
      				  <?php print $left_middle ?>
      			  </div>
            <?php endif; ?>
    			  <?php if ($left_bottom): ?>
      			  <div class="left_bottom">
      				  <?php print $left_bottom ?>
      			  </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- end: #col1 -->
      <?php endif; ?>

      <?php if (($theme_cols == 3) && ($right_top||$right_middle||$right_bottom)): ?>
      <!-- begin: #col2 second float column -->
      <div id="col2">
        <div id="col2_content" class="clearfix">
          <div id="col2_inside">
            <?php if ($right_top): ?>
      			  <div class="right_top">
      				  <?php print $right_top ?>
      			  </div>
            <?php endif; ?>
            <?php if ($right_middle): ?>
              <div class="right_middle">
            	  <?php print $right_middle ?>
              </div>
            <?php endif; ?>
      			<?php if ($right_bottom): ?>
      			  <div class="right_bottom">
      				  <?php print $right_bottom ?>
      			  </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- end: #col2 -->
      <?php endif; ?>

      <!-- begin: #col3 static column -->
      <div id="col3">
        <div id="col3_content" class="clearfix"> <a id="content" name="content"></a> <!-- skip anchor: content -->
            <div id="col3_inside">
        	    <?php if ($breadcrumb) { ?>
        	        <?php print $breadcrumb ?>
        			<?php } ?>
              <?php if ($content_above_tabs): ?>
                <div id="content_above_tabs" class="clearfix">
                  <?php print $content_above_tabs ?>
                </div>
              <?php endif; ?>
        			<?php if ( $tabs_primary != '' && $theme_show_local_tasks == 1) : ?>
         		     	<div class="local-task">
				  <div class="clearfix">
		                  <?php print $tabs_primary?>
				  </div>
                		  <?php print $tabs_secondary?>
        			</div>
        			<?php endif; ?>
        			<?php if ($content_below_tabs): ?>
        			<div id="content_below_tabs" class="clearfix">
        			  <?php print $content_below_tabs ?>
        			</div>
              <?php endif; ?>
        			<div class="content-region <? if(!empty($node)) { print "node-".$node->nid;print " node-type-".$node->type; } ?> op-<?=$current_op?>">
                <?php print $content_above_maincontent ?>
        			  <?php if ($show_messages && $messages): print $messages; endif; ?>
        			  <?php print $help ?>
        			  <?php print $content ?>
        			  <?php print $feed_icons ?>
        			</div>
        			<?php if ($content_bottom): ?>
        			  <div class="content_bottom">
        				  <?php print $content_bottom ?>
        			  </div>
              <?php endif; ?>
            </div>
        </div>
        <div id="ie_clearing">&nbsp;</div>
        <!-- end: IE Column Clearing -->
      </div>
      <!-- end: #col3 -->
    </div>
    <!-- end: #main -->

    <!-- begin: #footer -->
    <?php if($footer_left||$footer_right||$footer_full): ?>
    <div id="footer">
      <div id="footer_full" >
        <? if($footer_full) { print $footer_full; }?>
      </div>
  	  <!-- Subtemplate: 2 Spalten mit 50/50 Teilung -->
	  <?php if($footer_left||$footer_right): ?>
  	  <div class="subcolumns">
    		  <div class="c50l">
    		    <div class="subcl">
      	       <?php print $footer_left ?>
      		  </div>
    		  </div>
  		    <div class="c50r">
  		      <div class="subcr">
      	       <?php print $footer_right ?>
      		  </div>
         </div>
	 <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    <!-- end: #footer -->
  </div>
  <?php if($page_bottom_text != ""): ?>
  <div id="page_bottom" <?=$page_width?>" <?=$page_width_exact?>>
    <?if($page_bottom_text != "") print $page_bottom_text?>
  </div>
  <?php endif ?>
  <?php print $closure ?>
</body>
</html>

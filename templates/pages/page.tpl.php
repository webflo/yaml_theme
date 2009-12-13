<?php
// $Id: page.tpl.php,v 3.1.0.12 2009/06/07 00:00:00 hass Exp $
?><?php if (!empty($xml_prolog)) { print $xml_prolog; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title ?></title>
  <!-- Subtemplate: 2 Spalten mit 50/50 Teilung -->
  <?php print $styles ?>
  <?php print $scripts ?>
</head>

<body class="<?php print $body_classes; ?>">
<?php if (isset($fontsize_init)) { print $fontsize_init; } ?>

<div class="page_margins page-center <?=$page_width?>" <?=$page_width_exact?> >
  <?php print $border_top ?>
  <div class="page" >
    <!-- begin: top -->
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
			<? if($top_right) { print $top_right; }?>
		  </div>
		</div>
	  </div> 
    </div>
    <!-- end: top -->
    <!-- begin: header -->
    <div id="header" class="clearfix">
	  <!-- Subtemplate: 2 Spalten mit 50/50 Teilung -->
	  <div class="subcolumns">
		<div id="header-left" class="c50l">
		  <div class="subcl">
			  <?php if ($logo) { ?><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img id="site-logo" class="_trans" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
			  <?php if ($site_name) { ?><h1 id="site-name"><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
			  <?php if ($site_slogan) { ?><div id="site-slogan"><?php print $site_slogan ?></div><?php } ?>
			  <? if($header_left) { print $header_left; }?>
		  </div>
		</div>
	 
		<div id="header-right" class="c50r">
		  <div class="subcr">
			  <div id="topnav">
				<a class="skip" href="#navigation" title="<?php print t('Skip to the navigation') ?>"><?php print t('Skip to the navigation') ?></a><span class="hideme">.</span>
				<a class="skip" href="#content" title="<?php print t('Skip to the content') ?>"><?php print t('Skip to the content') ?></a><span class="hideme">.</span>
			  </div>			  
			<? if($header_right) { print $header_right; }?>
		  </div>
		</div>
	  </div> 
    </div>
    <!-- end: header -->
    <!-- begin: main navigation #nav -->
    <div id="nav-bar" class="clearfix">
	  <div class="subcolumns">
		 <a id="navigation" name="navigation"></a> <!-- skip anchor: navigation -->
	          <?php if ($navigation): ?>
			<div class="hlist">
			  <?php print $navigation ?>
			</div>
		<?php endif; ?>
	  </div>
    </div>
    <!-- end: main navigation -->

    <!-- begin: main content area #main -->
    <div id="main">

      <?php if ($mission) { ?>
      <!-- #mission: between main navigation and content -->
      <div id="mission" class="clearfix">
        <?php print $mission ?>
      </div>
      <?php } ?>

      <?php if ($left_top||$left_middle||$left_bottom): ?>
      <!-- begin: #col1 - first float column -->
      <div id="col1">
        <div id="col1_content" class="clearfix">
          <div id="col1_inside" class="floatbox">
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
          <div id="col2_inside" class="floatbox">
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
          <div id="col3_inside" class="floatbox">
		    <?php if ($breadcrumb) { ?>
		        <?php print $breadcrumb ?>
			<?php } ?>
			<?php if ($tabs) { ?>
		      <div class="tabs">
		        <?php print $tabs ?>
			  </div>
			<?php } ?>
			<?php if ($content_top): ?>
			  <div class="content_top">
				  <?php print $content_top ?>
			  </div>
                    <?php endif; ?>
			<div class="content <? if(!empty($node)) { print "node-".$node->nid;print " node-type-".$node->type; } ?> op-<?=$current_op?>">
  			  <?php if($title) { ?><h2 class="pagetitle"><?php print $title ?></h2><?php } ?>
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
    <div id="footer">
	  <!-- Subtemplate: 2 Spalten mit 50/50 Teilung -->
	  <div class="subcolumns">
		<div class="c50l">
		  <div class="subcl">
			<!-- Inhalt linker Block -->
	       <?php print $footer_left ?>
		  </div>
		</div>
	  
		<div class="c50r">
		  <div class="subcr">
			<!-- Inhalt rechter Block -->
	       <?php print $footer_right ?>
		  </div>
		</div>
	  </div>     
    </div>
    <!-- end: #footer -->
  </div>
  <?php print $border_bottom ?>
</div>
<?php print $closure ?>
</body>
</html>

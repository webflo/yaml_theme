<?php
// $Id: print.tpl.php,v 1.8.2.13 2009/05/13 16:18:06 jcnventura Exp $

/**
 * @file
 * Default print module template
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $print['language']; ?>" xml:lang="<?php print $print['language']; ?>">
  <head>
    <?php print $print['head']; ?>
    <title><?php print $print['title']; ?></title>
    <?php print $print['scripts']; ?>
    <?php print $print['robots_meta']; ?>
    <?php print $print['base_href']; ?>
    <?php print $print['favicon']; ?>
    <?php print $print['css']; ?>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print "/".path_to_theme()."/css/typography.css"; ?>" />
    <link type="text/css" rel="stylesheet" media="all" href="<?php print "/".path_to_theme()."/print.css"; ?>" />
  </head>
  <body<?php print $print['sendtoprinter']; ?>>
    <?php if (!empty($print['message'])) {
      print '<div class="print-message">'. $print['message'] .'</div><br />';
    } ?>
    <div class="print-logo"><?php print $print['logo']; ?></div>
    <div id="clear"></div>    
    <br />
    <hr class="print-hr" />
    <h1 class="print-title"><?php print $print['title']; ?></h1>
    <div id="main-content"><?php print $print['node']->content['body']['#value']; ?></div>
    <div class="print-footer"><?php print $print['footer_message']; ?></div>
    <hr class="print-hr" />
    <div class="print-source_url"><?php print $print['source_url']; ?> (gedruckt am <?print date("d.m.Y"); ?>)</div>
  </body>
</html>

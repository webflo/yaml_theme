<?php
// $Id$
?>
<?php if ($title): ?>
  <h2 class="title"><?php print $title ?></h2>
<?php endif; ?>
<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
  <?php print $picture; ?>
  <?php if ($page == 0): ?>
    
  <div class="nodetitle"><h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2></div>
  <div class="date">
		<?php if ($submitted): ?>
		<span class="submitted"><?php print $submitted; ?></span>
	  	<?php endif; ?>
	</div>
  <?php endif; ?>
	<div class="content">
		<?php print $content; ?>
	</div>

</div>
<div class="links_footer">
	<?php print $links; ?>
</div>

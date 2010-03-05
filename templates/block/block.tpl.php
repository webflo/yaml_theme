 <div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; ?> <?php print $block->css?>" id="block-<?php print $block->module; ?>-<?php print $block->delta; ?>">
	    <?php if(!empty($block->subject)):?> <h2 class="title"><?php print $block->subject; ?></h2><?php endif; ?>
	    <div class="content floatbox"><?php print $block->content; ?></div>
 </div>

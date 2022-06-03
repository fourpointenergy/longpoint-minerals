<?php if(!isset($prefooter_pageid)) $prefooter_pageid = $post->ID; ?>
<?php //var_dump($prefooter_pageid); ?>
  <?php if(get_field('prefooter_bg_image',$prefooter_pageid)) { ?>
    <div class="pre-footer <?php if(get_field('prefooter_bg_color',$prefooter_pageid)) { echo(get_field('prefooter_bg_color',$prefooter_pageid).'-overlay '); } ?>relative" style="background-image:url(<?php the_field('prefooter_bg_image',$prefooter_pageid) ?>)">
  <?php } else { ?>
    <div class="pre-footer pre-footer-<?php the_field('prefooter_bg_color',$prefooter_pageid) ?>">
  <?php } ?>
<?php
  if( have_rows('prefooter_cards',$prefooter_pageid) ): ?>

  <div class="wrapper mxn3 flex flex-wrap" id="js-pf-fadeUp">
    <?php
    $index = 0;
    while ( have_rows('prefooter_cards',$prefooter_pageid) ) : the_row(); $index++;?>
      <?php if(get_sub_field('learn_more_link',$prefooter_pageid)) { ?>
        <a href="<?php the_sub_field('learn_more_link',$prefooter_pageid); ?>" class="pre-footer-box sm-col-6 my2 pb1 box-col-<? echo $index; ?>"></a>
      <?php } ?>
      <div class="box-col-<? echo $index; ?> box-inner shadow-border box-white border-top px3 pt4 pb3 <?php if(get_field('prefooter_bg_color',$prefooter_pageid) && (get_field('prefooter_bg_color',$prefooter_pageid) == 'dkblue')) { echo('box-blu-blk border-gold'); } ?>"></div>
      <?php $card_icon_arr = get_sub_field('card_icon',$prefooter_pageid); ?>
      <img src="<?php echo $card_icon_arr['url'] ?>" class="pre-footer-icon box-col-<? echo $index; ?>" alt="<?php the_sub_field('card_heading',$prefooter_pageid); ?>" />
      <h5 class="h5-pre-footer box-col-<? echo $index; ?> text-uppercase<?php if(get_field('prefooter_bg_color',$prefooter_pageid) && (get_field('prefooter_bg_color',$prefooter_pageid) == 'dkblue')) { echo(' white-text'); } ?>"><?php the_sub_field('card_heading',$prefooter_pageid); ?></h5>
      <div class="pre-footer-content box-col-<? echo $index; ?> <?php if(get_field('prefooter_bg_color',$prefooter_pageid) && (get_field('prefooter_bg_color',$prefooter_pageid) == 'dkblue')) { echo('box-blu-blk border-gold'); } ?>">
        <?php the_sub_field('card_content'); ?>
      </div>
      <div class="text-link-container box-col-<? echo $index; ?>">
        <?php if(get_sub_field('learn_more_link')) { ?>
          <p role="button" class="text-uppercase text-link text-link-arrow<?php if(get_field('prefooter_bg_color',$prefooter_pageid) && (get_field('prefooter_bg_color',$prefooter_pageid) == 'dkblue')) { echo(' text-link-arrow-white'); } ?>">Learn More</p>
        <?php } ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
</div>

<?php
if (is_category()) {
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
} else {
  $post_id = get_the_ID();
}
if(is_singular('area_vicinity')){
  $post_id = get_page_by_path('brand-tokei');
  $post_id = $post_id->ID;
}
?>
<?php
$rp_cnt =  count(get_field('purchase_achieve_brand_repeat', $post_id));
if ($rp_cnt > 0 || is_singular('area_vicinity')) :

?>
  <section>
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php if(is_singular('area_vicinity') && have_rows('genre_purchase_goods_repeat')) { ?>
          <?php echo get_field('genre_purchase_goods_headline'); ?>
        <?php } else{ ?>
          <?php the_field('purchase_achieve_headline', $post_id); ?>
        <?php } ?>
      </h2>
      <div class="titleMain--lead">
        <p><?php the_field('purchase_achieve_lead_text', $post_id); ?></p>
      </div>
    </div>

    <div class="flex flex--hasItem<?php echo $rp_cnt; ?>">
      <!-- タブメニュー -->
      <?php
      if ($rp_cnt > 1) :
      ?>
        <ul class="flex__tab">
          <!-- タブ部分 -->
          <?php
          if (have_rows('purchase_achieve_brand_repeat', $post_id)) :
            $cnt = 1;
            while (have_rows('purchase_achieve_brand_repeat', $post_id)) : the_row();
          ?>
              <li class="tab__item <?php if ($cnt == 1) echo 'active'; ?>"><a><?php the_sub_field('purchase_achieve_brand_repeat_name', $post_id); ?></a></li>
          <?php
              $cnt++;
            endwhile;
          endif;
          ?>
        </ul>
      <?php
      endif;
      ?>




      <!-- スライダー部分 -->
      <div class="flex__tabContents">

        <?php
        if (have_rows('purchase_achieve_brand_repeat', $post_id)) :
          $cat_cnt = 1;
          while (have_rows('purchase_achieve_brand_repeat', $post_id)) : the_row();
            $term = get_sub_field('purchase_achieve_brand_repeat_category');
        ?>
            <div class="flex__content <?php if ($cat_cnt == 1) echo 'active'; ?>">
              <div id="flex-slider<?php echo $cat_cnt; ?>" class="content__list flex--slide">
                <?php purchase_achieve_brand_model_list(16, $term->slug); ?>
              </div>
              <!-- pagenation -->
              <div class="flex--slide__pagenation">
                <div class="pagenation--arrows flex-slider<?php echo  $cat_cnt; ?>--arrow"></div>
                <div class="pagenation--dots flex-slider<?php echo  $cat_cnt; ?>--dot"></div>
              </div>
              <?php $cat_cnt++; ?>
            </div>
        <?php
            $cnt++;
          endwhile;
        endif;
        ?>
      </div>
    </div>



    <?php //if( is_category() ) : 
    ?>
    <div class="btn__wrap btn__red">
      <a href="/brand-tokei/result/">ブランド時計買取実績一覧はこちら</a>
    </div>
    <?php //endif; 
    ?>

  </section>
<?php endif; ?>
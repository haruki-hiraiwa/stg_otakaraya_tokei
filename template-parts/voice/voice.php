<?php

$aaa = get_queried_object();
// echo "<pre>";
// var_dump($aaa);
// echo "</pre>";

if (is_front_page()) {
  $paged_id = get_queried_object()->ID;
} elseif (is_category()) {
  $cat_id = get_queried_object()->cat_ID;
  $paged_id = 'category_' . $cat_id;
} elseif (is_singular('post')) {
  $paged_id = get_queried_object()->ID;
} elseif (is_singular('shop')) {
  $paged_id = get_queried_object()->ID;
} else {
  // echo "else";

  // echo "<pre>";
  // var_dump($cate);
  // echo "</pre>";

}

if (!empty(get_field('customer_reviews_headline', $paged_id)) || have_rows('customer_reviews', $paged_id)) :
?>
  <section class="margin_top">
    <?php
    if (!empty(get_field('customer_reviews_headline', $paged_id))) :
    ?>
      <div class="titleMain titleMain--wrapper">

        <h2 class="titleMain--main">
          <?php
          echo get_field('customer_reviews_headline', $paged_id);
          ?>
        </h2>
        <h3 class="titleMain--lead">
          <?php
          //echo get_field('customer_reviews_lead_text', $paged_id); 
          ?></h3>
      </div>
    <?php
    endif;

    if (have_rows('customer_reviews', $paged_id)) :
    ?>
      <div class="voicelist js__more--2th">

        <?php
        $num_all = 0;
        while (have_rows('customer_reviews', $paged_id)) : the_row();

          $rating_tmp = get_sub_field('customer_reviews_rating');
          if ($rating_tmp == '★') {
            $rating = '<span>★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
          } elseif ($rating_tmp == '★★') {
            $rating = '<span>★</span><span>★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
          } elseif ($rating_tmp == '★★★') {
            $rating = '<span>★</span><span>★</span><span>★</span><span class="star--white">★</span><span class="star--white">★</span>';
          } elseif ($rating_tmp == '★★★★') {
            $rating = '<span>★</span><span>★</span><span>★</span><span>★</span><span class="star--white">★</span>';
          } elseif ($rating_tmp == '★★★★★') {
            $rating = '<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>';
          } else {
            $rating = '<span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
          }

          $uname_tmp = get_sub_field('customer_reviews_name');
          if (!empty($uname_tmp)) {
            $uname = $uname_tmp . '様';
          } else {
            $uname = '';
          }

          $sex_tmp = get_sub_field('customer_reviews_sex');
          if ($sex_tmp == '不明') {
            $sex = "";
          } else {
            $sex = $sex_tmp;
          }
        ?>

          <div class="voicelist__article js__more--item2">
            <div class="voicelist__header">
              <p class="voicelist__header--name"><?php the_sub_field('customer_reviews_pref'); ?>　<?php the_sub_field('customer_reviews_city'); ?>　<?php echo $uname; ?>　<?php echo $sex; ?></p>
              <p class="voicelist__header--title"><?php the_sub_field('customer_reviews_title'); ?></p>
              <div>
                <p class="voicelist__header--star"><?php echo $rating; ?></p>
                <p class="voicelist__header--date"><?php the_sub_field('customer_reviews_date'); ?></p>
              </div>
            </div>
            <div class="voicelist--text">
              <p><?php echo nl2br(get_sub_field('customer_reviews_voice')); ?></p>
            </div>
          </div>

        <?php
          $num_all++;
        endwhile;
        ?>
      </div>

      <?php
      if ($num_all >= 3) : ?>
        <div class="btn__wrap btn__more js__more--btn2">
          <span>お客様の口コミをもっと見る</span>
        </div>
    <?php
      endif;
    endif;
    ?>

  </section>
<?php
endif;
?>
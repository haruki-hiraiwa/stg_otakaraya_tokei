<?php
$kind_name = '';
if (is_home()) {
  // echo "home";
} elseif (is_category()) {
  // echo "cateegory";
  $kind_name = str_replace('買取', '', get_queried_object()->name);
  // $post_id = 'category_'.$kind_name;
} else {
  // echo "else";

  // echo "<pre>";
  // var_dump($cate);
  // echo "</pre>";
  $kind_name = str_replace('買取', '', get_the_title());
}

if (empty($kind_name)) {
  $kind_name = get_bloginfo('name');
}

?>
<section>
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">
      <?php
      echo get_field('customer_reviews_repeat_headline', 19608)

      ?>
    </h2>
    <h3 class="titleMain--lead"><?php echo get_field('customer_reviews_repeat_lead_text', 19608) ?></h3>
  </div>
  <div class="voicelist js__more--2th">

    <?php
    $args = array(
      'posts_per_page' => -1, // 表示する投稿数
      'post_type' => array('voice'), // 取得する投稿タイプのスラッグ
      'orderby' => 'date', //日付で並び替え
      'order' => 'DESC' // 降順 or 昇順
    );
    $voice_posts = get_posts($args);
    $num_all = 0;

    foreach ($voice_posts as $post) : setup_postdata($post);

      $rating_tmp = get_field('customer_reviews_repeat_rating');
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

      $voice_data = str_replace('[kind-name]', $kind_name, get_the_content());
      // echo "voice_data =".$voice_data."<BR>";

    ?>

      <div class="voicelist__article js__more--item2">
        <div class="voicelist__header">
          <p class="voicelist__header--name"><?php the_field('customer_reviews_repeat_pref') ?> <?php the_field('customer_reviews_repeat_city') ?> <?php the_field('customer_reviews_repeat_name') ?>様 <?php the_field('customer_reviews_repeat_sex') ?></p>
          <p class="voicelist__header--title"><?php echo get_the_title($post->ID); ?></p>
          <div>
            <p class="voicelist__header--star"><?php echo $rating; ?></p>
            <p class="voicelist__header--date"><?php the_field('customer_reviews_repeat_date') ?></p>
          </div>
        </div>
        <div class="voicelist--text">
          <p><?php echo nl2br($voice_data); ?></p>
        </div>
      </div>

    <?php
      $num_all++;
    endforeach;
    ?>
    <?php wp_reset_postdata(); ?>

  </div>

  <?php if ($num_all >= 2) : ?>
    <div class="btn__wrap btn__more js__more--btn2">
      <span>お客様の口コミをもっと見る</span>
    </div>
  <?php endif; ?>


</section>
<?php
$kind_name = '';
$url = home_url( add_query_arg( array(), $wp->request ) );
$slug = basename( untrailingslashit( $url ) );

if (is_category()) {
  //$kind_name = str_replace('買取', '', get_queried_object()->name);
  $cat_id = get_queried_object()->cat_ID;
  $current_post_id = 'category_' . $cat_id;
  $kind_name = get_field('tokei_category_name', $current_post_id);
  if (empty($kind_name))
    $kind_name = get_field('brand_ruby', $current_post_id); //カテゴリー名

  $kind_name = $kind_name . "時計";
} elseif (is_single()) {
  $category = get_the_category();
  $cat = $category[0];
  $cat_id = $cat->cat_ID;
  $parent_id = 'category_' . $cat_id;

  $cat_name = get_field('tokei_category_name', $parent_id); //カテゴリー名
  //カテゴリー名称に何も入力されていなければカタカナ名を取得
  if (empty($cat_name))
    $cat_name = get_field('brand_ruby', $parent_id); //カテゴリー名

  $item_name =  $cat_name . " " . "<br class=is-sp>" . get_post_field('tokei_item_name', $current_post_id); //モデル名称
  if(empty($cat_name))
    $kind_name = 'ブランド時計';
} elseif (is_singular('shop')) {
  $kind_name = 'ブランド時計';
} elseif (is_home() || is_front_page()) {
  $kind_name = 'ブランド時計';
} else {
  $kind_name = str_replace('買取', '', get_the_title());
}

if (empty($kind_name)) {
  $kind_name = 'ブランド時計';
}

?>

<section class="margin_top">
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">

      <?php
      //ブランド時計の買取に関するよくある質問

      //echo get_field('faq_headline', 19083);
      if (is_single()){
        // echo $brand_name . $model_name . "<br>買取の<span>よくある質問</span>";
        echo $item_name. "買取の<br><span>よくある質問</span>";
      }else{
        echo $kind_name . "の<br>買取に関する<span>よくある質問</span>";
      }
      ?>
    </h2>
    <div class="titleMain--lead">
      <p><?php echo get_field('faq_lead_text', 19083); ?></p>
    </div>
  </div>

  <div class="qa__wrap js__more--3th">
    <!-- もっと見るなし -->

    <?php
    if (is_home() || is_front_page()) :
      $target_term = 'page-top';
    elseif (is_category()) :
      $target_term = 'page-brand';
    elseif (is_singular('post')) :
      $target_term = 'page-model';
    elseif (is_singular('shop')) :
      $target_term = 'page-shop';
    endif;

    // echo "target_term = ".$target_term."<BR>";

    $args = array(
      'post_type' => 'faq',
      'posts_per_page' => 30,
      'order' => 'ASC',
      'orderby' => 'menu_order', // 管理画面(よくある質問一覧)の表示順
      'post_status' => 'publish', // 非公開の投稿を除外する
      'tax_query' => array(
        'relation' => 'OR',
        array(
          'taxonomy' => 'view_cat',
          'terms' => array($target_term),
          'field' => 'slug'
        ),
        array(
          'taxonomy' => 'faq_show_tag',
          'terms' => $slug,
          'field' => 'slug'
        ),
      ),
    );

    $query = new WP_Query($args);
    $num_all = $query->found_posts;
    ?>
    <?php
    /* （ステップ2）データの表示 */
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
        $question = str_replace('[kind-name]', strip_tags($kind_name), get_the_title());
        // $question = 'aaa';
    ?>
        <div class="qa__list js__more--item3">
          <dl class="qa__list__inner">
            <dt class="qa__list__q"><?php echo $question; ?></dt>

            <?php

            $answer = nl2br(str_replace('[kind-name]', strip_tags($kind_name), the_field_without_wpautop('faq_answer')));

            if (substr_count($answer, "<br>") > 0) :
            ?>
              <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
              <div class="qa__list__button"><button>もっと見る</button></div>
            <?php
            elseif (substr_count($answer, "\n") > 0) :
            ?>
              <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
              <div class="qa__list__button"><button>もっと見る</button></div>
            <?php
            elseif (substr_count($answer, "\r\n") > 0) :
            ?>
              <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
              <div class="qa__list__button"><button>もっと見る</button></div>
              <?php
            // echo "c = ".strstr($answer, "\r\n")."<br>";
            else :
              if (mb_strlen(get_the_content(), 'UTF-8') > 100) :
              ?>
                <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              <?php else : ?>
                <dd class="qa__list__a"><?php echo $answer; ?></dd>
              <?php endif; ?>
            <?php endif; ?>



          </dl>
        </div>

      <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata(); ?>


  </div>
  <?php if ($num_all >= 4) : ?>
    <div class="btn__wrap btn__more js__more--btn3">
      <span>よくある質問をもっと見る</span>
    </div>
  <?php endif; ?>
  <?php
  $json_ld = get_faq_json_ld();
  echo $json_ld;
  ?>
</section>
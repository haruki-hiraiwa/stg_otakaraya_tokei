<?php
global $post_id;
// global $terms;

if (empty($post_id)) :
  the_post();
  $post_id = $post->ID;

  if ($terms) :
    foreach ($terms as $term) {
      if ($term->parent == 0) {
        $term_parent_slug = $term->slug;
        $term_parent_id = $term->term_id;
      }
    }

  endif;

  $post_cat_info = get_term_by('slug', $term_parent_slug, 'category');

  $post_id = 'category_' . $post_cat_info->term_id;

else :
  if (is_singular('result')) :
    $post_terms = get_the_terms($post_id, 'result_cat');

    foreach ($post_terms as $post_term) {
      if ($post_term->parent == 0) {
        $cat_slug = $post_term->slug;
      }
    }
  else :
    $cat = get_the_category()[0];
    $cat_slug = $cat->slug;
  endif;
endif;

if (!empty($cat_slug)) :
?>
  <section class="purchase_model_section">

    <?php
    if (!empty(get_field('purchase_target_model_headline', $post_id))) :
    ?>
      <div class="titleMain titleMain--wrapper">
        <h2 class="titleMain--main">
          <?php the_field('purchase_target_model_headline', $post_id); ?>
        </h2>
        <div class="titleMain--lead">
          <p><?php the_field('purchase_target_model_lead_text', $post_id); ?></p>
        </div>
      </div>
    <?php
    endif;
    ?>

    <div class="colBox colBox__col04 sp__col03">
      <?php
      $ordered_post_ids = array(8363, 8237, 8224, 9809, 8280, 8273, 15633, 8444, 8459, 8275, 8443, 8238, 8236, 9815, 8235, 8461, 8462, 8277, 8276, 9037, 8463, 9040, 8462, 9053, 9057, 9059, 9055, 9061, 9489, 9492, 9515, 9543, 9398, 9482, 9550, 9475, 9497, 9526, 9332, 9292, 9504, 9520, 9392, 9395, 9524, 9513, 9522, 9451, 9507, 9453, 9487, 9555, 9311, 9535, 9317, 9444, 9462, 9315, 9537, 9289, 9455, 9556, 9404);  // ここで投稿IDの順序を指定

      // 指定したIDの順序で投稿を取得
      $args_ordered = array(
        'post_type' => 'post',
        'category_name' => $cat_slug,
        'post_status' => 'publish',
        'post__in' => $ordered_post_ids,
        'orderby' => 'post__in',
        'posts_per_page' => -1
      );
      $ordered_query = new WP_Query($args_ordered);

      // 指定されていない投稿も取得
      $args_unspecified = array(
        'post_type' => 'post',
        'category_name' => $cat_slug,
        'post_status' => 'publish',
        'post__not_in' => $ordered_post_ids,
        'posts_per_page' => -1
      );
      $unspecified_query = new WP_Query($args_unspecified);

      // 両方のクエリを結合
      $all_posts = array_merge($ordered_query->posts, $unspecified_query->posts);


      foreach ($all_posts as $post) :
        setup_postdata($post);
      ?>
        <div class="col purchase_model">
          <a href="<?php echo get_permalink(); ?>" class="img__link">
            <div class="img">

              <?php if (get_field('model_img')) :


                //※altテキストは空白以降の文字列が消える
                $stringsToRemove = array(" ", "・"); //空白を削除
                $outputString = str_replace($stringsToRemove, '', the_title('', '', false));

              ?>
                <img src="<?php the_field('model_img'); ?>" alt="<?php echo $outputString ?>">
              <?php else : ?>
                <img src="https://placehold.jp/176x176.png" alt="">
              <?php endif; ?>
            </div>
            <p class="text text--center">
              <?php echo the_title('', '', false); ?>
            </p>
          </a>
        </div>
      <?php
      endforeach;

      wp_reset_postdata();
      ?>


    </div>

  </section>
  <script>
    $(function() {
      if (!$('.purchase_model').length) {

        $('.purchase_model_section').css('display', 'none');

      }
    });
  </script>
<?php endif; ?>
<!-- model_img：モデル画像を取得 -->
<?php

if (is_category()) {
    $cat_id = get_queried_object()->cat_ID;
    $post_id = 'category_' . $cat_id;
  } else {
    $post_id = get_the_ID();
  }

//モデル画像を取得
$model_image = get_field('model_img');

// ブランド名称とモデル名称を取得し連結する
$category = get_the_category();
$cat = $category[0];
$cat_id = $cat->cat_ID;
$parent_id = 'category_' . $cat_id;
$brand_name = get_field('tokei_category_name', $parent_id); //カテゴリー名
//カテゴリー名称に何も入力されていなければカタカナ名を取得
if (empty($brand_name))
    $brand_name = get_field('brand_ruby', $parent_id); //カテゴリー名
$model_name = get_post_field('tokei_item_name', $current_post_id); // モデル名称
$item_name =  $brand_name . " " . "<br class=is-sp>" . $model_name;
if(empty($brand_name) && empty($model_name))
    $item_name = 'ブランド時計';


// ーーーーーpurchase_target_model.phpより引用ーーーーーー
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
// ーーーーーpurchase_target_model.phpより引用ーーーーーー



?>


<div class="contentsBox02_201901">
    <!-- ブランドに紐づくモデルを全て取得し、whileで回す。 -->
    <!-- ------買取対象モデルより引用 -->
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
      <!-- 買取対象モデルより引用------- -->
    <h3 class="simple-base-accordion-slow active">
        <?php the_sub_field('purchase_achieve_model_repeat_name', $post_id); ?>
        <span class="icon_plus_base"></span>
    </h3>
    <!-- h3タブでactiveであればdispay:block,なければdisplay:none -->
    <div class="purchase-price" style="display:block;">
      <div class="purchase-items rolexmodel-price with-more-btn">
        <table class="table-three">
          <tbody>
            <tr>
              <th colspan="2">商品名</th>
              <th>買取価格相場</th>
            </tr>
            <?php 
            if(have_rows('purchase_achieve_model_repeat', $post_id)):
              $cat_cnt = 1;
              while(have_rows('purchase_achieve_model_repeat', $post_id)) : the_row();
                $term = get_sub_field('purchase_achieve_model_repeat_category');
            ?>
            <tr>
              <td class="item_image image-three">
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
              </td>
              <td class="name-three">
                <a href="https://nanboya.com/tokei-kaitori/price-list/audemarspiguet/royal-oak/15202or-oo-1240or-01/"href="https://nanboya.com/tokei-kaitori/price-list/audemarspiguet/royal-oak/15202or-oo-1240or-01/">
                  <b><?php echo $item_name; ?></b>
                  <br>15202OR.OO.1240OR.01 ピンクゴールド ブルー文字盤 ブティック限定
                </a>
              </td>
              <td class="price td-three-price">
                <div class="td-three-price" data-price-n="1124.2" data-price-a="1050.7">
                  <p class="p-three">未使用品<br>
                    <span class="rank-price">11,242,000</span>
                    <span>円</span>
                  </p>
                  <p class="p-three">中古品<br>
                    <span class="rank-price">10,507,000</span>
                    <span>円</span>
                  </p>
                </div>
              </td>
            </tr>
            <?php 
              endwhile;
            endif;
            ?>

          </tbody>

        </table>

      </div>

    </div>
    <?php 
    endforeach;
    wp_reset_postdata();
    ?>
</div>



<style>
    .contentsBox02_201901 {
    margin-bottom: 40px !important;
    /* max-width: 640px; */
    overflow: hidden;
}

.icon_plus_base{
    color: #444;
    background: none;
    width: 39px;
    height: 39px;
    text-align: center;
    line-height: 45px;
    position: absolute;
    right: 18px;
    font-weight: bold;
    font-size: 45px;
}

.contentsBox02_201901 h3{
    background: #eaeaea;
    box-shadow: -1px 1px 0 #e2e1e2;
    padding: 14px 0 12px 20px;
    position: relative;
    line-height: 1.4;
    margin-bottom: 1px;
    border-bottom: 1px solid #a9a6a7;
}

.contentsBox02_201901 .icon_plus_base {
    color: #444;
    background: none;
    width: 39px;
    height: 39px;
    text-align: center;
    line-height: 45px;
    position: absolute;
    right: 18px;
    font-weight: bold;
    font-size: 45px;
}

.contentsBox02_201901 .icon_plus_base:before {
    content: "";
    background-color: #444;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 0.05em;
    height: 0.5em;
}


.contentsBox02_201901 .icon_plus_base:after {
    content: "";
    background-color: #444;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 0.5em;
    height: 0.045em;
}

.contentsBox02_201901 .purchase-price {
    margin-bottom: 40px;
}

.purchase-price {
    position: relative;
}

.table-three {
    border-top: 1px solid #c9c9c9 !important;
}

tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}

tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}

.contentsBox02_201901 .purchase-price .purchase-items table th {
    text-align: center;
    background: none;
    border: none;
    border-bottom: 1px solid #c9c9c9;
    box-shadow: 0 -1px 0 #fff inset;
    padding: 9px 0;
}

.contentsBox02_201901 .purchase-price .purchase-items table td.item_image {
    width: 152px;
    padding: 8px 5px 8px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0);
}

.contentsBox02_201901 .purchase-price .purchase-items table td {
    padding: 10px 5px;
    font-size: 22px;
    line-height: 30px;
    border: none;
    border-bottom: 1px solid #c9c9c9;
}

.table-three .name-three {
    text-align: left;
}

.table-three .name-three a {
    color: #333;
    text-decoration: underline;
}

.td-three-price {
    text-align: center !important;
    font-size: 12px !important;
    font-weight: bold !important;
    padding: 10px 0 8px 10px !important;
}

.p-three {
    text-align: center;
    margin: 0 5px 10px 0 !important;
}

.contentsBox02_201901 .purchase-price .purchase-items table td.item_image img {
    width: 147px;
}

.contentsBox02_201901 .purchase-price .purchase-items table td.item_image img {
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 137px;
    margin-left: 0;
}

.image-three {
    border-bottom: 1px solid #c9c9c9 !important;
}
</style>
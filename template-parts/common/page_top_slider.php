<?php
if (is_category()) {
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
} else {
  $post_id = get_the_ID();
}
// WordPressのインストールディレクトリ名を取得
$directory_name = basename(get_bloginfo('url'));
$campaign_banner_onoff = get_field('campaign_banner_onoff', $post_id);

// ACFフィールドから値を取得
$selected_slug = get_field('switch_repeat_list', $post_id);

// JSONデータを取得
$json_data = file_get_contents(ABSPATH . '../posts-json/campaign_banner_data.json');
$data = json_decode($json_data, true);

// 選択されたデータを取得
$selected_data = array_filter($data, function ($item) use ($selected_slug) {
  return $item['slug'] === $selected_slug;
});

$current_date = date_i18n('Y-m-d H:i:s');

// 選択されたデータを使用
if (!empty($selected_data) && $campaign_banner_onoff) {
  $selected_data = array_shift($selected_data); // 最初のマッチを取得

  // 現在の日時を取得
  $current_datetime = current_time('Y/m/d g:i a');

  // ディレクトリ名に基づいて、使用するデータを選択。


  $repeat_key = 'switch_repeat_brand_tokei';
  $image_key = 'switch_image_brand_tokei_url';
  $image_sp_key = 'switch_image_brand_tokei_url_sp';
  $day_key = 'switch_date_brand_tokei';
  $link_key = 'switch_image_brand_tokei_link';



  // 初期画像URLを設定
  $image_url = '';
  $image_url_sp = '';
  $image_link = '';

  // 選択されたデータセット内の各エントリーをチェック
  foreach ($selected_data[$repeat_key] as $entry) {
    // エントリーの日時が現在の日時と一致するか、または過去であるかチェック
    if (strtotime($entry[$day_key]) <= strtotime($current_datetime)) {
      // 日時が一致する場合、画像URLを更新
      $image_url = $entry[$image_key];
      $image_url_sp = $entry[$image_sp_key];
      $image_link = $entry[$link_key];
      // 一致した場合はループを抜ける
      break;
    }
  }
}

$page_top_slider_repeat = get_field('page_top_slider_repeat', $post_id);
$repeat_cnt = count($page_top_slider_repeat);

$slider2 = false;
//特定の店舗だけ別のキャンペーンを表示
if (have_rows('shop_page_slider2', 21104)) :
  $currentSlug = get_post_field('post_name', get_post());
  while (have_rows('shop_page_slider2', 21104)) : the_row();
    $shop_page_slider2_start_time =   get_sub_field('shop_page_slider2_start_time');
    $shop_page_slider2_end_time =    get_sub_field('shop_page_slider2_end_time');
    $str = get_sub_field('shop_page_slider2_apply_list', 21104);
    $locationsArray = array_map('trim', explode("\n", $str));

    if (in_array($currentSlug, $locationsArray) && is_singular('shop')) {
      if ($current_date >= $shop_page_slider2_start_time && $current_date <= $shop_page_slider2_end_time) {
        $pc_image = get_sub_field('shop_page_slider2_pc', 21104);
        if (!empty($pc_image))
          $slider_img_campaing = $pc_image['url'];
        $sp_image = get_sub_field('shop_page_slider2_sp', 21104);
        if (!empty($sp_image))
          $slider_img_campaing_sp = $sp_image['url'];
        $slider2 = true;
        break;
      }
    }
  endwhile;
endif;


if (is_front_page()) :
  $second_image = get_field('second_image', 21104);
  $second_image_sp = get_field('second_imagesp', 21104);
  $second_image_link = get_field('second_image_link', 21104);
  $third_image = get_field('third_image', 21104);
  $third_image_sp = get_field('third_imagesp', 21104);
  $third_image_link = get_field('third_image_link', 21104);
  $fourth_image = get_field('fourth_image', 21104);
  $fourth_image_sp = get_field('fourth_imagesp', 21104);
  $fourth_image_link = get_field('fourth_image_link', 21104);
elseif (is_category()) :
  $second_image = get_field('second_image_brand', 21104);
  $second_image_sp = get_field('second_imagesp_brand', 21104);
  $second_image_link = get_field('second_image_link_brand', 21104);
  $third_image = get_field('third_image_brand', 21104);
  $third_image_sp = get_field('third_imagesp_brand', 21104);
  $third_image_link = get_field('third_image_link_brand', 21104);
  $fourth_image = get_field('fourth_image_brand', 21104);
  $fourth_image_sp = get_field('fourth_imagesp_brand', 21104);
  $fourth_image_link = get_field('fourth_image_link_brand', 21104);
elseif (is_singular('post')) :
  $second_image = get_field('second_image_model', 21104);
  $second_image_sp = get_field('second_imagesp_model', 21104);
  $second_image_link = get_field('second_image_link_model', 21104);
  $third_image = get_field('third_image_model', 21104);
  $third_image_sp = get_field('third_imagesp_model', 21104);
  $third_image_link = get_field('third_image_link_model', 21104);
  $fourth_image = get_field('fourth_image_model', 21104);
  $fourth_image_sp = get_field('fourth_imagesp_model', 21104);
  $fourth_image_link = get_field('fourth_image_link_model', 21104);
elseif (is_singular('shop')) :
  $second_image = get_field('second_image_shop', 21104);
  $second_image_sp = get_field('second_imagesp_shop', 21104);
  $second_image_link = get_field('second_image_link_shop', 21104);
//$third_image = get_field('third_image_shop', 21104);
//$third_image_sp = get_field('third_imagesp_shop', 21104);
//$third_image_link = get_field('third_image_link_shop', 21104);
//$fourth_image = get_field('fourth_image_shop', 21104);
//$fourth_image_sp = get_field('fourth_imagesp_shop', 21104);
//$fourth_image_link = get_field('fourth_image_link_shop', 21104);

endif;

if ($repeat_cnt >= 1) : ?>
  <div class="slide__wrap01">
    <div id="slide01" class="slide__inner">
      <?php

      $count = 1;

      while ($count <= 4) :

        $slider_img = '';
        $slider_img_sp = '';
        $slider_link = '';

        switch ($count) {
          case 1:
            if (empty($page_top_slider_repeat[0]['page_top_slider_img']) && !empty($second_image['url'])) {
              $slider_img = $second_image['url'];
              $slider_img_sp = $second_image_sp['url'];
              $slider_link = $second_image_link;
            } elseif (!empty($page_top_slider_repeat[0]['page_top_slider_img'])) {
              $slider_img = $page_top_slider_repeat[0]['page_top_slider_img'];
              $slider_img_sp = $page_top_slider_repeat[0]['page_top_slider_img_sp_2'];
              $slider_link = $page_top_slider_repeat[0]['page_top_slider_link'];
            }
            break;

          case 2:
            if (!empty($image_url)) {
              $slider_img = $image_url;
              $slider_img_sp = $image_url_sp;
              $slider_link = $image_link;
            } elseif (!empty($second_image)) {
              $slider_img = $second_image['url'];
              $slider_img_sp = $second_image_sp['url'];
              $slider_link = $second_image_link;
            } else {
              $slider_img = $page_top_slider_repeat[1]['page_top_slider_img'];
              $slider_img_sp = $page_top_slider_repeat[1]['page_top_slider_img_sp_2'];
              $slider_link = $page_top_slider_repeat[1]['page_top_slider_link'];
            }

            //特定の店舗のみ上書き
            if ($slider2) {
              $slider_img = $slider_img_campaing;
              $slider_img_sp = $slider_img_campaing_sp;
              $slider_link = '';
            }
            break;

          case 3:
            if (!empty($third_image)) {
              $slider_img = $third_image['url'];
              $slider_img_sp = $third_image_sp['url'];
              $slider_link = $third_image_link;
            } else {
              $index = $second_image ? $count - 2 : $count - 1;
              $slider_img = $page_top_slider_repeat[$index]['page_top_slider_img'];
              $slider_img_sp = $page_top_slider_repeat[$index]['page_top_slider_img_sp_2'];
              $slider_link = $page_top_slider_repeat[$index]['page_top_slider_link'];
            }
            break;

          case 4:
            if (!empty($fourth_image)) {
              $slider_img = $fourth_image['url'];
              $slider_img_sp = $fourth_image_sp['url'];
              $slider_link = $fourth_image_link;
            } else {
              if ($third_image) {
                $index = $count - 3;
              } elseif ($second_image) {
                $index = $count - 2;
              } else {
                $index = $count - 1;
              }
              $slider_img = $page_top_slider_repeat[$index]['page_top_slider_img'];
              $slider_img_sp = $page_top_slider_repeat[$index]['page_top_slider_img_sp_2'];
              $slider_link = $page_top_slider_repeat[$index]['page_top_slider_link'];
            }

            //スライダー４枚目の画像を差し替え
            if (is_singular('shop')) {
              $pc_image = get_field('shop_page_slider_pc', 21104);
              if (!empty($pc_image))
                $slider_img = $pc_image['url'];;
              $sp_image = get_field('shop_page_slider_sp', 21104);
              if (!empty($sp_image))
                $slider_img_sp = $sp_image['url'];
            }
            break;
        }

      ?>
        <?php if (!empty($slider_img)) : ?>
          <?php if (!empty($slider_link)) : ?>
            <a href="<?php echo esc_url($slider_link); ?>">
            <?php endif; ?>
            <div class="slide__item">
              <p class="is-pc"><img src="<?php echo esc_url($slider_img); ?>" alt="<?php
                                                                                    $image_id_pc = attachment_url_to_postid($slider_img);
                                                                                    echo get_post_meta($image_id_pc, '_wp_attachment_image_alt', true);
                                                                                    ?>"></p>
              <p class="is-sp"><img src="<?php echo esc_url($slider_img_sp); ?>" alt="<?php
                                                                                      $image_id_sp = attachment_url_to_postid($slider_img);
                                                                                      echo get_post_meta($image_id_sp, '_wp_attachment_image_alt', true);
                                                                                      ?>"></p>
            </div>
            <?php if (!empty($slider_link)) : ?>
            </a>
          <?php endif; ?>
        <?php endif; ?>

      <?php
        $count++;
      endwhile;
      ?>
    </div>

    <?php if ($repeat_cnt >= 1) : ?>
      <div id="thumbs01" class="slide__thumbs">
        <?php
        $page_top_slider_repeat = get_field('page_top_slider_repeat', $post_id);
        $repeat_cnt = count($page_top_slider_repeat);

        $count = 1;

        while ($count <= 4) :

          $slider_img = '';
          $slider_img_sp = '';
          $slider_link = '';

          switch ($count) {
            case 1:
              if (empty($page_top_slider_repeat[0]['page_top_slider_img']) && !empty($second_image['url'])) {
                $slider_img = $second_image['url'];
                $slider_img_sp = $second_image_sp['url'];
                $slider_link = $second_image_link;
              } elseif (!empty($page_top_slider_repeat[0]['page_top_slider_img'])) {
                $slider_img = $page_top_slider_repeat[0]['page_top_slider_img'];
                $slider_img_sp = $page_top_slider_repeat[0]['page_top_slider_img_sp_2'];
                $slider_link = $page_top_slider_repeat[0]['page_top_slider_link'];
              }
              break;

            case 2:
              if (!empty($image_url)) {
                $slider_img = $image_url;
                $slider_img_sp = $image_url_sp;
              } elseif (!empty($second_image)) {
                $slider_img = $second_image['url'];
                $slider_img_sp = $second_image_sp['url'];
                $slider_link = $second_image_link;
              } else {
                $slider_img = $page_top_slider_repeat[1]['page_top_slider_img'];
                $slider_img_sp = $page_top_slider_repeat[1]['page_top_slider_img_sp_2'];
                $slider_link = $page_top_slider_repeat[1]['page_top_slider_link'];
              }

              //特定の店舗のみ上書き
              if ($slider2) {
                $slider_img = $slider_img_campaing;
                $slider_img_sp = $slider_img_campaing_sp;
                $slider_link = '';
              }
              break;

            case 3:
              if (!empty($third_image)) {
                $slider_img = $third_image['url'];
                $slider_img_sp = $third_image_sp['url'];
                $slider_link = $third_image_link;
              } else {
                $index = $second_image ? $count - 2 : $count - 1;
                $slider_img = $page_top_slider_repeat[$index]['page_top_slider_img'];
                $slider_img_sp = $page_top_slider_repeat[$index]['page_top_slider_img_sp_2'];
                $slider_link = $page_top_slider_repeat[$index]['page_top_slider_link'];
              }
              break;

            case 4:
              if (!empty($fourth_image)) {
                $slider_img = $fourth_image['url'];
                $slider_img_sp = $fourth_image_sp['url'];
                $slider_link = $fourth_image_link;
              } else {
                if ($third_image) {
                  $index = $count - 3;
                } elseif ($second_image) {
                  $index = $count - 2;
                } else {
                  $index = $count - 1;
                }
                $slider_img = $page_top_slider_repeat[$index]['page_top_slider_img'];
                $slider_img_sp = $page_top_slider_repeat[$index]['page_top_slider_img_sp_2'];
                $slider_link = $page_top_slider_repeat[$index]['page_top_slider_link'];
              }

              //スライダー４枚目の画像を差し替え
              if (is_singular('shop')) {
                $pc_image = get_field('shop_page_slider_pc', 21104);
                if (!empty($pc_image))
                  $slider_img = $pc_image['url'];;
                $sp_image = get_field('shop_page_slider_sp', 21104);
                if (!empty($sp_image))
                  $slider_img_sp = $sp_image['url'];
              }
              break;
          }
        ?>
          <?php if (!empty($slider_img)) { ?>

            <div class="slide__thumbs--item">
              <p class="is-pc"><img src="<?php echo esc_url($slider_img); ?>" alt="<?php
                                                                                    $image_id_pc = attachment_url_to_postid($slider_img);
                                                                                    echo get_post_meta($image_id_pc, '_wp_attachment_image_alt', true);
                                                                                    ?>"></p>
              <p class="is-sp"><img src="<?php echo esc_url($slider_img_sp); ?>" alt="<?php
                                                                                      $image_id_sp = attachment_url_to_postid($slider_img);
                                                                                      echo get_post_meta($image_id_sp, '_wp_attachment_image_alt', true);
                                                                                      ?>"></p>
            </div>
          <?php } ?>

        <?php
          $count++;
        endwhile;
        ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- クーポン -->
<?php
include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/qr_coupon.php");
?>
<!-- クーポン -->
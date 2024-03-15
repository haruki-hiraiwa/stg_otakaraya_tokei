<section class="column_section">
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">
      <?php
      //echo get_field('column_headline', 20071);

      $column_url =  "https://www.otakaraya.jp/contents/category/brand-watch/";

      // 現在の投稿IDを取得
      if (is_category()) {
        // カテゴリーページの場合
        $cat_id = get_queried_object()->cat_ID;
        $current_post_id = 'category_' . $cat_id;
      } else {
        // それ以外のページ（投稿ページを含む）の場合
        $current_post_id = get_the_ID();
      }

      if (is_category()) {
        $item_name = get_field('tokei_category_name', $current_post_id);
        if (empty($item_name))
          $item_name = get_field('brand_ruby', $current_post_id); //カテゴリー名
        $cat = get_queried_object();
        $cat_slug = $cat->slug;

        if ($cat_slug == "cartier")
          $cat_slug = "cartier-watch";
        $column_tag = $cat_slug;


        $column_text =  $item_name . "買取に関する<br><span>お役立ちコラム</span>";
      } else if (is_single()) {
        $category = get_the_category();
        $cat = $category[0];
        $cat_id = $cat->cat_ID;
        $parent_id = 'category_' . $cat_id;

        $cat_name = get_field('tokei_category_name', $parent_id); //カテゴリー名

        //カテゴリー名称に何も入力されていなければカタカナ名を取得
        if (empty($cat_name))
          $cat_name = get_field('brand_ruby', $parent_id); //カテゴリー名

        //echo $cat_name;
        $cat_slug = $cat->slug; //カテゴリーのスラッグ


        if ($cat_slug == "cartier")
          $cat_slug = "cartier-watch";

        $post_slug =  get_post_field('post_name', $current_post_id); //投稿ページのスラッグ

        $item_name =  $cat_name . "<br class=is-sp>" . get_post_field('tokei_item_name', $current_post_id); //モデル名称

        if (empty($item_name)) {
          $item_name = $cat_name;
          $column_tag = $cat_slug;
        } else {
          $column_tag = $post_slug;
        }

        $column_text =  $item_name . "買取に関する<br><span>お役立ちコラム</span>";
      } else {
        $column_text = "ブランド時計に関する<br class=is-sp><span>お役立ちコラム</span>";
      }



      // ACFカスタムフィールドから選択された値を取得
      $selected_values = get_field('column_select', $current_post_id);
      $current_path = $_SERVER['REQUEST_URI'];

      // $selected_valuesが空の場合、デフォルトの値を設定
      if (empty($selected_values)) {
        if (strpos($current_path, '/brand-tokei/') !== false) {
          $selected_values = array('brand-watch');
        } elseif (strpos($current_path, '/gold/') !== false || strpos($current_path, '/platinum/') !== false || strpos($current_path, '/kikinzoku/') !== false) {
          $selected_values = array('gold-platinum');
        } elseif (strpos($current_path, '/daiya/') !== false) {
          $selected_values = array('diamond-jewely');
        } elseif (strpos($current_path, '/brand/') !== false) {
          $selected_values = array('brand');
        } else {
          $selected_values = array();
        }
      }
      //一覧のURL
      if (strpos($current_path, '/brand-tokei/') !== false) {
        $cat_url = 'category/brand-watch';
      } elseif (strpos($current_path, '/gold/') !== false || strpos($current_path, '/platinum/') !== false || strpos($current_path, '/kikinzoku/') !== false) {
        $cat_url = 'category/gold-platinum';
      } elseif (strpos($current_path, '/daiya/') !== false) {
        $cat_url = 'category/diamond-jewely';
      } elseif (strpos($current_path, '/brand/') !== false) {
        $cat_url = 'category/brand';
      } else {
        $cat_url = '';
      }
      $list_url = 'https://www.otakaraya.jp/contents/' . $cat_url;

      // 表示数を取得
      $display_number = get_field('column_display_number', $current_post_id);
      if (!$display_number) {
        $display_number = 4; // デフォルト値を4に設定
      }

      // JSONファイルの読み込み
      $json_data = ABSPATH . '../posts-json/column_posts.json';
      if (!file_exists($json_data)) {
        echo "JSONファイルが存在しません。";
        return;
      }

      // ファイルの内容を取得
      $json_content = file_get_contents($json_data);
      $posts_array = json_decode($json_content, true);
      $total_count = count($posts_array);

      $matching_count = 0;
      $displayed_count = 0;




      if (!empty($item_name)) {

        //カテゴリーの場合
        if (is_category()) {
          $new_link = "https://www.otakaraya.jp/contents/category/brand-watch/" . $cat_slug . "/";

          $get_header = @get_headers($new_link);
          if ($get_header[0] != "HTTP/1.1 404 Not Found")
            $linkChecked = true;

          if ($linkChecked) {
            //カテゴリーに関するコラムの記事をカウント
            $temp_value = array($column_tag);
            foreach ($posts_array as $post_data) {
              foreach ($post_data['categories'] as $category) {
                if (in_array($category['slug'], $temp_value)) {
                  $matching_count++;
                }
              }
            }
            if (1 <= $matching_count) {
              $selected_values = $temp_value;
            }
          }
        } else if (is_single()) {
          if ($item_name != $cat_name) {
            $new_link = "https://www.otakaraya.jp/contents/category/brand-watch/" . $cat_slug . "/" . $post_slug;

            $get_header = @get_headers($new_link);
            if ($get_header[0] != "HTTP/1.1 404 Not Found")
              $linkChecked = true;

            if ($linkChecked) {
              $column_tag = $post_slug;
              $temp_value = array($column_tag);

              foreach ($posts_array as $post_data) {
                foreach ($post_data['categories'] as $category) {
                  if (in_array($category['slug'], $temp_value)) {
                    $matching_count++;
                  }
                }
              }

              if (1 <= $matching_count) {
                $selected_values = $temp_value;
              }
            }
          }



          //リンクがないか、コラムの記事がなければカテゴリーのコラムを表示
          if ($matching_count == 0 || !$linkChecked || $item_name == $cat_name) {
            $new_link = "https://www.otakaraya.jp/contents/category/brand-watch/" . $cat_slug . "/";

            $get_header = @get_headers($new_link);
            if ($get_header[0] != "HTTP/1.1 404 Not Found")
              $linkChecked = true;

            $column_tag = $cat_slug;
            $item_name = $cat_name;
            if ($linkChecked) {
              //カテゴリーに関するコラムの記事をカウント
              $temp_value = array($column_tag);
              foreach ($posts_array as $post_data) {
                foreach ($post_data['categories'] as $category) {
                  if (in_array($category['slug'], $temp_value)) {
                    $matching_count++;
                  }
                }
              }
              if (1 <= $matching_count) {
                $selected_values = $temp_value;
              }
            }
          }
        }
      }

      echo $column_text;

      ?>
    </h2>
    <div class="titleMain--lead">
      <p><?php echo get_field('column_lead_text', 20071); ?></p>
    </div>
  </div>
  <?php

  echo ' <!-- pagenation -->
    <div class="is-sp flex--slide__pagenation">
      <div class="pagenation--arrows columnbox01--arrow"></div>
      <div class="pagenation--dots columnbox01--dot"></div>
    </div>';

  echo '<div class= "columnbox ">';
  echo '<div id="columnbox01" class="columnbox__wrap column_slider_sp">';

  foreach ($posts_array as $post_data) {
    foreach ($post_data['categories'] as $category) {
      if (in_array($category['slug'], $selected_values)) {
        $matching_count++;
      }
    }
  }

  if ($matching_count == 0)
    $selected_values = array('brand-watch');



  foreach ($posts_array as $post_data) {
    foreach ($post_data['categories'] as $category) {
      if (in_array($category['slug'], $selected_values)) {
        $matching_count++;
        if ($displayed_count < $display_number) {
          echo '<div class="col">';
          echo '<div class="img__link">';
          echo '<a href="' . esc_url($post_data['post_url']) . '" class="img__link">';

          echo '<div class="img" style="height: 0; padding-bottom: 66%; position: relative; overflow: hidden;">';
          echo '<p style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; overflow: hidden;">';
          echo '<img style="object-fit: cover; width: 100%; height: 100%;" src="' . esc_url($post_data['thumbnail_url']) . '" alt=" ' .  esc_html($post_data['title'])   . '">';
          echo  '</p>';
          echo '</div>';

          echo '</a>';
          echo '<div class="col--text">';
          echo '<ul class="tag__list">';

          foreach ($post_data['categories'] as $category) {
            echo '<li class="tag__list--item">
            <a href="' . esc_url($category['term_link']) . '"><span>#' . esc_html(str_replace(array('—', ' '), '', $category['name'])) . '</span></a></li>';
          }

          echo '</ul>';
          echo '<dl class="text">';
          echo '<dt class="text--title"><a href="' . esc_url($post_data['post_url']) . '">' . strip_tags($post_data['title']) . '</a></dt>';
          echo '<dd class="text--detail">' . esc_html($post_data['content_trimmed']) . '…</dd>';
          echo '</dl>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $displayed_count++;
        }
        break;
      }
    }

    if ($displayed_count >= $display_number) {
      break;
    }
  }


  echo '</div>';


  //赤いボタン
  echo '<div class="btn__wrap btn__red">';


  if (!empty($item_name)) {
    echo '<a href="' . $new_link . '">  ' . "<center>" . strip_tags($item_name) . "買取に関する<br class=is-sp>お役立ちコラム</center></a>";
  } else
    echo '<a href="' . "https://www.otakaraya.jp/contents/category/brand-watch" . '"><center>ブランド時計の買取に関する<br class="is-sp">お役立ちコラム</center></a>';

  echo '</div>';

  ?>
  <style>
    @media (max-width: 767px) {
      .column_slider_sp {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
      }

      .columnbox__wrap .col {
        width: 100vw;
        max-width: 100vw;
        padding: 0 0.5rem;
        margin: 0;
      }
    }
  </style>
</section>
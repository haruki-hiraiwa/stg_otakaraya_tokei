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
$voice_select = get_field('voice_select', $paged_id);
$shop_voice_select = '';
$current_post = get_post($paged_id);
$current_post_slug = $current_post->post_name;


$current_path = $_SERVER['REQUEST_URI'];
if (empty($voice_select)) {
  if (strpos($current_path, '/brand-tokei/') !== false) {
    $voice_select = array('watch');
    $shop_voice_select = 'brand-tokei';
  } elseif (strpos($current_path, '/gold/') !== false || strpos($current_path, '/platinum/') !== false || strpos($current_path, '/kikinzoku/') !== false) {
    $voice_select = array('metal');
    $shop_voice_select = 'gold';
  } elseif (strpos($current_path, '/daiya/') !== false) {
    $voice_select = array('diamond');
    $shop_voice_select = 'daiya';
  } elseif (strpos($current_path, '/brand/') !== false) {
    $voice_select = array('brand');
    $shop_voice_select = 'brand';
  } elseif (strpos($current_path, '/') !== false) {
    $voice_select = array();
    $shop_voice_select = 'app';
  } else {
    $voice_select = array();
    $shop_voice_select = 'app';
  }
} else {
  if (strpos($current_path, '/brand-tokei/') !== false) {
    $shop_voice_select = 'brand-tokei';
  } elseif (strpos($current_path, '/gold/') !== false || strpos($current_path, '/platinum/') !== false || strpos($current_path, '/kikinzoku/') !== false) {
    $shop_voice_select = 'gold';
  } elseif (strpos($current_path, '/daiya/') !== false) {
    $shop_voice_select = 'daiya';
  } elseif (strpos($current_path, '/brand/') !== false) {
    $shop_voice_select = 'brand';
  } else {
    $shop_voice_select = 'app';
  }
}
// shop_voice.json データの取得
$file_path_shop = ABSPATH . '../posts-json/shop_voice.json';
$shop_voice_data_json = file_get_contents($file_path_shop);
$shop_voice_data = json_decode($shop_voice_data_json, true);
// マッチするレビューがあるかどうかを判断するためのフラグ
$has_matching_reviews = false; // 初期状態は false に設定

foreach ($shop_voice_data as $data) {
  // shop_voice_select のチェック
  if (isset($data['shop_voice_select']) && is_array($data['shop_voice_select'])) {
    foreach ($data['shop_voice_select'] as $category) {
      if ($category['slug'] === $shop_voice_select) {
        // display_destination_store のチェック
        if (isset($data['display_destination_store']) && is_array($data['display_destination_store'])) {
          foreach ($data['display_destination_store'] as $store) {
            if ($store['slug'] === $current_post_slug) {
              // 条件にマッチした場合、フラグを true に設定し、ループから抜ける
              $has_matching_reviews = true;
              break 3; // 3 レベルのネストから抜ける
            }
          }
        }
        // 一致する shop_voice_select が見つかったが、display_destination_store が一致しなかった場合は、
        // 次のデータ項目に進む前に内側のループを抜ける必要がある
        if ($has_matching_reviews) {
          break 2; // この時点でマッチが確認されたので、2 レベルのネストから抜ける
        }
      }
    }
  }
  // 既にマッチした場合は外側のループも抜ける
  if ($has_matching_reviews) {
    break; // マッチが確認されたのでループから抜ける
  }
}

// マッチするレビューがあり、かつcustomer_reviews_headlineが空でない場合にのみセクションを表示
if ($has_matching_reviews) :
?>

  <section class="voice">

    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main"> <?php echo get_field('customer_reviews_headline', $paged_id); ?> </h2>
      <h3 class="titleMain--lead"><?php echo get_field('customer_reviews_lead_text', $paged_id); ?></h3>
    </div>

    <?php



    $voice_display_number = get_field('voice_display_number', $paged_id);
    if (!$voice_display_number) {
      $voice_display_number = 10; // default
    }


    // shop_voice.json 内の customer_reviews 配列を取得

    foreach ($shop_voice_data as $data) {
      // shop_voice_selectのチェック
      $match_shop_voice_select = false;
      if (isset($data['shop_voice_select']) && is_array($data['shop_voice_select'])) {
        foreach ($data['shop_voice_select'] as $category) {
          if ($category['slug'] === $shop_voice_select) {
            $match_shop_voice_select = true;
            break;
          }
        }
      }

      // display_destination_storeのチェック
      $match_display_destination_store = false;
      if (isset($data['display_destination_store']) && is_array($data['display_destination_store'])) {
        foreach ($data['display_destination_store'] as $store) {
          if ($store['slug'] === $current_post_slug) {
            $match_display_destination_store = true;
            break;
          }
        }
      }

      // 条件に合致する場合のみレビューを追加
      if ($match_shop_voice_select && $match_display_destination_store && isset($data['customer_reviews'])) {
        foreach ($data['customer_reviews'] as $review) {
          $shop_customer_reviews[] = [
            'title' => $review['customer_reviews_repeat_title'],
            'pref' => $review['customer_reviews_repeat_pref'],
            'city' => $review['customer_reviews_repeat_city'],
            'name' => $review['customer_reviews_repeat_name'],
            'sex' => $review['customer_reviews_repeat_sex'],
            'rating' => $review['customer_reviews_repeat_rating'],
            'date' => $review['customer_reviews_repeat_date'],
            'content' => $review['customer_reviews_repeat_content'],
            'assessor_content' => $review['customer_reviews_repeat_assessor_content'],

            // 他のデータが必要な場合はここに追加
          ];
        }
      }
    }


    // 既存の voice_posts.json データの取得
    $file_path_voice = ABSPATH . '../posts-json/voice_posts.json';
    $voice_data_voice = json_decode(file_get_contents($file_path_voice), true);
    // $voice_data_voice からフィルタリングを行う
    $filtered_voice_data_voice = [];
    foreach ($voice_data_voice as $voices) {
      $should_display = true;
      if ($voice_select && isset($voices['categories'])) {
        $should_display = false;
        foreach ($voices['categories'] as $category) {
          if (in_array($category['slug'], $voice_select)) {
            $should_display = true;
            break;
          }
        }
      }

      if ($should_display) {
        $filtered_voice_data_voice[] = $voices;
      }
    }

    // $shop_customer_reviews または $filtered_voice_data_voice が null の場合、空の配列を使用
    $shop_customer_reviews = is_array($shop_customer_reviews) ? $shop_customer_reviews : [];
    $filtered_voice_data_voice = is_array($filtered_voice_data_voice) ? $filtered_voice_data_voice : [];
    // 両方のデータを統合
    $voice_data = array_merge($shop_customer_reviews, $filtered_voice_data_voice);
    echo '<div class="voicelist js__more--2th">';
    $count = 0;
    foreach ($voice_data as $voice) {
      if ($count >= $voice_display_number) {
        break;
      }

      /* $should_display = false;

      if ($voice_select) {
        foreach ($voice_data_voice['categories'] as $category) {
          if (in_array($category['slug'], $voice_select)) {
            $should_display = true;
            break;
          }
        }
      } 
      else {
        $should_display = true; // if no checkbox is selected, display all.
      }*/


      if ($voice) {
        // 星の数を出力する
        $star_count = mb_strlen($voice['rating'], 'UTF-8');

        // 星の数を出力するための変換
        $rating_tmp = str_repeat('★', $star_count);
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

        // 日付をフォーマットする
        if (empty($voice['date'])) {
          $formatted_date = date("Y年 m月", strtotime($voice['post_date']));
        } else {
          $formatted_date = date("Y年 m月", strtotime($voice['date']));
        }

        if (!empty($voice['name'])) {
          $voice_name = $voice['name'] . '様';
        } else {
          $voice_name = '';
        }
        if ($voice['sex'] == '不明') {
          $sex = "";
        } else {
          $sex = $voice['sex'];
        }
        echo '<div class="voicelist__article js__more--item2">';
        echo '<div class="voicelist__header">';
        echo '<p class="voicelist__header--name">' . esc_html($voice['pref'] . ' ' . $voice['city'] . ' ' . $voice_name . ' ' . $sex) . '</p>';
        echo '<p class="voicelist__header--title">' . esc_html($voice['title']) . '</p>';
        echo '<div>';
        echo '<p class="voicelist__header--star">' . $rating . '</p>'; // 星の数の表示を反映
        echo '<p class="voicelist__header--date">' . esc_html($formatted_date) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="voicelist--text">';
        echo '<p>' . esc_html($voice['content']) . '</p>';
        echo '</div>';
        if (!empty($voice['assessor_content'])) {
          echo '<div class="assessor_content"><div class="icon_assessor"></div>
              <div class="voicelist__header">';
          echo '<p class="voicelist__header--title">査定員のコメント</p>';
          echo '</div>
                <div class="voicelist--text">
                <p>';
          echo esc_html($voice['assessor_content']);
          echo '</p>
                </div></div>';
        } else {
        }
        echo '</div>';
        $count++;
      }
    }
    echo '</div>';

    ?>
    <div class="btn__wrap btn__more js__more--btn2">
      <span>お客様の口コミをもっと見る</span>
    </div>
    <style>
      .assessor_content {
        position: relative;
      }

      .assessor_content .voicelist__header {
        padding: 0.5rem 0;
        padding-top: 1.5rem;
      }

      .icon_assessor {
        position: absolute;
        left: -50px;
        width: 40px;
        height: 40px;
        background: url(/app/wp-content/themes/otakaraya/assets/img/voice/icn_comment.svg) no-repeat #f2f2f2;
        background-size: 40px;
        margin-top: 1rem;
      }

      @media (min-width: 768px) {
        .icon_assessor {
          width: 40px;
          height: 40px;
          background-size: 40px;
          margin-top: 1rem;
        }
      }

      @media (max-width: 767px) {
        .icon_assessor {
          left: -2rem;
          width: 1.58rem;
          height: 1.58rem;
          background-size: 1.58rem auto;
          margin-top: 1rem;
        }

        .assessor_content .voicelist__header {
          padding: 1rem 0;
          padding-top: 1rem;
        }
      }
    </style>
  </section>
<?php
endif;
?>
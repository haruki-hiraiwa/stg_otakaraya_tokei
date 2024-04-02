<section class="voice" style="margin-bottom:30px;">

    <?php
    // ini_set('display_errors', 1);

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

    $count = 0;
    $max_voice = 5;
    // $voice_display_number = get_field('voice_display_number', $paged_id); // 管理画面から表示させたい口コミ件数を指定
    $headline = str_replace('買取', '', get_the_title()) . "買取を<span><br class=is-sp>ご利用されたお客様の声</span>";


    $file_path = ABSPATH . '../posts-json/voice_posts2.json';
    $voice_data = json_decode(file_get_contents($file_path), true);

    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);
    $path_parts = explode('/', trim($url_parts['path'], '/'));

    // URLのotakaraya.com以後のスラッグを取得
    $slug1 = isset($path_parts[0]) ? $path_parts[0] : '';
    $slug2 = isset($path_parts[1]) ? $path_parts[1] : '';
    $slug3 = isset($path_parts[2]) ? $path_parts[2] : '';
    if (is_page() && $slug1 === 'gold') {
        $page = get_post(get_the_ID());
        $slug3 = $page->post_name;
        $slug2 = 'no-category';
    }
    if (is_page() && $slug1 === 'daiya') {
        $page = get_post(get_the_ID());
        $slug3 = $page->post_name;
        $slug2 = 'no-category';
    }
    if (is_page() && $slug1 === 'brand') {
        $page = get_post(get_the_ID());
        $slug3 = $page->post_name;
        $slug2 = 'no-category';
    }

    $num_slugs = count($path_parts); // urlのスラッグ数

    // echo $slug1;
    // echo $slug2;
    // echo $slug3;
    // echo $num_slugs;

    $filtered_voice = array(); //init
    $filtered_voice1 = array(); //init
    $filtered_voice2 = array(); //init
    $filtered_voice3 = array(); //init

    foreach ($voice_data as $voice) {
        // slugを配列に入れる
        $voice_cats = array(
            'voice_cat1' => array(),
            'voice_cat2' => array(),
            'voice_cat3' => array()
        );

        // 値を代入する
        foreach ($voice['categories'] as $index => $category) {
            switch ($category['taxonomy']) {
                case 'voice_cat1':
                    $voice_cats['voice_cat1'][] = $category['slug'];
                    break;
                case 'voice_cat2':
                    $voice_cats['voice_cat2'][] = $category['slug'];
                    break;
                case 'voice_cat3':
                    $voice_cats['voice_cat3'][] = $category['slug'];
                    break;
            }
        }

        // foreach ($voice_cats as $key => $value) {
        //     if (in_array($slug1, $value) || in_array($slug2, $value) || in_array($slug3, $value)) {
        //         $should_display = true;
        //     }
        // }

        $voice_cat1 = $voice_cats['voice_cat1'];
        $voice_cat2 = $voice_cats['voice_cat2'];
        $voice_cat3 = $voice_cats['voice_cat3'];

        if (
            // $num_slugs == 3 &&
            in_array($slug1, $voice_cat1) &&
            in_array($slug2, $voice_cat2) &&
            in_array($slug3, $voice_cat3)
        ) {
            // brand/hermes/birkin まで一緒だったら表示
            $filtered_voice3[] = $voice;
        }

        // brand/hermes/ トップ
        // filtered_voice[2]
        if (
            // $num_slugs == 2 &&
            in_array('no-category', $voice_cat3) &&
            in_array($slug1, $voice_cat1) &&
            in_array($slug2, $voice_cat2)
        ) {
            if ($slug1 === 'brand' || $slug1 === 'brand-tokei') {
            $filtered_voice2[] = $voice;
            }
        }

        // brand/トップ
        if (
            // $num_slugs == 1 &&
            in_array('no-category', $voice_cat3) &&
            in_array('no-category', $voice_cat2) &&
            in_array($slug1, $voice_cat1)
        ) {
            $filtered_voice1[] = $voice;
        }

        $count++;
    }


    $display_count = 30;

    if (is_single() || is_page()) {
        if (count($filtered_voice3) == 0) {
            if (count($filtered_voice2) == 0) {
                $filtered_voice = $filtered_voice1;
                $display_count = 5;
            } else {
                $filtered_voice = $filtered_voice2;
                $display_count = 5;
            }
        } else {
            $filtered_voice = $filtered_voice3;
        }
    } elseif ($num_slugs === 2) {
        if (count($filtered_voice2) == 0) {
            $filtered_voice = $filtered_voice1;
            $display_count = 5;
        } else {
            $filtered_voice = $filtered_voice2;
        }
    }

    // $display_count = count($filtered_voice) == 0 ? 5 : 30; // 口コミない場合5件ある場合max30件
    $voice_to_display = array_slice($filtered_voice, 0, $display_count); // 表示させる口コミ

    if (!empty($voice_to_display)) {
        echo '<div class="titleMain titleMain--wrapper voice_title">';
        echo '<h2 class="titleMain--main">';
        if(is_category() && $slug1 === 'brand-tokei'){
            $cat_title = single_cat_title('', false);
            echo $cat_title . 'を<span><br = class=is-sp>ご利用のお客様の声</span>';
        } elseif(is_category() && $slug1 === 'brand'){
            $cat_title = single_cat_title('', false);
            echo $cat_title . 'を<span><br = class=is-sp>ご利用されたお客様の声</span>'; 
        }
        elseif($post->post_name === 'daiya'){
            echo 'ダイヤ買取を<span><br class=is-sp>ご利用されたお客様の声</span>';
        } elseif($post->post_name === 'brand'){
            echo 'ブランド買取を<span><br class=is-sp>ご利用されたお客様の声</span>';
        } elseif($post->post_name === 'gold-top'){
            echo 'お客様の<span>口コミ</span>';
        }
        elseif ($headline !== false && !empty($headline) && $post->post_name !== 'brand-tokei') {
            echo $headline;
        } else {
            echo "ブランド時計買取を<span><br class=is-sp>ご利用されたお客様の声</span>";
        }
        echo '</h2>';
        // echo '<h3 class="titleMain--lead">' . get_field('customer_reviews_lead_text', $paged_id) . '</h3>';
        echo '</div>';
        echo '<div class="voicelist js__more--3th">';


        foreach ($voice_to_display as $voice) {
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
            echo '<div class="voicelist__article js__more--item3">';
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
            echo '</div>';
            $count++;
        }

        echo '</div>';

        if (count($voice_to_display) > 5) {
            echo '<div class="btn__wrap btn__more js__more--btn3">';
            echo   '<span>お客様の口コミをもっと見る</span>';
            echo '</div>';
        }
    }

    ?>

</section>
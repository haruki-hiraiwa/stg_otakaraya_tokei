<?php
function display_manager_comment_based_on_directory()
{
    // JSONファイルからデータを読み込む
    $file_path = ABSPATH . '../posts-json/manager_comment.json';
    if (!file_exists($file_path)) {
        return;  // ファイルが存在しない場合は処理を終了
    }

    $json_data = file_get_contents($file_path);
    $comments_data = json_decode($json_data, true);

    // インストールディレクトリ名を取得
    $install_directory = basename(ABSPATH);
    // 現在のページのスラッグを取得
    global $post;
    $current_slug = $post->post_name;
    foreach ($comments_data as $data) {
        $match_terms = $data['display_destination_store_terms'];
        if (in_array($current_slug, $match_terms)) {

    echo '<section id="manager_comment">';
    echo '<div class="titleMain titleMain--wrapper">';
    echo '<h2 class="titleMain--main">おたからや'. get_the_title() .'<br><span>店長からのお知らせ</span></h2>';
    echo '<h3 class="titleMain--lead"></h3>';
    echo '</div>';
    echo '<div class="profile__list">';
    echo '<div class="profile__list--item">';
            $justifyCenterClass = "";
            if (
                empty($data['origin']) ||
                empty($data['favorite_brand']) ||
                empty($data['hobby']) ||
                empty($data['favorite_word'])
            ) {
                $justifyCenterClass = "justify-center";
            }
    echo '<div class="profile__list--person ' . $justifyCenterClass . '">';
    echo '<div class="person--left">';

    
            echo '<p class="img"><img src="' . esc_url($data['thumbnail_url']) . '" alt="' . esc_html($data['manager_name']) . ' 店長"></p>';
            echo '<p class="name">' . esc_html($data['manager_name']) . '<span>店長</span></p>';
            echo '<p class="name--a">' . esc_html($data['manager_name_en']) . '</p>';
            echo '</div>';  // close person--left
            if (
                !empty($data['origin']) ||
                !empty($data['favorite_brand']) ||
                !empty($data['hobby']) ||
                !empty($data['favorite_word'])
            ) {
            echo '<div class="person--right">';
            echo '<table>';
            echo '<tbody>';
            echo '<tr>';
            echo '<th>出身地</th>';
            echo '<td>' . esc_html($data['origin']) . '</td>';
                echo '</tr>';
                    echo '<tr>';
                        echo '<th>好きなブランド</th>';
                            echo '<td>' . esc_html($data['favorite_brand']) . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>趣　味</th>';
                            echo '<td>' . esc_html($data['hobby']) . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<th>好きな言葉</th>';
                        echo '<td>' . esc_html($data['favorite_word']) . '</td>';
                        echo '</tr>';
                echo '</tbody>';
            echo '</table>';
            echo '</div>';
            }
            echo '</div>';
            echo '<div class="profile__list--comment">';
            $Default_message = '<p>高価買取と買取品目の豊富さが特徴の買取専門店おたからや' . get_the_title() . ' です。<br>昔買ったアクセサリーやジュエリー類、ブランド品、時計などもう使わなくなってしまった物を、ぜひ無料査定にお持ちください。<br>その場で現金支払い致します。ブランド品買取はもちろん、全ての商品で専門の査定員が査定し、他店には負けない金額をご提示させていただきます。<br>お客様のご来店を心よりお待ちしております。</p>'; 
            switch ($install_directory) {
                case 'app':
                    if (empty($data['app_comment'])) {
                        $data['app_comment'] = $Default_message;
                    }
                    echo '<p>' . $data['app_comment'] . '</p>';
                    break;
                case 'gold':
                    if (empty($data['gold_comment'])) {
                        $data['gold_comment'] = $Default_message;
                    }
                    echo '<p>' . $data['gold_comment'] . '</p>';
                    break;
                case 'brand-tokei':
                    if (empty($data['brand-tokei_comment'])) {
                        $data['brand-tokei_comment'] = $Default_message;
                    }
                    echo '<p>' . $data['brand-tokei_comment'] . '</p>';
                    break;
                case 'brand':
                    if (empty($data['brand_comment'])) {
                        $data['brand_comment'] = $Default_message;
                    }
                    echo '<p>' . $data['brand_comment'] . '</p>';
                    break;
                case 'daiya':
                    if (empty($data['daiya_comment'])) {
                        $data['daiya_comment'] = $Default_message;
                    }
                    echo '<p>' . $data['daiya_comment'] . '</p>';
                    break;
                default:
                    echo '<p></p>';
            }
            echo '</div>';  // close profile__list--comment
            echo '</div>';  // close profile__list--person
            echo '</div>';  // close profile__list--item
            echo '</div>';  // close profile__list
            echo '</section>';

            // 一致するものが見つかったら、ループを終了
            break;
        }
    }
}

 display_manager_comment_based_on_directory();
  ?>

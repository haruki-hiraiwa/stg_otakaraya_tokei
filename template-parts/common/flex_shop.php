<?php
ini_set('display_error', "On");
$post_id = get_queried_object();
$slug = get_post(get_the_ID())->post_name;
$page_id = get_the_ID();

$file_path = ABSPATH . '../posts-json/purchase_result_posts.json';
if (!file_exists($file_path)) {
    echo 'fileが見つかりませんでした。';
    return;  // ファイルが存在しない場合は処理を終了
}
$purchase_result_data = json_decode(file_get_contents($file_path), true);

// カテゴリに紐づく実績が存在するか各カテゴリでチェック
$total_post_count = 0;
$max_display = 12;
// voice_tarm_slug：カテゴリ分け用、store_term_slug：店舗分け用

$post_count = 0;
foreach($purchase_result_data as $category):
  $image_url = $category['image'];
  if((in_array('brand-tokei', $category['voice_tarm_slug'])) && (in_array($slug, $category['store_term_slug']))){
    $post_count++;
  }
endforeach;
if($post_count > 0):
?>
<section class="tabContents_open">
    <div class="titleMain titleMain--wrapper">
        <h2 class="titleMain--main">
            <?php echo get_the_title(); ?>
            の<span>買取実績</span>
        </h2>
        <div class="titleMain--lead">
            <p>買取価格に関しては時期や相場により<br>変動致しますので、お問合せ下さい</p>
        </div>
    </div>

    <style>

      .tabContents_open .btn__more {
        width: 80%;
      }

      .tabContents_open .btn__more>* {
        background-color: white;
      }

      @media (max-width: 769px) {

        .flex_tab_contents_open .btn__wrap {
          width: 95%;
        }

      }

      ul,
      ol,
      li {
        list-style: none;
      }

    </style>
    <style>
      .no_slider .content__list {
        flex-wrap: wrap;
      }

      .no_slider .content__item {
        list-style: none;
      }

      @media (max-width: 767px) {
        .no_slider .content__item {
          width: 44%;
          max-width: 350px;
          margin-bottom: 15px;
        }
      }
    </style>
    <style>
      .flex__content .content__list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 21px;
      }

      .flex__content .content__item {
        width: 22.6% !important;
      }


      @media (min-width: 768px) and (max-width: 1100px) {
        .flex__content .content__item {
          width: 30.1% !important;
          max-width: 200px;
          margin: 0 1.6%;
          margin-bottom: 15px;
        }

        .flex__content .content__list {
          gap: 0px;
        }
      }

      @media (max-width: 767px) {
        .flex__content .content__item {
          width: 41.8% !important
        }
      }

      #category .flex__content {
        padding: 0;
      }

      #category .flex__content {
        padding-bottom: 0px !important;
      }

      .flex__content.active {
        position: relative;
        height: auto;
        padding: 48px 50px !important;
      }

      .flex__content {
        height: 0;
        padding: 0;
      }

      #category .flex__content {
        padding-bottom: 0px !important;
      }

      #category .flex__content.active {
        padding-bottom: 50px !important;
      }

      .flex__content.active {
        padding-bottom: 50px !important;
      }

      @media (max-width: 767px) {
        .flex__content.active {
          padding: 32px 0 !important;
        }
      }
      .flex__tabContents .active{
        border-radius: 24px !important;
      }

      .flex__content .content__item .content__image img{
        width: 172.66px;
        height: 166.81px;
      }
    </style>


    <div class="flex">
        <!-- スライダー部分 -->
        <div class="flex__tabContents no_slider">
            <div class="flex__content active">
                <div id="flex-slider" class="content__list flex--slide">
                <?php
                foreach($purchase_result_data as $category):
                    if($total_post_count >= $max_display){
                        break;
                    }
                    $image_url = $category['image'];
                    if((in_array('brand-tokei', $category['voice_tarm_slug'])) && (in_array($slug, $category['store_term_slug']))):
                ?>
                    <li class="content__item">
                        <div class="img__link">
                            <div class="content_item_wrap">
                                <p class="content__image img">
                                    <?php if (empty($image_url)): ?>
                                        <p class="content__image img"><img src="/gold/wp-content/themes/otakaraya/assets/img/parts/flex/dummy_img.png"></p>
                                    <?php else : ?>
                                          <p class="content__image img"><img src="<?php echo $image_url; ?>" width=100 height=100></p>
                                    <?php endif; ?>
                                </p>
                            <p class="content--name"><?php echo $category['title']; ?></p>
                            </div>
                            </div>
                    </li>
                    <?php
                        $total_post_count++;
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>

</section>
<?php endif;?>
<?php
if (is_category()) :
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
else :
  $post_id = get_the_ID();
endif;
?>

<?php if (!empty(get_field('high_price_purchase_points_h2', $post_id))) : ?>
  <section class="brandinfo_section">
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php the_field('high_price_purchase_points_h2', $post_id); ?>
      </h2>
      <div class="titleMain--lead">
        <p><?php the_field('high_price_purchase_points_h2_read', $post_id); ?></p>
      </div>
    </div>

    <div class="brandinfo brandinfo_red_repeat">
      <?php if (have_rows('high_price_purchase_points_content', $post_id)) : ?>
        <?php while (have_rows('high_price_purchase_points_content', $post_id)) : the_row(); ?>

          <?php $high_price_purchase_points_content_h3 = get_sub_field('high_price_purchase_points_content_h3', $page_id) ?>
          <?php $high_price_purchase_points_content_inner_h3 = get_sub_field('high_price_purchase_points_content_inner_h3', $page_id) ?>
          <?php $high_price_purchase_points_content_lead = get_sub_field('high_price_purchase_points_content_lead', $page_id) ?>

          <?php if (get_sub_field('high_price_purchase_points_content_h3', $page_id)) : ?>
            <div class="brandinfo__main fshoplist-target__list open">
              <div class="brandinfo__header fshoplist-target--ttl">
                <h3 class="brandinfo__header__title"><?php echo $high_price_purchase_points_content_h3 ?></h3>
              </div>
              <div class="fshoplist-target--item brandinfo__body<?php if (empty(get_sub_field('high_price_purchase_points_content_h3_img'))) : ?> no--image<?php endif; ?>" style="display: none;">
                <?php if (get_sub_field('high_price_purchase_points_content_h3_img')) : ?>
                  <figure class="brandinfo__body__img">
                    <picture>
                      <img src="<?php the_sub_field('high_price_purchase_points_content_h3_img', $post_id); ?>" alt="<?php echo strip_tags($high_price_purchase_points_content_h3); ?>">
                    </picture>
                  </figure>
                <?php endif; ?>
                <div class="brandinfo__body__text brandinfo__body__text--top">
                  <?php echo nl2br(the_sub_field('high_price_purchase_points_content_h3_text', $page_id)); ?>
                </div>
              </div>
            </div>
          <?php endif; ?>



          <?php $barc_cnt = 1; ?>
          <?php $barc_cnt_sp = 1; ?>
          <?php $is_table = get_sub_field('is_table') ?>

          <?php if (get_sub_field('high_price_purchase_points_content_inner_h3', $page_id)) : ?>

            <div class="fshoplist-target__list brand_about_repeat_parent_wrap is-pc open 
              <?php if ($is_table == 1) {
                echo "is_table";
              } ?>">
              <div class="fshoplist-target--ttl">
                <h3 class="titleSub"><?php echo $high_price_purchase_points_content_inner_h3; ?></h3>
                <div class="high_price_purchase_points_content_lead"><?php echo $high_price_purchase_points_content_lead; ?></div>
              </div>

              <?php if (have_rows('high_price_purchase_points_content_detail', $post_id)) : ?>
                <?php while (have_rows('high_price_purchase_points_content_detail', $post_id)) : the_row(); ?>

                  <div class="fshoplist-target--item 
                  <?php if (!get_sub_field('high_price_purchase_points_content_h4_img')) {
                    echo "existence_img";
                  } ?>" style="display: none;">
                    <div class="horizonlist horizonnumblist">
                      <div class="horizonlist--link">
                        <?php if (get_sub_field('high_price_purchase_points_content_h4_img')) : ?>
                          <div class="horizonlist--img">
                            <span>
                              <?php echo str_pad($barc_cnt, 2, 0, STR_PAD_LEFT); ?>
                            </span>
                            <img src="<?php the_sub_field('high_price_purchase_points_content_h4_img', $post_id); ?>" alt="<?php echo strip_tags($high_price_purchase_points_content_inner_h3); ?>">
                          </div>
                        <?php endif; ?>

                        <div class="horizonlist--text">
                          <h4 class="titleH4 title--left"><?php the_sub_field('high_price_purchase_points_content_h4', $post_id); ?></h4>
                          <p class="points_content_text"><?php the_sub_field('high_price_purchase_points_content_text', $post_id); ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $barc_cnt++; ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>

            <?php if ($is_table == 1) {  ?>
              <div class="fshoplist-target__list brand_about_repeat_parent_wrap is-sp open 
              <?php if ($is_table == 1) {
                echo "is_table";
              } ?>">
                <div class="fshoplist-target--ttl">
                  <h3 class="titleSub"><?php echo $high_price_purchase_points_content_inner_h3; ?></h3>
                  <div class="high_price_purchase_points_content_lead"><?php echo $high_price_purchase_points_content_lead; ?></div>
                </div>

                <?php if (have_rows('high_price_purchase_points_content_detail', $post_id)) : ?>
                  <?php while (have_rows('high_price_purchase_points_content_detail', $post_id)) : the_row(); ?>

                    <div class="fshoplist-target--item 
                  <?php if (!get_sub_field('high_price_purchase_points_content_h4_img')) {
                      echo "existence_img";
                    } ?>" style="display: none;">
                      <div class="horizonlist horizonnumblist">
                        <div class="horizonlist--link">
                          <?php if (get_sub_field('high_price_purchase_points_content_h4_img')) : ?>
                            <div class="horizonlist--img">
                              <span>
                                <?php echo str_pad($barc_cnt, 2, 0, STR_PAD_LEFT); ?>
                              </span>
                              <img src="<?php the_sub_field('high_price_purchase_points_content_h4_img', $post_id); ?>" alt="<?php echo strip_tags($high_price_purchase_points_content_inner_h3); ?>">
                            </div>
                          <?php endif; ?>

                          <div class="horizonlist--text">
                            <h4 class="titleH4 title--left"><?php the_sub_field('high_price_purchase_points_content_h4', $post_id); ?></h4>
                            <p class="points_content_text"><?php the_sub_field('high_price_purchase_points_content_text', $post_id); ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $barc_cnt++; ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>

            <?php } else { ?>
              <div class="fshoplist-target__list brand_about_repeat_parent_wrap is-sp open 
              <?php if ($is_table == 1) {
                echo "is_table";
              } ?>">
                <div class="fshoplist-target--ttl">
                  <h3 class="titleSub"><?php echo $high_price_purchase_points_content_inner_h3; ?></h3>
                  <div class="high_price_purchase_points_content_lead"><?php echo $high_price_purchase_points_content_lead; ?></div>
                </div>
                <?php if (have_rows('high_price_purchase_points_content_detail', $post_id)) : ?>
                  <?php while (have_rows('high_price_purchase_points_content_detail', $post_id)) : the_row(); ?>
                    <div class="fshoplist-target--item 
                      <?php if (get_sub_field('high_price_purchase_points_content_h4_img')) {
                        echo "";
                      } ?>" style="display: none;">
                      <div class="horizonlist horizonnumblist">
                        <div class="horizonlist--link">
                          <?php if (get_sub_field('high_price_purchase_points_content_h4_img')) : ?>
                            <div class="horizonlist--img">
                              <span>
                                <?php echo str_pad($barc_cnt_sp, 2, 0, STR_PAD_LEFT); ?>
                              </span>
                              <img src="<?php the_sub_field('high_price_purchase_points_content_h4_img', $post_id); ?>" alt="<?php echo strip_tags($high_price_purchase_points_content_inner_h3); ?>">
                            </div>
                          <?php endif; ?>
                          <h4 class="titleH4 title--left"><?php the_sub_field('high_price_purchase_points_content_h4', $post_id); ?></h4>
                        </div>
                        <div class="horizonlist--text">
                          <p class="points_content_text"><?php the_sub_field('high_price_purchase_points_content_text', $post_id); ?></p>
                        </div>
                      </div>
                    </div>

                    <?php $barc_cnt_sp++; ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            <?php } ?>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>


      <?php if (is_single()) : ?>
      <?php else : ?>
        <!-- 共通コンテンツ -->
        <div class="fshoplist-target__list brand_about_repeat_parent_wrap is-pc open">
          <div class="fshoplist-target--ttl">
            <h3 class="titleSub">ブランド時計が<br class="is-sp">高騰している理由</h3>
            <div class="high_price_purchase_points_content_lead"></div>
          </div>


          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    01 </span>
                  <img src="/brand-tokei/wp-content/uploads/2023/07/334526ae0e80dd59c53bf2c2bf084282.webp" alt="為替変動で高く売れる">
                </div>

                <div class="horizonlist--text">
                  <h4 class="titleH4 title--left">為替変動で高く売れる</h4>
                  <p class="points_content_text">海外の高級ブランド時計は輸入品です。そのため、「為替」の影響で価格が大きく変動します。為替相場が円高だと安価での買取に、円安なら高額での買取となります。

                    円安が続いている今は、高値がつきやすいタイミングです。</p>
                </div>
              </div>
            </div>
          </div>

          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    02 </span>
                  <img src="/brand-tokei/wp-content/uploads/2023/07/f154b3d7ae78c88269ad3a59a3a24ce6-1.webp" alt="中古でも需要も高い（壊れてても売れる）">
                </div>

                <div class="horizonlist--text">
                  <h4 class="titleH4 title--left">中古でも需要も高い（壊れてても売れる）</h4>
                  <p class="points_content_text">高級ブランド時計は高額なため、中古品を求める人も多くいます。人気ブランドほど需要が高く、買取価格も高値がつきやすくなります。

                    さらにおたからやでは、壊れた時計、パーツしかない時計などでも買取可能。高額買取となるものもあります。</p>
                </div>
              </div>
            </div>
          </div>

          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    03 </span>
                  <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2023/12/20220302-30-1024x683-1.webp" alt="現物資産としての価値がある">
                </div>

                <div class="horizonlist--text">
                  <h4 class="titleH4 title--left">現物資産としての価値がある</h4>
                  <p class="points_content_text">高級ブランド時計は、「現物資産」としての価値を備えています。流通量・生産量が少なくブランド価値が下がらないため、需要が安定しているのです。

                    近年はブランド時計を投資に用いる人も増えており、買取価格は上昇傾向にあります。</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="fshoplist-target__list brand_about_repeat_parent_wrap is-sp open ">
          <div class="fshoplist-target--ttl">
            <h3 class="titleSub">ブランド時計が<br class="is-sp">高騰している理由</h3>
            <div class="high_price_purchase_points_content_lead"></div>
          </div>
          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    01 </span>
                  <img src="/brand-tokei/wp-content/uploads/2023/07/334526ae0e80dd59c53bf2c2bf084282.webp" alt="為替変動で高く売れる">
                </div>
                <h4 class="titleH4 title--left">為替変動で高く売れる</h4>
              </div>
              <div class="horizonlist--text">
                <p class="points_content_text">海外の高級ブランド時計は輸入品です。そのため、「為替」の影響で価格が大きく変動します。為替相場が円高だと安価での買取に、円安なら高額での買取となります。

                  円安が続いている今は、高値がつきやすいタイミングです。</p>
              </div>
            </div>
          </div>

          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    02 </span>
                  <img src="/brand-tokei/wp-content/uploads/2023/07/f154b3d7ae78c88269ad3a59a3a24ce6-1.webp" alt="中古でも需要も高い（壊れてても売れる）">
                </div>
                <h4 class="titleH4 title--left">中古でも需要も高い（壊れてても売れる）</h4>
              </div>
              <div class="horizonlist--text">
                <p class="points_content_text">高級ブランド時計は高額なため、中古品を求める人も多くいます。人気ブランドほど需要が高く、買取価格も高値がつきやすくなります。

                  さらにおたからやでは、壊れた時計、パーツしかない時計などでも買取可能。高額買取となるものもあります。</p>
              </div>
            </div>
          </div>

          <div class="fshoplist-target--item">
            <div class="horizonlist horizonnumblist">
              <div class="horizonlist--link">
                <div class="horizonlist--img">
                  <span>
                    03 </span>
                  <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2023/12/20220302-30-1024x683-1.webp" alt="現物資産としての価値がある">
                </div>
                <h4 class="titleH4 title--left">現物資産としての価値がある</h4>
              </div>
              <div class="horizonlist--text">
                <p class="points_content_text">高級ブランド時計は、「現物資産」としての価値を備えています。流通量・生産量が少なくブランド価値が下がらないため、需要が安定しているのです。

                  近年はブランド時計を投資に用いる人も増えており、買取価格は上昇傾向にあります。</p>
              </div>
            </div>
          </div>

        </div>
        <!-- 共通コンテンツ -->
      <?php endif; ?>
    </div>


  </section>
<?php endif; ?>



<style>
  .brandinfo_section .fshoplist-target__list {
    padding: 0;
  }

  .brandinfo_section .brand_about_repeat_parent_wrap .high_price_purchase_points_content_lead {
    display: none;
    margin-top: 1rem;
    font-size: 1rem;
  }

  .brandinfo_section .brand_about_repeat_parent_wrap.open .high_price_purchase_points_content_lead {
    display: block;
  }

  .brandinfo_section .fshoplist-target--ttl::before,
  .brandinfo_section .fshoplist-target--ttl::after {
    right: 30px;
    background: #fff;
  }

  .brand_about_repeat_parent_wrap .fshoplist-target--ttl::before,
  .brand_about_repeat_parent_wrap .fshoplist-target--ttl::after {
    background: #d82300;
  }

  .brandinfo_section .brand_about_repeat_parent_wrap {
    margin: 1rem 0;
  }

  .brandinfo_section .fshoplist-target--ttl {
    padding: 10px 15px;
  }



  .brand_about_repeat_parent_wrap .horizonlist {
    margin: 0;
    padding: 15px;
  }

  .brandinfo_section .titleSub {
    padding-right: 30px;
  }

  .brandinfo_section .brandinfo__main {
    margin-top: 1rem;
  }

  .brandinfo_section .brandinfo__header__title {
    padding: 0px 15px;
  }

  .brandinfo_section .brandinfo__body {
    padding: 1rem 1rem 1rem;
    background: #fcf1db;
  }

  .brandinfo_section .brandinfo__body__text {
    margin-top: 0rem;
  }

  .brandinfo_section .brandinfo__body__img {
    margin-bottom: 1em;
  }


  .brandinfo_section .brandinfo_red_repeat .brandinfo__body__text::after,
  .brandinfo_red_repeat .brandinfo__body__text::after {
    background: none;

  }

  .brand_about_repeat_parent_wrap .horizonlist--text {
    word-break: break-all;
  }

  .brandinfo_section .fshoplist-target__list {
    cursor: auto;
  }

  .brandinfo_section .fshoplist-target--ttl {
    cursor: pointer;
  }

  .brandinfo_section .fshoplist-target--ttl::before,
  .brandinfo_section .fshoplist-target--ttl::after {
    top: 30px;
  }

  .fshoplist-target--item.existence_img .horizonlist--text {
    width: 100%;
    max-width: 100%;
  }

  .brandinfo_section .is_table .horizonlist--text h4 {
    width: 30%;
    padding: 0px 10px;
    font-size: 15px;
  }

  .brandinfo_section .is_table .horizonlist--text .points_content_text {
    width: 70%;
    border-left: 1px solid #b8b8b8;
    padding: 10px;
  }

  .brandinfo_section .is_table .horizonlist--text {
    width: 100%;
    max-width: 100%;
    display: flex;
    align-items: center;
  }


  .is_table .horizonlist {
    padding: 0px 15px;
  }

  .is_table .horizonlist--text .titleH4 {
    margin-bottom: 0rem;
  }

  .is_table .horizonlist--link {
    border: 1px solid #b8b8b8;
    border-top: none;
  }

  .is_table .fshoplist-target--ttl+.fshoplist-target--item .horizonlist--link {
    border-top: 1px solid #b8b8b8;
  }

  .brandinfo_section .fshoplist-target__list.is_table {
    padding-bottom: 1rem;
  }


  @media (max-width: 767px) {
    .brandinfo_section .brandinfo__header__title {
      padding: 0.5rem 45px;
    }

    .brandinfo_section .fshoplist-target--ttl::before,
    .brandinfo_section .fshoplist-target--ttl::after {
      right: 15px;
    }

    .brandinfo_section .fshoplist-target--ttl {
      padding: 10px 18px;
    }

    .brand_about_repeat_parent_wrap .horizonnumblist .horizonlist--img {
      margin-right: 10px;
      margin-bottom: 10px;
      width: 100%;
    }

    .brand_about_repeat_parent_wrap .horizonlist--link {
      display: flex;
      align-items: center;
    }

    .brand_about_repeat_parent_wrap .horizonlist--text {
      max-width: 100%;
      width: 100%;
    }

    .brand_about_repeat_parent_wrap .horizonlist--text .titleH4 {
      margin-bottom: 4rem;
    }

    .brand_about_repeat_parent_wrap .fshoplist-target--item {
      padding: 0 10px;
    }

    .brand_about_repeat_parent_wrap .sp_text_wrap {
      display: flex;
    }

    .is_table .horizonlist--text .titleH4 {
      margin-bottom: 0rem;
    }

    .brandinfo_section .is_table .horizonlist--text {
      flex-direction: column;
    }

    .brandinfo_section .is_table .horizonlist--text .points_content_text {
      width: 90%;
      border-left: none;
      border-top: none;
    }

    .brandinfo_section .is_table .horizonlist--text h4 {
      width: 100%;
      padding: 10px 10px;
      font-size: 15px;
      text-align: center;
    }


  }
</style>
    <aside class="sidebar">
      <!-- TOP BANNER -->



      <?php
      $mode = "";
      if ($_GET["mode"]) {
        $mode = $_GET["mode"];
      }
      ?>
      <?php if (!$mode == "test") {
        include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/side_menu_common.php"); ?>

        <!-- 
          <div class="sidebar__cta">
          <img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/sidebar_cta_header.png" alt="" width="320" height="223">
          <a href="tel:0120555600" class="cta__banner--bnr2 is-sp">
            <img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/sidebar_tel.png" alt="まずは電話で聞いてみる 0120-555-600">
          </a>
          <a href="https://www.otakaraya.jp/contact/" class="cta__banner--bnr2 is-pc">
            <img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/sidebar_tel.png" alt="まずは電話で聞いてみる 0120-555-600">
          </a>
          <a href="https://www.otakaraya.jp/web_contact/" class="cta__banner--bnr3">
            <img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/sidebar_web.png" alt="" width="320" height="112">
          </a>
        </div>

        <div class="sidebar__cta__btns">
          <p class="btn__cta_2">
            <a href="https://www.otakaraya.jp/shop/"><img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/renewalPC_tenpo_CVbutton_side1.webp" alt="お近くの店舗を探す"></a>
          </p>
          <p class="btn__cta_2">
            <a href="https://www.otakaraya.jp/visiting/"><img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/renewalPC_tenpo_CVbutton_side2.webp" alt="出張買取の詳細はこちら"></a>
          </p>
        </div>

        <div class="sidebar__cta">
          <img src="/assets/img/sidebar_cta_header.webp" alt="まずは無料査定" width="320" height="223">
          <a href="tel:0120555600" class="cta__banner--bnr2 is-sp">
            <img src="/assets/img/sidebar_tel.webp" alt="まずは電話で聞いてみる 0120-555-600">
          </a>
          <div class="is-pc cta__banner--bnr2">
            <img src="/assets/img/sidebar_tel_pc.webp" alt="まずは電話で聞いてみる 0120-555-600">
          </div>
          <a href="https://www.otakaraya.jp/web_contact/" class="cta__banner--bnr3">
            <img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/sidebar/sidebar_web.png" alt="WEBで簡単査定" width="320" height="112">
          </a>
        </div>

        <div class="sidebar__cta__btns">
          <p class="btn__wrap btn__cta">
            <a href="https://www.otakaraya.jp/shop/">お近くの店舗を探す</a>
          </p>
          <p class="btn__wrap btn__cta">
            <a href="https://www.otakaraya.jp/visiting/">出張買取の詳細はこちら</a>
          </p>
        </div>

        <style>
          .sidebar__cta__btns a {
            font-size: 1.1rem;
          }

          .sidebar .btn__wrap>* {
            padding: 1rem 40px 1rem 25px;
          }

          .cta .btn__cta>a {
            font-size: 1.3rem;
          }

          @media (max-width: 767px) {
            .cta .btn__cta>a {
              font-size: 1.1rem;
            }

            .sidebar__cta__btns a {
              font-size: 1.1rem;
            }

            .btn__gr01--wrap>a {
              font-size: 1.4rem;
            }

          }
        </style> -->

      <?php } else {;
        include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/side_menu_common.php"); ?>
        <?php //echo get_field('cta_sidemenu', 19025); 
        ?>
      <?php  }; ?>


      <!-- nav -->
      <div class="sidebar__nav--wrapper">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'sidemenu',
            'container'               => 'nav', //<nav>タグで囲うよ！
            'container_class'          => 'sidebar__nav', //<nav id="gnav">にするよ！
            'depth'                    => 0,
            'walker'  => new custom_walker_side_nav_menu
          )
        );
        ?>
      </div>

      <div class="sidebar__nav--wrapper">
        <nav class="sidebar__nav">
          <ul>

            <?php
            if (have_rows('side_common_menu_repeat', 19068)) :
              while (have_rows('side_common_menu_repeat', 19068)) : the_row(); ?>

                <li class="btn__gy01--wrap">
                  <a href="<?php the_sub_field('side_common_menu_repeat_link'); ?>"><?php the_sub_field('side_common_menu_repeat_text'); ?></a>
                </li>
            <?php
              endwhile;
            endif;
            ?>

          </ul>
        </nav>
      </div>

      <!-- banner -->
      <ul class="sidebar__bannerList">
        <?php
        if (have_rows('side_common_banner_repeat', 19068)) :
          while (have_rows('side_common_banner_repeat', 19068)) : the_row();
        ?>

            <li class="sidebar__bannerItem"><a href="<?php the_sub_field('side_common_banner_repeat_link'); ?>"><img src="<?php the_sub_field('side_common_banner_repeat_img'); ?>" alt="banner"></a></li>
        <?php
          endwhile;
        endif;
        ?>

      </ul>
      <style>
        .sidebar__bannerItem {
          border: solid 1px #000000;
        }
      </style>
    </aside>
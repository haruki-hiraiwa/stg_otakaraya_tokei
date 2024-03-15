<!-- GTM tag -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W2M2WF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- GTM end -->


<?php include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/new_year_time_text.php"); ?>

<header id="header">
  <div id="nav_toggle"></div>
  <div class="header__head">
    <div class="logo__wrap">
      <p class="logo__img"><a href="https://www.otakaraya.jp/"><img src="<?php echo THEME_URL; ?>assets/img/common/logo.png" class="logo" alt="おたからや"></a></p>
      <?php
      if (is_category()) :
        $cat_id = get_queried_object()->cat_ID;
        $cat_post_id = 'category_' . $cat_id;
        $h1_title = get_field('h1title', $cat_post_id);
      elseif (is_tax()) :
        $term_object = get_queried_object();
        $tax_post_id = $term_object->taxonomy . '_' . $term_object->term_id;
        $h1_title = get_field('h1title', $tax_post_id);
      elseif (is_post_type_archive('result')) :
        $h1_title = get_field('h1title', 19527);
      elseif (is_post_type_archive('shop')) :
        $h1_title = get_field('h1title', 19528);
      elseif (is_post_type_archive('faq')) :
        $h1_title = get_field('h1title', 19398);
      elseif (is_post_type_archive('voice')) :
        $h1_title = get_field('h1title', 19608);
      else :
        $h1_title = get_field('h1title');
      endif;
      ?>
      <h1 class="logo__text"><?php echo $h1_title; ?></h1>
    </div>
    <div class="tel__wrap">
      <p class="tel__img"><img src="<?php echo THEME_URL; ?>assets/img/common/header_tel.png" alt="0120-555-600"></p>
      <p class="tel__text">
        <?php
        include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/business_hours/business_hours_text.php");
        ?>
      </p>
    </div>
  </div>

  <?php get_template_part('/template-parts/navigation/header_menu'); ?>


</header>

<style>
  .header__corona {
    display: none;
  }
</style>
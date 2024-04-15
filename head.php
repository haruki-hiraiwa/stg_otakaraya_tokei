<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="True" />

  <!-- GTM tag -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        '//www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-W2M2WF');
  </script>
  <!-- GTM end -->

  <?php
  if (is_category()) :
    $cat_id = get_queried_object()->cat_ID;
    $cat_post_id = 'category_' . $cat_id;

    $hititle = get_field('h1title', $cat_post_id);

  else :

    $hititle = get_field('h1title');

  endif;
  ?>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <?php
  /***** カテゴリ情報取得 *****/
  $term_obj = get_queried_object(); // タームオブジェクトを取得

  $term_id = $term_obj->term_id;
  $term_slug = $term_obj->slug;
  $term_name = $term_obj->name;
  $term_parent = $term_obj->parent;
  $term_description = $term_obj->description;
  $term_taxonomy = $term_obj->taxonomy;

  ?>

  <link rel="stylesheet" href="<?php echo THEME_URL; ?>assets/css/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/common.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/parts.min.css" />
  <!-- local css -->
  <?php if (is_home() || is_front_page()) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/brand-tokei.min.css" />
  <?php endif; ?>
  <?php if (is_category()) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/brand.min.css" />
  <?php endif; ?>
  <?php if (is_singular('post')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/brand_model.min.css" />
  <?php endif; ?>
  <?php if (is_post_type_archive('result') || is_singular('result') || is_page_template('page-brand_list.php')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/result.min.css" />
  <?php endif; ?>
  <?php if (is_singular('result')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/result_detail.min.css" />
  <?php endif; ?>
  <?php if (is_tax('result_cat')) : ?>
    <?php if ($term_parent == 0) : ?>
      <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/result_brand.min.css" />
    <?php else : ?>
      <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/result_model.min.css" />
    <?php endif; ?>
  <?php endif; ?>
  <?php if (is_post_type_archive('shop') || is_tax('area')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/shop.min.css" />
  <?php endif; ?>
  <?php if (is_singular('shop') || is_singular('area_vicinity')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/shopdetail.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/shop_manager_comment.min.css" />
  <?php endif; ?>
  <?php if (is_page(19309)) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/etc.min.css" />
  <?php endif; ?>
  <?php if (is_post_type_archive('faq')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/faq.min.css" />
  <?php endif; ?>
  <?php if (is_page(19665)) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/item.min.css" />
  <?php endif; ?>
  <?php if (is_post_type_archive('voice')) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/voice.min.css" />
  <?php endif; ?>

  <?php if (is_404()) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>assets/css/404.min.css" />
  <?php endif; ?>

  <script src="<?php echo THEME_URL; ?>assets/js/jquery-3.6.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  <script src="<?php echo THEME_URL; ?>assets/js/setWindowSizeGet.js"></script>

  <?php wp_head(); ?>
</head>
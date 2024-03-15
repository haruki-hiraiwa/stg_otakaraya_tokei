<section>
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">
      <?php echo get_field('shop_guide_headline', 19059); ?>
    </h2>
    <div class="titleMain--lead">
      <p><?php echo get_field('shop_guide_lead_text', 19059); ?></p>
    </div>
  </div>
  <div class="fshoplist__wrap shop_link_change_wrap">
    <!-- shop-trigger -->
    <div class="fshoplist-trigger">
      <ul class="fshoplist-trigger--inner">

        <?php
        $terms = get_terms('area', ['parent' => 0, 'orderby' => 'id']);
        foreach ($terms as $term) {
          echo '<li class="fshoplist-trigger--item"><a class="scroll shop_link_change" href="/brand-tokei/shop/' . esc_html($term->slug) . '">' . esc_html($term->name) . '</a></li>';
        }
        ?>

      </ul>
    </div>
    <!-- shop-target -->
    <!-- <div class="fshoplist-target">


      <?php
      foreach ($terms as $term) :
        $query = new WP_Query(
          array(
            'post_status' => 'publish',
            'post_type' => 'shop',
            'tax_query' => array(
              array(
                'taxonomy' => 'area',
                'field' => 'slug',
                'terms' => $term->slug,
              )
            ),
            'fields' => 'ids',
            'posts_per_page' => -1
          )
        );
        if ($query->have_posts()) : ?>
          <dl class="fshoplist-target__list" id="<?php echo $term->slug; ?>">
            <dt class="fshoplist-target--ttl">
              <p><?php echo $term->name; ?></p>
            </dt>
            <dd class="fshoplist-target--item">
              <ul>
                <?php foreach ($query->posts as $post_id) : ?>
                  <li><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </dd>
          </dl>
      <?php endif;
        wp_reset_postdata();
      endforeach;

      unset($terms);
      unset($query);
      ?>
    </div> -->
  </div>
</section>

<style>
  .shop_link_change::after {
    position: absolute;
    top: 50%;
    right: 0.75rem;
    width: 1.5rem;
    height: 1.5rem;
    content: "";
    background: url(/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/shopList/shop-arrow__right.svg);
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }

  .shop_link_change_wrap .fshoplist-trigger--item::after {
    content: none;
  }
</style>
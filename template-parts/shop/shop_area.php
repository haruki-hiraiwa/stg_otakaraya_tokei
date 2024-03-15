      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            おたからや店舗<span>エリア一覧</span>
          </h2>
        </div>
        <div class="fshoplist__wrap">
          <!-- shop-trigger -->
          <div class="fshoplist-trigger">
            <ul class="fshoplist-trigger--inner">

<?php
  $terms = get_terms('area', ['parent' => 0, 'orderby' => 'id']);
  foreach ( $terms as $term ) {
?>
              <li class="fshoplist-trigger--item"><a href="<?php echo get_term_link($term->term_id, 'area'); ?>"><?php echo esc_html($term->name); ?></a></li>
<?php
  }
?>
            </ul>
          </div>
        </div>
      </section>

<?php /* Template Name: Allbooks */ ?>
<?php get_header(); ?>
<div id="primary" class="content-area">
   
    <form class="filter" action="<?php echo esc_url(get_post_type_archive_link('book')); ?>" method="get">
      <?php
      $terms = get_terms(array(
        'taxonomy' => 'genre',
        'hide_empty' => true,
      ));
      if ($terms) :
      ?>
        <select name="genre">
          <option value=""><?php _e('All Genres'); ?></option>
          <?php foreach ($terms as $term) : ?>
            <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($term->slug, get_query_var('genre')); ?>><?php echo esc_html($term->name); ?></option>
 <?php endforeach; ?>
    </select>
  <?php endif; ?>
  <button type="submit"><?php _e('Filter'); ?></button>
</form>
 <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while (have_posts()) : the_post();
            // Include the page content template.
            get_template_part('template-parts/content', 'page');
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        // End of the loop.
        endwhile;
        $args = array(
            'post_type' => 'book',
            'posts_per_page' => -1,
        );

        // if (isset($_GET['genre'])) {
        //     $args['tax_query'] = array(
        //         array(
        //             'taxonomy' => 'genre',
        //             'field' => 'slug',
        //             'terms' => $_GET['genre'],
        //         ),
        //     );
        // }

        $books = new WP_Query($args);

        if ($books->have_posts()) :
            while ($books->have_posts()) : $books->the_post();
        ?>
                <article>
                    <a href="<?php echo get_post_permalink() ?>">
                        <h2><?php the_title(); ?></h2>
                        <?php //echo get_the_post_thumbnail(); ?>
					<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
						<div class="imgesset" style="background-image: url(<?php echo $feat_image;?>)"></div>

                        <p><strong>Author:</strong> <?php the_field('author'); ?></p>
                        <p><strong>Publisher:</strong> <?php the_field('publisher'); ?></p>
                        <p><strong>Year of Publication:</strong> <?php the_field('year_of_publication'); ?></p>
                    </a>
                </article>
        <?php
            endwhile;
        endif;
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
<?php
/**
 * Archive: Works
 *
 * @package DevPortfolio
 */

get_header();

$categories = get_terms( array(
    'taxonomy'   => 'work_category',
    'hide_empty' => true,
) );
?>

<section class="alfornon-section alfornon-section--works">
    <div class="alfornon-container">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php echo esc_html( get_field( 'works_archive_title', 'option' ) ?: 'Featured Works' ); ?></h2>
            <span class="alfornon-rule"></span>
            <p><?php echo esc_html( get_field( 'works_archive_subtitle', 'option' ) ?: 'A showcase of innovative projects blending creativity with technical excellence' ); ?></p>
        </header>

        <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
            <div class="filter-bar">
                <button class="filter-btn active" data-filter="*">All</button>
                <?php foreach ( $categories as $cat ) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="works-grid alfornon-card-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/card', 'work' ); ?>
                <?php endwhile; ?>
            </div>

            <div class="alfornon-section__cta">
                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; Prev',
                    'next_text' => 'Next &raquo;',
                ) ); ?>
            </div>
        <?php else : ?>
            <p class="alfornon-empty reveal-on-scroll">No works found. Start adding projects!</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

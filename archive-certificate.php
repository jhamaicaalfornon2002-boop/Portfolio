<?php
/**
 * Archive: Certificates
 *
 * @package DevPortfolio
 */

get_header(); ?>

<section class="alfornon-section alfornon-section--certificates">
    <div class="alfornon-container">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php echo esc_html( get_field( 'certificates_archive_title', 'option' ) ?: 'Certificates' ); ?></h2>
            <span class="alfornon-rule"></span>
            <p><?php echo esc_html( get_field( 'certificates_archive_subtitle', 'option' ) ?: 'Professional certifications & achievements' ); ?></p>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="certificates-grid alfornon-card-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/card', 'certificate' ); ?>
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
            <p class="alfornon-empty reveal-on-scroll">No certificates found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

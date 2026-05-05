<?php
/**
 * Archive: Skills
 *
 * @package DevPortfolio
 */

get_header();

$skill_cats = get_terms( array(
    'taxonomy'   => 'skill_category',
    'hide_empty' => true,
) );
?>

<section class="alfornon-section alfornon-section--skills">
    <div class="alfornon-container alfornon-container--narrow">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php echo esc_html( get_field( 'skills_archive_title', 'option' ) ?: 'Skills & Tools' ); ?></h2>
            <span class="alfornon-rule"></span>
            <p><?php echo esc_html( get_field( 'skills_archive_subtitle', 'option' ) ?: 'Technologies and tools I work with' ); ?></p>
        </header>

        <?php if ( $skill_cats && ! is_wp_error( $skill_cats ) ) : ?>
            <?php foreach ( $skill_cats as $cat ) : ?>
                <?php
                $cat_skills = new WP_Query( array(
                    'post_type'      => 'skill',
                    'posts_per_page' => -1,
                    'meta_key'       => 'skill_order',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'ASC',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'skill_category',
                            'field'    => 'term_id',
                            'terms'    => $cat->term_id,
                        ),
                    ),
                ) );
                ?>
                <?php if ( $cat_skills->have_posts() ) : ?>
                    <div class="skills-section">
                        <h3 class="skills-section__title"><?php echo esc_html( $cat->name ); ?></h3>
                        <div class="skills-grid">
                            <?php while ( $cat_skills->have_posts() ) : $cat_skills->the_post(); ?>
                                <?php get_template_part( 'template-parts/card', 'skill' ); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?php if ( have_posts() ) : ?>
                <div class="skills-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/card', 'skill' ); ?>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p class="alfornon-empty reveal-on-scroll">No skills added yet.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

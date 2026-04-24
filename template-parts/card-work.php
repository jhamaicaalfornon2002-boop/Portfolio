<?php
/**
 * Template Part: Work Card
 *
 * @package DevPortfolio
 */

$technologies = devportfolio_parse_lines( get_field( 'work_technologies' ) );
$categories   = get_the_terms( get_the_ID(), 'work_category' );
?>

<article class="work-card">
    <a href="<?php the_permalink(); ?>" class="work-card__link">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="work-card__image">
                <?php the_post_thumbnail( 'portfolio-thumb' ); ?>
                <div class="work-card__overlay">
                    <span class="work-card__view">View Project</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="work-card__body">
            <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                <span class="work-card__category">
                    <?php echo esc_html( $categories[0]->name ); ?>
                </span>
            <?php endif; ?>

            <h3 class="work-card__title"><?php the_title(); ?></h3>
            <p class="work-card__excerpt"><?php echo devportfolio_excerpt( 100 ); ?></p>

            <?php if ( $technologies ) : ?>
                <div class="work-card__tech">
                    <?php foreach ( array_slice( $technologies, 0, 4 ) as $tech ) : ?>
                        <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </a>
</article>

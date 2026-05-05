<?php
/**
 * Template Part: Work Card
 *
 * @package DevPortfolio
 */

$technologies = devportfolio_parse_lines( get_field( 'work_technologies' ) );
$categories   = get_the_terms( get_the_ID(), 'work_category' );
$card_index   = isset( $GLOBALS['wp_query']->current_post ) ? (int) $GLOBALS['wp_query']->current_post : 0;

// Define gradients for different cards
$gradients = array(
    'linear-gradient(135deg, #A3554F 0%, #C1705A 100%)',
    'linear-gradient(135deg, #C1705A 0%, #E4B192 100%)',
    'linear-gradient(135deg, #E4B192 0%, #FFD6A9 100%)',
    'linear-gradient(135deg, #9EB2B1 0%, #6A8284 100%)',
    'linear-gradient(135deg, #A3554F 0%, #9EB2B1 100%)',
    'linear-gradient(135deg, #C1705A 0%, #A3554F 100%)',
);

// Define rotations for cards
$rotations = array( 'rotate-2', '-rotate-1', 'rotate-1', '-rotate-2', 'rotate-1', '-rotate-1' );

$gradient_style = $gradients[ $card_index % count( $gradients ) ];
$rotate_class   = $rotations[ $card_index % count( $rotations ) ];
?>

<article class="work-card reveal-on-scroll <?php echo esc_attr( $rotate_class ); ?>">
    <a href="<?php the_permalink(); ?>" class="work-card__link">
        <div class="work-card__visual" style="background: <?php echo esc_attr( $gradient_style ); ?>;">
            <div class="work-card__pattern"></div>
            <span class="work-card__icon" aria-hidden="true">&lt;/&gt;</span>
            <div class="work-card__overlay">
                <span class="work-card__view">View Project <span aria-hidden="true">↗</span></span>
            </div>
        </div>

        <div class="work-card__body">
            <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                <span class="work-card__category"><?php echo esc_html( $categories[0]->name ); ?></span>
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

        <div class="work-card__corner"></div>
    </a>
</article>

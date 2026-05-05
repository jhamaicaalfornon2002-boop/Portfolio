<?php
/**
 * Template Part: Skill Card
 *
 * @package DevPortfolio
 */

$icon        = get_field( 'skill_icon' );
$level       = get_field( 'skill_proficiency' ) ?: 'intermediate';
$percentage  = get_field( 'skill_percentage' ) ?: 50;
$description = get_field( 'skill_description' );
$categories  = get_the_terms( get_the_ID(), 'skill_category' );
$card_index  = isset( $GLOBALS['wp_query']->current_post ) ? (int) $GLOBALS['wp_query']->current_post : 0;
$safe_percent = min( 100, max( 0, (int) $percentage ) );
?>

<article class="skill-card skill-card--tone-<?php echo esc_attr( ( $card_index % 4 ) + 1 ); ?> reveal-on-scroll <?php echo esc_attr( devportfolio_proficiency_color( $level ) ); ?>" style="--card-index: <?php echo esc_attr( $card_index ); ?>;">
    <div class="skill-card__head">
        <?php if ( $icon ) : ?>
            <div class="skill-card__icon">
                <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ?: get_the_title() ); ?>">
            </div>
        <?php else : ?>
            <div class="skill-card__icon skill-card__icon--placeholder">
                <span><?php echo esc_html( strtoupper( mb_substr( get_the_title(), 0, 2 ) ) ); ?></span>
            </div>
        <?php endif; ?>

        <div class="skill-card__meta">
            <h3 class="skill-card__title"><?php the_title(); ?></h3>
            <span class="skill-card__pct"><?php echo esc_html( $safe_percent ); ?>%</span>
        </div>
    </div>

    <div class="skill-card__bar">
        <div class="skill-card__fill" data-percent="<?php echo esc_attr( $safe_percent ); ?>"></div>
    </div>

    <?php if ( $description ) : ?>
        <p class="skill-card__desc"><?php echo esc_html( $description ); ?></p>
    <?php elseif ( $categories && ! is_wp_error( $categories ) ) : ?>
        <p class="skill-card__desc"><?php echo esc_html( $categories[0]->name ); ?></p>
    <?php endif; ?>
</article>

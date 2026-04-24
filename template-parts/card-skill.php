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
?>

<div class="skill-card <?php echo esc_attr( devportfolio_proficiency_color( $level ) ); ?>">
    <?php if ( $icon ) : ?>
        <div class="skill-card__icon">
            <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ?: get_the_title() ); ?>">
        </div>
    <?php endif; ?>

    <h3 class="skill-card__title"><?php the_title(); ?></h3>

    <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
        <span class="skill-card__category"><?php echo esc_html( $categories[0]->name ); ?></span>
    <?php endif; ?>

    <div class="skill-card__bar">
        <div class="skill-card__fill" style="width: <?php echo esc_attr( $percentage ); ?>%;" data-percent="<?php echo esc_attr( $percentage ); ?>">
            <span><?php echo esc_html( $percentage ); ?>%</span>
        </div>
    </div>

    <span class="skill-card__level"><?php echo esc_html( ucfirst( $level ) ); ?></span>

    <?php if ( $description ) : ?>
        <p class="skill-card__desc"><?php echo esc_html( $description ); ?></p>
    <?php endif; ?>
</div>

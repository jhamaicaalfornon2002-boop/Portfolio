<?php
/**
 * Template Part: Certificate Card
 *
 * @package DevPortfolio
 */

$issuer       = get_field( 'cert_issuer' );
$date         = get_field( 'cert_date' );
$credential   = get_field( 'cert_credential_id' );
$url          = get_field( 'cert_url' );
$cert_image   = get_field( 'cert_image' );
$description  = get_field( 'cert_description' ) ?: get_the_excerpt();
$card_index   = isset( $GLOBALS['wp_query']->current_post ) ? (int) $GLOBALS['wp_query']->current_post : 0;
$rotations    = array( 'tilt-neg', 'tilt-pos', 'tilt-neg-soft', 'tilt-soft' );
?>

<article class="cert-card reveal-on-scroll <?php echo esc_attr( $rotations[ $card_index % count( $rotations ) ] ); ?>">
    <div class="cert-card__layers" aria-hidden="true"></div>

    <div class="cert-card__visual">
        <?php if ( $cert_image ) : ?>
            <img src="<?php echo esc_url( $cert_image['sizes']['certificate-thumb'] ?? $cert_image['url'] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
        <?php elseif ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'certificate-thumb' ); ?>
        <?php else : ?>
            <span class="cert-card__award" aria-hidden="true">A</span>
        <?php endif; ?>
    </div>

    <div class="cert-card__body">
        <h3 class="cert-card__title"><?php the_title(); ?></h3>

        <div class="cert-card__meta">
            <?php if ( $issuer ) : ?>
                <p class="cert-card__issuer"><?php echo esc_html( $issuer ); ?></p>
            <?php endif; ?>

            <?php if ( $date ) : ?>
                <p class="cert-card__date"><?php echo esc_html( $date ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $credential ) : ?>
            <p class="cert-card__credential">ID: <?php echo esc_html( $credential ); ?></p>
        <?php endif; ?>

        <?php if ( $description ) : ?>
            <p class="cert-card__desc"><?php echo esc_html( wp_trim_words( $description, 18 ) ); ?></p>
        <?php endif; ?>

        <?php if ( $url ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" class="alfornon-mini-link" target="_blank" rel="noopener">Verify</a>
        <?php endif; ?>
    </div>
</article>

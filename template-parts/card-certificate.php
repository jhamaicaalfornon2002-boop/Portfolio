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
?>

<div class="cert-card">
    <?php if ( $cert_image ) : ?>
        <div class="cert-card__image">
            <img src="<?php echo esc_url( $cert_image['sizes']['certificate-thumb'] ?? $cert_image['url'] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
        </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
        <div class="cert-card__image">
            <?php the_post_thumbnail( 'certificate-thumb' ); ?>
        </div>
    <?php endif; ?>

    <div class="cert-card__body">
        <h3 class="cert-card__title"><?php the_title(); ?></h3>

        <?php if ( $issuer ) : ?>
            <p class="cert-card__issuer"><?php echo esc_html( $issuer ); ?></p>
        <?php endif; ?>

        <?php if ( $date ) : ?>
            <p class="cert-card__date"><?php echo esc_html( $date ); ?></p>
        <?php endif; ?>

        <?php if ( $credential ) : ?>
            <p class="cert-card__credential">ID: <?php echo esc_html( $credential ); ?></p>
        <?php endif; ?>

        <?php if ( $url ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" class="btn btn--small" target="_blank" rel="noopener">Verify</a>
        <?php endif; ?>
    </div>
</div>

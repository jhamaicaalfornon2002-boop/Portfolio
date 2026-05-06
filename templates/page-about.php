<?php
/**
 * Template Name: About Page
 *
 * @package DevPortfolio
 */

get_header();

$photo     = get_field( 'about_photo' );
$bio       = get_field( 'about_bio' );
$resume    = get_field( 'about_resume_file' );
$years     = get_field( 'about_years_exp' );
$projects  = get_field( 'about_projects_count' );
$clients   = get_field( 'about_clients_count' );
?>

<section class="section section--about">
    <div class="container">
        <h2 class="section__title">About Me</h2>
        <div class="about-grid">
            <?php if ( $photo ) : ?>
                <div class="about__photo">
                    <img src="<?php echo esc_url( $photo['url'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>">
                </div>
            <?php endif; ?>

            <div class="about__content">
                <?php if ( $bio ) : ?>
                    <div class="about__bio"><?php echo $bio; ?></div>
                <?php endif; ?>

                <?php if ( $years || $projects || $clients ) : ?>
                    <div class="about__stats">
                        <?php if ( $years ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( $years ); ?>+</span>
                                <span class="stat__label">Years Experience</span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $projects ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( $projects ); ?>+</span>
                                <span class="stat__label">Projects Completed</span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $clients ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( $clients ); ?>+</span>
                                <span class="stat__label">Happy Clients</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $resume ) : ?>
                    <a href="<?php echo esc_url( $resume ); ?>" class="btn btn--primary" target="_blank" rel="noopener">
                        Download Resume
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

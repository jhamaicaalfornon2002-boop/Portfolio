<?php
/**
 * Template: Front Page (Homepage)
 *
 * Displays hero section + featured works, skills, and certificates.
 * Set this page as your "Static Front Page" in Settings > Reading.
 *
 * @package DevPortfolio
 */

get_header();

// ─── Hero Section ────────────────────────────────────────────────────
$greeting   = get_field( 'hero_greeting' ) ?: 'Hello, I\'m';
$name       = get_field( 'hero_name' ) ?: get_bloginfo( 'name' );
$tagline    = get_field( 'hero_tagline' );
$desc       = get_field( 'hero_description' );
$image      = get_field( 'hero_image' );
$cta_text   = get_field( 'hero_cta_text' ) ?: 'View My Work';
$cta_link   = get_field( 'hero_cta_link' ) ?: '#works';
$github     = get_field( 'social_github' );
$linkedin   = get_field( 'social_linkedin' );
$email      = get_field( 'social_email' );
?>

<section class="hero" id="hero">
    <div class="container hero__grid">
        <div class="hero__content">
            <p class="hero__greeting"><?php echo esc_html( $greeting ); ?></p>
            <h1 class="hero__name"><?php echo esc_html( $name ); ?></h1>
            <?php if ( $tagline ) : ?>
                <p class="hero__tagline"><?php echo esc_html( $tagline ); ?></p>
            <?php endif; ?>
            <?php if ( $desc ) : ?>
                <p class="hero__desc"><?php echo esc_html( $desc ); ?></p>
            <?php endif; ?>

            <div class="hero__actions">
                <a href="<?php echo esc_url( $cta_link ); ?>" class="btn btn--primary"><?php echo esc_html( $cta_text ); ?></a>
                <?php if ( $github || $linkedin || $email ) : ?>
                    <div class="hero__socials">
                        <?php if ( $github ) : ?>
                            <a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener" aria-label="GitHub">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $linkedin ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $email ) : ?>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" aria-label="Email">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4l-10 8L2 4"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $image ) : ?>
            <div class="hero__image">
                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
// ─── Featured Works Section ─────────────────────────────────────────
$works = new WP_Query( array(
    'post_type'      => 'work',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<?php if ( $works->have_posts() ) : ?>
<section class="section section--works" id="works">
    <div class="container">
        <h2 class="section__title">Featured Works</h2>
        <p class="section__subtitle">Recent projects I've worked on</p>
        <div class="works-grid">
            <?php while ( $works->have_posts() ) : $works->the_post(); ?>
                <?php get_template_part( 'template-parts/card', 'work' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="section__cta">
            <a href="<?php echo get_post_type_archive_link( 'work' ); ?>" class="btn btn--outline">View All Works</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ─── Featured Skills Section ────────────────────────────────────────
$skills = new WP_Query( array(
    'post_type'      => 'skill',
    'posts_per_page' => 12,
    'meta_key'       => 'skill_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
) );
?>

<?php if ( $skills->have_posts() ) : ?>
<section class="section section--skills" id="skills">
    <div class="container">
        <h2 class="section__title">Skills & Tools</h2>
        <p class="section__subtitle">Technologies I work with</p>
        <div class="skills-grid">
            <?php while ( $skills->have_posts() ) : $skills->the_post(); ?>
                <?php get_template_part( 'template-parts/card', 'skill' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ─── Featured Certificates Section ──────────────────────────────────
$certs = new WP_Query( array(
    'post_type'      => 'certificate',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<?php if ( $certs->have_posts() ) : ?>
<section class="section section--certificates" id="certificates">
    <div class="container">
        <h2 class="section__title">Certificates</h2>
        <p class="section__subtitle">Certifications & achievements</p>
        <div class="certificates-grid">
            <?php while ( $certs->have_posts() ) : $certs->the_post(); ?>
                <?php get_template_part( 'template-parts/card', 'certificate' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="section__cta">
            <a href="<?php echo get_post_type_archive_link( 'certificate' ); ?>" class="btn btn--outline">View All Certificates</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>

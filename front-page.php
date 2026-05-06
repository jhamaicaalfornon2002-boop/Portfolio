<?php
/**
 * Template: Front Page (Homepage)
 *
 * @package DevPortfolio
 */

get_header();

// ─── Hero Section ───────────────────────────────────────────────
$image = get_field('hero_image');

$cta1_text = get_field('hero_cta1_text') ?: 'Explore My Works';
$cta1_link = get_field('hero_cta1_link') ?: '#works';

$cta2_text = get_field('hero_cta2_text') ?: "Let’s Connect";
$cta2_link = get_field('hero_cta2_link') ?: '#contact';

$github   = get_field('social_github');
$linkedin = get_field('social_linkedin');
$email    = get_field('social_email');
?>

<section
    class="hero"
    id="hero"
    style="<?php echo $image ? 'background-image:url(' . esc_url($image['url']) . ');' : ''; ?>"
>

    <div class="container hero__grid">

        <div class="hero__content">

            <?php /*
            <p class="hero__greeting"><?php echo esc_html($greeting); ?></p>
            <h1 class="hero__name"><?php echo esc_html($name); ?></h1>

            <?php if ($tagline) : ?>
                <p class="hero__tagline"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>

            <?php if ($desc) : ?>
                <p class="hero__desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
            */ ?>


            <!-- CTA BUTTONS -->
            <div class="hero__actions">

                <a href="<?php echo esc_url($cta1_link); ?>" class="btn btn--primary">
                    <?php echo esc_html($cta1_text); ?>
                </a>

                <a href="<?php echo esc_url($cta2_link); ?>" class="btn btn--outline">
                    <?php echo esc_html($cta2_text); ?>
                </a>

                <!-- SOCIALS -->
                <?php if ($github || $linkedin || $email) : ?>
                    <div class="hero__socials">

                        <?php if ($github) : ?>
                            <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener" aria-label="GitHub">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if ($linkedin) : ?>
                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if ($email) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="M22 4l-10 8L2 4"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
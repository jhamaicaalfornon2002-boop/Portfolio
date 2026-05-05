<?php
/**
 * Template: Front Page
 *
 * @package DevPortfolio
 */

get_header();

$asset_uri = get_template_directory_uri() . '/assets';

$desc     = get_field( 'hero_description' );
$image    = get_field( 'hero_image' );
$cta_text = get_field( 'hero_cta_text' ) ?: 'Explore My Work';
$cta_link = get_field( 'hero_cta_link' ) ?: '#works';

$hero_image_url = $image ? $image['url'] : $asset_uri . '/images/Me.png';

$about_pages = get_pages( array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/page-about.php',
) );
$about_page_id = ! empty( $about_pages ) ? $about_pages[0]->ID : 0;

$about_bio      = get_field( 'about_bio' ) ?: ( $about_page_id ? get_field( 'about_bio', $about_page_id ) : '' );
$about_resume   = get_field( 'about_resume_file' ) ?: ( $about_page_id ? get_field( 'about_resume_file', $about_page_id ) : '' );
$years_exp      = get_field( 'about_years_exp' );
$projects_count = get_field( 'about_projects_count' );
$clients_count  = get_field( 'about_clients_count' );

if ( $about_page_id ) {
    $years_exp      = '' !== (string) $years_exp ? $years_exp : get_field( 'about_years_exp', $about_page_id );
    $projects_count = '' !== (string) $projects_count ? $projects_count : get_field( 'about_projects_count', $about_page_id );
    $clients_count  = '' !== (string) $clients_count ? $clients_count : get_field( 'about_clients_count', $about_page_id );
}

$social_email    = get_field( 'social_email' );
$social_github   = get_field( 'social_github' );
$social_linkedin = get_field( 'social_linkedin' );

$contact_pages = get_pages( array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/page-contact.php',
) );
$contact_page_id    = ! empty( $contact_pages ) ? $contact_pages[0]->ID : 0;
$contact_heading    = $contact_page_id ? get_field( 'contact_heading', $contact_page_id ) : '';
$contact_desc       = $contact_page_id ? get_field( 'contact_description', $contact_page_id ) : '';
$contact_email      = $contact_page_id ? get_field( 'contact_email', $contact_page_id ) : '';
$contact_phone      = $contact_page_id ? get_field( 'contact_phone', $contact_page_id ) : '';
$contact_location   = $contact_page_id ? get_field( 'contact_location', $contact_page_id ) : '';
$contact_shortcode  = get_field( 'contact_form_shortcode' );
$contact_shortcode  = $contact_shortcode ?: ( $contact_page_id ? get_field( 'contact_form_shortcode', $contact_page_id ) : '' );

if ( ! $contact_shortcode ) {
    $cf7_forms = get_posts( array(
        'post_type'      => 'wpcf7_contact_form',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
    ) );

    if ( ! empty( $cf7_forms ) ) {
        $contact_shortcode = '[contact-form-7 id="' . absint( $cf7_forms[0]->ID ) . '" title="' . esc_attr( get_the_title( $cf7_forms[0]->ID ) ) . '"]';
    }
}

$contact_heading    = $contact_heading ?: 'Get In Touch';
$contact_desc       = $contact_desc ?: 'Have an exciting project or opportunity? Let\'s collaborate and create something meaningful.';
$contact_email      = $contact_email ?: $social_email;

$works_count = wp_count_posts( 'work' );
$cert_count  = wp_count_posts( 'certificate' );

$projects_total = '' !== (string) $projects_count ? $projects_count : ( $works_count->publish ?? 0 );
$certs_total    = $cert_count->publish ?? 0;
$years_total    = '' !== (string) $years_exp ? $years_exp : 3;
?>

<section id="home" class="alfornon-hero">
    <div class="alfornon-hero__media" aria-hidden="true">
        <img src="<?php echo esc_url( $hero_image_url ); ?>" alt="" class="alfornon-hero__img" />
        <div class="alfornon-hero__shade"></div>
    </div>

    <div class="alfornon-hero__content reveal-on-scroll">
        <?php if ( $desc ) : ?>
            <p class="alfornon-hero__desc"><?php echo esc_html( $desc ); ?></p>
        <?php endif; ?>
        <div class="alfornon-actions">
            <a href="<?php echo esc_url( $cta_link ); ?>" class="alfornon-btn alfornon-btn--primary"><?php echo esc_html( $cta_text ); ?></a>
            <a href="#contact" class="alfornon-btn alfornon-btn--light"><?php esc_html_e( 'Let\'s Connect', 'dev-portfolio' ); ?></a>
        </div>
    </div>
</section>

<section id="about" class="alfornon-section alfornon-section--about">
    <div class="alfornon-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" focusable="false">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>

    <div class="alfornon-container">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php esc_html_e( 'About Me', 'dev-portfolio' ); ?></h2>
            <span class="alfornon-rule"></span>
        </header>

        <div class="alfornon-about">
            <div class="alfornon-about__visual reveal-on-scroll">
                <div class="alfornon-profile-card">
                    <div class="alfornon-profile-card__avatar">
                        <span><?php echo esc_html( strtoupper( mb_substr( get_bloginfo( 'name' ), 0, 2 ) ) ); ?></span>
                    </div>
                    <div class="alfornon-profile-card__icons" aria-hidden="true">
                        <span>{ }</span>
                        <span>DB</span>
                        <span>UI</span>
                    </div>
                </div>
            </div>

            <div class="alfornon-about__copy reveal-on-scroll">
                <div class="alfornon-richtext">
                    <?php if ( $about_bio ) : ?>
                        <?php echo wp_kses_post( $about_bio ); ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'I build thoughtful digital experiences where clean functionality meets polished interface design.', 'dev-portfolio' ); ?></p>
                        <p><?php esc_html_e( 'My work blends full-stack development, user-focused design, and practical problem solving across modern web tools.', 'dev-portfolio' ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="alfornon-stats">
                    <div class="alfornon-stat">
                        <strong><?php echo esc_html( $projects_total ); ?>+</strong>
                        <span><?php esc_html_e( 'Projects', 'dev-portfolio' ); ?></span>
                    </div>
                    <div class="alfornon-stat alfornon-stat--warm">
                        <strong><?php echo esc_html( $certs_total ); ?>+</strong>
                        <span><?php esc_html_e( 'Certificates', 'dev-portfolio' ); ?></span>
                    </div>
                    <div class="alfornon-stat alfornon-stat--cool">
                        <strong><?php echo esc_html( $years_total ); ?>+</strong>
                        <span><?php esc_html_e( 'Years', 'dev-portfolio' ); ?></span>
                    </div>
                    <?php if ( '' !== (string) $clients_count && 0 < (int) $clients_count ) : ?>
                        <div class="alfornon-stat alfornon-stat--light">
                            <strong><?php echo esc_html( $clients_count ); ?>+</strong>
                            <span><?php esc_html_e( 'Clients', 'dev-portfolio' ); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ( $about_resume ) : ?>
                    <div class="alfornon-about__actions">
                        <a href="<?php echo esc_url( $about_resume ); ?>" class="alfornon-btn alfornon-btn--primary" download>
                            <?php esc_html_e( 'Download Resume', 'dev-portfolio' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$works = new WP_Query( array(
    'post_type'      => 'work',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="alfornon-section alfornon-section--works" id="works">
    <div class="alfornon-container">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php echo esc_html( get_field( 'works_archive_title', 'option' ) ?: 'Featured Works' ); ?></h2>
            <span class="alfornon-rule"></span>
            <p><?php echo esc_html( get_field( 'works_archive_subtitle', 'option' ) ?: 'A showcase of innovative projects blending creativity with technical excellence' ); ?></p>
        </header>

        <?php if ( $works->have_posts() ) : ?>
            <div class="works-grid alfornon-card-grid">
                <?php while ( $works->have_posts() ) : $works->the_post(); ?>
                    <?php get_template_part( 'template-parts/card', 'work' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="alfornon-section__cta">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'work' ) ); ?>" class="alfornon-btn alfornon-btn--outline"><?php esc_html_e( 'View All Works', 'dev-portfolio' ); ?></a>
            </div>
        <?php else : ?>
            <p class="alfornon-empty reveal-on-scroll"><?php esc_html_e( 'No works found. Add Work posts in WordPress to populate this section.', 'dev-portfolio' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php
$skills = new WP_Query( array(
    'post_type'      => 'skill',
    'posts_per_page' => -1,
    'orderby'        => array(
        'menu_order' => 'ASC',
        'title'      => 'ASC',
    ),
    'order'          => 'ASC',
) );
?>

<section class="alfornon-section alfornon-section--skills" id="skills">
    <div class="alfornon-container alfornon-container--narrow">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php esc_html_e( 'Skills & Expertise', 'dev-portfolio' ); ?></h2>
            <span class="alfornon-rule"></span>
        </header>

        <?php if ( $skills->have_posts() ) : ?>
            <div class="skills-grid">
                <?php while ( $skills->have_posts() ) : $skills->the_post(); ?>
                    <?php get_template_part( 'template-parts/card', 'skill' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <?php
            $fallback_skills = array(
                array(
                    'title' => 'Frontend Development',
                    'icon'  => '◎',
                    'level' => 92,
                ),
                array(
                    'title' => 'Backend Development',
                    'icon'  => '▤',
                    'level' => 88,
                ),
                array(
                    'title' => 'Mobile Development',
                    'icon'  => '▯',
                    'level' => 78,
                ),
                array(
                    'title' => 'UI/UX Design',
                    'icon'  => '◌',
                    'level' => 85,
                ),
            );
            ?>
            <div class="skills-grid">
                <?php foreach ( $fallback_skills as $index => $skill ) : ?>
                    <article class="skill-card skill-card--tone-<?php echo esc_attr( ( $index % 4 ) + 1 ); ?> reveal-on-scroll">
                        <div class="skill-card__head">
                            <div class="skill-card__icon skill-card__icon--placeholder">
                                <span><?php echo esc_html( $skill['icon'] ); ?></span>
                            </div>
                            <div class="skill-card__meta">
                                <h3 class="skill-card__title"><?php echo esc_html( $skill['title'] ); ?></h3>
                                <span class="skill-card__pct"><?php echo esc_html( $skill['level'] ); ?>%</span>
                            </div>
                        </div>

                        <div class="skill-card__bar">
                            <div class="skill-card__fill" data-percent="<?php echo esc_attr( $skill['level'] ); ?>"></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$certs = new WP_Query( array(
    'post_type'      => 'certificate',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="alfornon-section alfornon-section--certificates" id="certificates">
    <div class="alfornon-container">
        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php esc_html_e( 'Certificates & Awards', 'dev-portfolio' ); ?></h2>
            <span class="alfornon-rule"></span>
            <p><?php esc_html_e( 'Continuous learning and professional development milestones.', 'dev-portfolio' ); ?></p>
        </header>

        <?php if ( $certs->have_posts() ) : ?>
            <div class="certificates-grid alfornon-card-grid">
                <?php while ( $certs->have_posts() ) : $certs->the_post(); ?>
                    <?php get_template_part( 'template-parts/card', 'certificate' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="alfornon-section__cta">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'certificate' ) ); ?>" class="alfornon-btn alfornon-btn--outline"><?php esc_html_e( 'View All Certificates', 'dev-portfolio' ); ?></a>
            </div>
        <?php else : ?>
            <p class="alfornon-empty reveal-on-scroll"><?php esc_html_e( 'Add Certificate posts to populate this section.', 'dev-portfolio' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="alfornon-section alfornon-section--contact" id="contact">
    <div class="alfornon-container">
        <header class="alfornon-contact-head reveal-on-scroll">
            <h2><?php echo esc_html( $contact_heading ); ?></h2>
            <span class="alfornon-rule alfornon-rule--light"></span>
            <p><?php echo esc_html( $contact_desc ); ?></p>
        </header>

        <div class="alfornon-contact-grid">
            <div class="alfornon-contact-card reveal-on-scroll">
                <?php if ( isset( $_GET['contact_status'] ) ) : ?>
                    <?php $contact_status = sanitize_key( wp_unslash( $_GET['contact_status'] ) ); ?>
                    <?php if ( 'sent' === $contact_status ) : ?>
                        <p class="alfornon-form-status alfornon-form-status--success"><?php esc_html_e( 'Message sent successfully.', 'dev-portfolio' ); ?></p>
                    <?php elseif ( 'failed' === $contact_status || 'invalid' === $contact_status ) : ?>
                        <p class="alfornon-form-status alfornon-form-status--error"><?php esc_html_e( 'Please check your details and try again.', 'dev-portfolio' ); ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ( $contact_shortcode ) : ?>
                    <div class="alfornon-cf7-form">
                        <?php echo do_shortcode( $contact_shortcode ); ?>
                    </div>
                <?php else : ?>
                    <form class="alfornon-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                        <input type="hidden" name="action" value="devportfolio_contact_form">
                        <?php wp_nonce_field( 'devportfolio_contact_form', 'devportfolio_contact_nonce' ); ?>

                        <div class="alfornon-form-row">
                            <label>
                                <span><?php esc_html_e( 'Name', 'dev-portfolio' ); ?></span>
                                <input type="text" name="contact_name" placeholder="<?php esc_attr_e( 'Your name', 'dev-portfolio' ); ?>" required>
                            </label>
                            <label>
                                <span><?php esc_html_e( 'Email', 'dev-portfolio' ); ?></span>
                                <input type="email" name="contact_email" placeholder="<?php esc_attr_e( 'your@email.com', 'dev-portfolio' ); ?>" required>
                            </label>
                        </div>

                        <label>
                            <span><?php esc_html_e( 'Message', 'dev-portfolio' ); ?></span>
                            <textarea name="contact_message" rows="6" placeholder="<?php esc_attr_e( 'Tell me about your project or idea...', 'dev-portfolio' ); ?>" required></textarea>
                        </label>

                        <button type="submit" class="alfornon-contact-submit"><?php esc_html_e( 'Send Message', 'dev-portfolio' ); ?></button>
                    </form>
                <?php endif; ?>
            </div>

            <aside class="alfornon-contact-info reveal-on-scroll">
                <?php if ( $contact_email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="alfornon-contact-item">
                        <span>@</span>
                        <strong><?php esc_html_e( 'Email', 'dev-portfolio' ); ?></strong>
                        <em><?php echo esc_html( $contact_email ); ?></em>
                    </a>
                <?php endif; ?>
                <?php if ( $contact_phone ) : ?>
                    <a href="tel:<?php echo esc_attr( $contact_phone ); ?>" class="alfornon-contact-item">
                        <span>PH</span>
                        <strong><?php esc_html_e( 'Phone', 'dev-portfolio' ); ?></strong>
                        <em><?php echo esc_html( $contact_phone ); ?></em>
                    </a>
                <?php endif; ?>
                <?php if ( $contact_location ) : ?>
                    <div class="alfornon-contact-item">
                        <span>LO</span>
                        <strong><?php esc_html_e( 'Location', 'dev-portfolio' ); ?></strong>
                        <em><?php echo esc_html( $contact_location ); ?></em>
                    </div>
                <?php endif; ?>

                <div class="alfornon-socials">
                    <?php if ( $social_github ) : ?>
                        <a href="<?php echo esc_url( $social_github ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'GitHub', 'dev-portfolio' ); ?>">GH</a>
                    <?php endif; ?>
                    <?php if ( $social_linkedin ) : ?>
                        <a href="<?php echo esc_url( $social_linkedin ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'LinkedIn', 'dev-portfolio' ); ?>">IN</a>
                    <?php endif; ?>
                    <?php if ( $contact_email ) : ?>
                        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" aria-label="<?php esc_attr_e( 'Email', 'dev-portfolio' ); ?>">@</a>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

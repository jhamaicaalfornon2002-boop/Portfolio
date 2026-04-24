</main><!-- .site-main -->

<?php
// Pull contact/social data from the front page ACF fields
$front_page_id = get_option( 'page_on_front' );
$footer_email    = get_field( 'social_email', $front_page_id );
$footer_github   = get_field( 'social_github', $front_page_id );
$footer_linkedin = get_field( 'social_linkedin', $front_page_id );
$footer_twitter  = get_field( 'social_twitter', $front_page_id );

// Pull contact page data
$contact_pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/page-contact.php' ) );
$contact_page_id = ! empty( $contact_pages ) ? $contact_pages[0]->ID : 0;
$footer_phone    = $contact_page_id ? get_field( 'contact_phone', $contact_page_id ) : '';

// Get recent works
$footer_works = new WP_Query( array(
    'post_type'      => 'work',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <!-- Column 1: Logo & Tagline -->
            <div class="footer-col footer-col--brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="footer-logo__text"><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </a>
                <p class="footer-tagline"><?php bloginfo( 'description' ); ?></p>
            </div>

            <!-- Column 2: Recent Works -->
            <div class="footer-col footer-col--works">
                <h4 class="footer-col__title">Works</h4>
                <?php if ( $footer_works->have_posts() ) : ?>
                    <ul class="footer-links">
                        <?php while ( $footer_works->have_posts() ) : $footer_works->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'work' ) ); ?>" class="footer-view-all">View All Works &rarr;</a>
                <?php else : ?>
                    <p class="footer-empty">No works yet.</p>
                <?php endif; ?>
            </div>

            <!-- Column 3: Contact Info -->
            <div class="footer-col footer-col--contact">
                <h4 class="footer-col__title">Contact</h4>
                <ul class="footer-contact">
                    <?php if ( $footer_email ) : ?>
                        <li>
                            <span class="footer-contact__icon">&#9993;</span>
                            <a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $footer_phone ) : ?>
                        <li>
                            <span class="footer-contact__icon">&#9742;</span>
                            <a href="tel:<?php echo esc_attr( $footer_phone ); ?>"><?php echo esc_html( $footer_phone ); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if ( $footer_github || $footer_linkedin || $footer_twitter || $footer_email ) : ?>
                    <div class="footer-socials">
                        <?php if ( $footer_github ) : ?>
                            <a href="<?php echo esc_url( $footer_github ); ?>" target="_blank" rel="noopener" aria-label="GitHub">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $footer_linkedin ) : ?>
                            <a href="<?php echo esc_url( $footer_linkedin ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $footer_twitter ) : ?>
                            <a href="<?php echo esc_url( $footer_twitter ); ?>" target="_blank" rel="noopener" aria-label="Twitter / X">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $footer_email ) : ?>
                            <a href="mailto:<?php echo esc_attr( $footer_email ); ?>" aria-label="Email">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4l-10 8L2 4"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

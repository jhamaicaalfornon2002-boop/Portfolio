<?php
/**
 * Single: Work
 *
 * @package DevPortfolio
 */

get_header();

$client       = get_field( 'work_client' );
$date         = get_field( 'work_date' );
$live_url     = get_field( 'work_url' );
$github_url   = get_field( 'work_github_url' );
$technologies = devportfolio_parse_lines( get_field( 'work_technologies' ) );
$gallery      = devportfolio_get_work_gallery();
$categories   = get_the_terms( get_the_ID(), 'work_category' );
?>

<article class="alfornon-section">
    <div class="alfornon-container">
        <a href="<?php echo get_post_type_archive_link( 'work' ); ?>" class="alfornon-mini-link">&larr; Back to Works</a>

        <header class="alfornon-section__head reveal-on-scroll">
            <h2><?php the_title(); ?></h2>
            <span class="alfornon-rule"></span>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="alfornon-card-grid" style="grid-template-columns: 1fr; margin-bottom: 56px;">
                <div style="border-radius: 28px; overflow: hidden; box-shadow: var(--alfornon-shadow);">
                    <?php the_post_thumbnail( 'portfolio-full' ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="alfornon-contact-grid" style="align-items: start;">
            <div class="alfornon-richtext">
                <?php the_content(); ?>
            </div>

            <aside style="min-width: 280px;">
                <?php if ( $technologies ) : ?>
                    <div class="skill-card" style="margin-bottom: 24px;">
                        <h4 style="margin: 0 0 16px; color: var(--alfornon-teal); font-size: 1.1rem; font-weight: 900;">Technologies</h4>
                        <div class="work-card__tech">
                            <?php foreach ( $technologies as $tech ) : ?>
                                <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="skill-card">
                    <h4 style="margin: 0 0 16px; color: var(--alfornon-teal); font-size: 1.1rem; font-weight: 900;">Links</h4>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <?php if ( $live_url ) : ?>
                            <a href="<?php echo esc_url( $live_url ); ?>" class="alfornon-btn alfornon-btn--primary" target="_blank" rel="noopener">View Live Site</a>
                        <?php endif; ?>
                        <?php if ( $github_url ) : ?>
                            <a href="<?php echo esc_url( $github_url ); ?>" class="alfornon-btn alfornon-btn--outline" target="_blank" rel="noopener">View on GitHub</a>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>
        </div>

        <?php if ( $gallery ) : ?>
            <div style="margin-top: 72px;">
                <header class="alfornon-section__head" style="margin-bottom: 48px;">
                    <h3 style="margin: 0; color: var(--alfornon-teal); font-size: 2.5rem; font-weight: 900;">Project Gallery</h3>
                </header>
                <div class="alfornon-card-grid">
                    <?php foreach ( $gallery as $img ) : ?>
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: var(--alfornon-shadow);">
                            <img src="<?php echo esc_url( $img['sizes']['portfolio-full'] ?? $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" style="width: 100%; height: auto; display: block;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <nav class="alfornon-section__cta" style="margin-top: 72px;">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <?php if ( $prev ) : ?>
                    <a href="<?php echo get_permalink( $prev ); ?>" class="alfornon-btn alfornon-btn--outline">&larr; <?php echo esc_html( $prev->post_title ); ?></a>
                <?php endif; ?>
                <?php if ( $next ) : ?>
                    <a href="<?php echo get_permalink( $next ); ?>" class="alfornon-btn alfornon-btn--outline"><?php echo esc_html( $next->post_title ); ?> &rarr;</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</article>

<?php get_footer(); ?>

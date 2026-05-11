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
$years     = get_field( 'elementary' );
$projects  = get_field( 'high_school' );
$clients   = get_field( 'college' );
$phone     = get_field('phone_number');
$email     = get_field('email_address');
$image     = get_field('about_image');
$location  = get_field('location');
$github    = get_field('github');
$linkedin  = get_field('linkedin');
$facebook  = get_field('facebook');
$fullname  = get_field('full_name');
$facebook_image  = get_field('facebook_image');
$linkedin_image  = get_field('linkedin_image');
$github_image    = get_field('github_image');

?>

<section
    class="about-image"
    id="about-image"
    style="<?php echo $image ? 'background-image:url(' . esc_url($image['url']) . ');' : ''; ?>"
>

<section class="section section--about">
    <div class="container">
        <h2 class="section__title">About Me</h2>
        <div class="about-grid">
            <div class="about__left-column">
                <?php if ( $photo ) : ?>
                    <div class="about__photo-card">
                        <div class="about__photo-wrapper">
                            <img src="<?php echo esc_url( $photo['url'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>">
                        </div>
                        <div class="about__photo-dots">
                            <span></span><span></span><span></span><span></span>
                            <span></span><span></span><span></span><span></span>
                            <span></span><span></span><span></span><span></span>
                            <span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if($fullname): ?>
                <div class="about__name">
                    <?php echo esc_html($fullname); ?>
                </div>
                <?php endif; ?>
                
                <div class="about__social-row">
                    <?php if( get_field('facebook_url') && !empty($facebook_image['url']) ): ?>
                        <a href="<?php the_field('facebook_url'); ?>" target="_blank" class="social-img-link">
                            <img src="<?php echo esc_url($facebook_image['url']); ?>" alt="Facebook" class="social-img">
                        </a>
                    <?php endif; ?>

                    <?php if( get_field('linkedin_url') && !empty($linkedin_image['url']) ): ?>
                        <a href="<?php the_field('linkedin_url'); ?>" target="_blank" class="social-img-link">
                            <img src="<?php echo esc_url($linkedin_image['url']); ?>" alt="LinkedIn" class="social-img">
                        </a>
                    <?php endif; ?>

                    <?php if( get_field('github_url') && !empty($github_image['url']) ): ?>
                        <a href="<?php the_field('github_url'); ?>" target="_blank" class="social-img-link">
                            <img src="<?php echo esc_url($github_image['url']); ?>" alt="GitHub" class="social-img">
                        </a>
                    <?php endif; ?>
                </div>

                <div class="about__contact-info">
                    <?php if($phone): ?>
                    <div class="contact-item">
                        <i class="fas fa-mobile-alt"></i>
                        <div class="contact-text">
                            <span>Phone</span>
                            <strong><?php echo esc_html($phone); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($email): ?>
                    <div class="contact-item">
                        <i class="far fa-envelope"></i>
                        <div class="contact-text">
                            <span>Email</span>
                            <strong><?php echo esc_html($email); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($location): ?>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-text">
                            <span>Location</span>
                            <strong><?php echo esc_html($location); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="about__right-column">
                <div class="about__content">
                <?php if ( $bio ) : ?>
                    <div class="about__bio"><?php echo $bio; ?></div>
                <?php endif; ?>

                <?php if ( $years || $projects || $clients ) : ?>
                    <div class="about__stats">
                        <?php if ( $years ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( $years ); ?>+</span>
                                <span class="stat__label">Elementary</span>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_field('high_school') ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( get_field('high_school') ); ?>+</span>
                                <span class="stat__label">High School</span>
                            </div>
                        <?php else: ?>
                            <!-- Debug: high_school field is empty or not set -->
                        <?php endif; ?>
                        <?php if ( $clients ) : ?>
                            <div class="stat">
                                <span class="stat__number"><?php echo esc_html( $clients ); ?>+</span>
                                <span class="stat__label">College</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
</div>

                <?php if ( $resume ) : ?>
                    <a href="<?php echo esc_url( is_array($resume) ? $resume['url'] : $resume ); ?>" 
                    class="btn btn--primary" 
                    target="_blank" 
                    rel="noopener">
                        Download Resume
                    </a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

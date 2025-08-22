<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dexter_Organization_Theme
 */

get_header(); ?>
    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div>
                <div class="col-md-4">
                    <h3 class="text-center">ऐतिहासिक तस्बीरहरू</h3>
                    <hr>
                    <div class="historical-images padding-top-15" id="historical-images">
                        <?php 
                            $args = array( 'posts_per_page' => 5,'orderby' => 'date','order'  => 'DESC', 'category' => 12 );
                            $posts = get_posts( $args );
                            foreach ( $posts as $post ) : setup_postdata( $post ); 
                        ?>
                        <div class="item">
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" rel="prettyPhoto">
                                    <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" alt="<?php the_title(); ?>" class="img-responsive">
                                </a>
                                </div>
                                <div class="panel-footer">
                                    <h4 class="text-center"><i class="fa fa-image"></i> <?php the_title(); ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endforeach; 
                            wp_reset_postdata(); 
                        ?>
                    </div>

                    <div class="fb-page" data-href="<?php echo toz_option('Facebook' , '59493617224'); ?>" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo toz_option('Facebook' , '59493617224'); ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo toz_option('Facebook' , '59493617224'); ?>">Facebook</a></blockquote></div>
                </div>
        </div>
    </div>

<?php
get_footer();

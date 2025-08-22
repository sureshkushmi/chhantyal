<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			get_template_part( 'template-parts/content','single' );

			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>


		<div class="related-posts-container margin-top-15">
		<h3>सम्बन्धित लेखहरु</h3>
		<hr>
		<div class="row">
		<?php
		// Default arguments
		$args = array(
			'posts_per_page' => 3, // How many items to display
			'post__not_in'   => array( get_the_ID() ), // Exclude current post
			'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
		);

		// Check for current post category and add tax_query to the query arguments
		$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
		$cats_ids = array();  
		foreach( $cats as $wpex_related_cat ) {
			$cats_ids[] = $wpex_related_cat->term_id; 
		}
		if ( ! empty( $cats_ids ) ) {
			$args['category__in'] = $cats_ids;
		}

		// Query posts
		$wpex_query = new wp_query( $args );

		// Loop through posts
		foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
		
			<div class="col-md-4 related-container-each">
				<img src="<?php bloginfo("url"); ?>/resize.php?src=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>&w=230&h=155" class="img-responsive resp-image">
				<h4><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h4>
			</div>
		<?php
		// End loop
		endforeach;

		// Reset post data
		wp_reset_postdata(); ?>
		</div>
	</div>

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

<?php get_header(); ?>

<section id="main">
	
	<br />
	
	<section id="page">
		<header>
			<?php
				$post = $posts[0];
				$term_generator = get_the_terms($post->ID, 'series');
				$term = array_values($term_generator)[0];
			?>

			<?php share_buttons(); ?>
			<?php js_breadcrumbs($post->ID); ?>
			
			<?php echo '<h1 class="bit">'.__('Sermon Archive','glory').'</h1>'; ?>

                        <?php
                            $src = z_taxonomy_image_url($term->term_id, 'full');
                            if ($src) {
                                echo '<img style="width:300px; height:150px;" src="' . $src . '"> </img>';
                            }
                        ?>
			
		</header>

	<article id="content" class="left">

		<?php if ( have_posts() ) : ?>
		
			<ul class="recent-sermons"><?php
        global $temp_counter; $temp_counter = 0; while ( have_posts() ) : the_post(); global $post; $temp_counter++;
		  ?>
				
				<li>
					<?php if (has_post_thumbnail($post->ID)){ ?>
					<div class="thumb left">
						<a href="<?php the_permalink(); ?>" class="thumb-link">
							<?php echo get_the_post_thumbnail($post->ID,'post-thumbnail'); ?>
						</a>
					</div>
					<?php } ?>
					<div class="entry<?php if (has_post_thumbnail($post->ID)){ ?> right<?php } ?>">
          <h3 class="bit"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <h6><?php 	
          printf( __( '<span class="%1$s">Preached on</span> %2$s %3$s <span class="meta-sep">by</span> %4$s', 'twentyten' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
              get_permalink(),
              esc_attr( get_the_time() ),
              get_the_date()
            ),
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
              get_author_posts_url( get_the_author_meta( 'ID' ) ),
              sprintf( esc_attr__( 'View all sermons from %3s', 'twentyten' ), get_the_author() ),
              get_the_term_list( $post->ID, 'service', '', ', ', '' )
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
              get_author_posts_url( get_the_author_meta( 'ID' ) ),
              sprintf( esc_attr__( 'View all sermons by %s', 'twentyten' ), get_the_author() ),
              get_the_term_list( $post->ID, 'preacher', '', ', ', '' )
            )
          ); ?></h6>
            <h6>
              <?php
                $passage_list = get_the_term_list( $post->ID, 'passage', '', ', ', '' );
                if ( $passage_list ):
              ?>
                <span class="tag-links">
                  <?php printf( __( '<span class="%1$s">Passage:</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $passage_list ); ?>
                </span>
                <span class="meta-sep">|</span>
              <?php endif; ?>

              <?php
                $series_list = get_the_term_list( $post->ID, 'series', '', ', ', '' );
                if ( $series_list ):
              ?>
                <span class="tag-links">
                  <?php printf( __( '<span class="%1$s">Series:</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $series_list ); ?>
                </span>
                <span class="meta-sep">|</span>
              <?php endif; ?>

              <?php
                $label_list = get_the_term_list( $post->ID, 'label', '', ', ', '' );
                if ( $label_list ):
              ?>
                <span class="label-links">
                  <?php printf( __( '<span class="%1$s">Labeled:</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $label_list ); ?>
                </span>
                <span class="meta-sep">|</span>
              <?php endif; 
              edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span> <span class="meta-sep">|</span>' ); ?>
            </h6>
            <?php the_content(); ?>
					</div>
				</li><?php

			endwhile; ?></ul>
			
		<?php endif; ?>
			
			<?php js_get_pagination(); wp_reset_query(); ?>
			
			</article>

			<section id="sidebar" class="right">
				<?php get_sidebar(); ?>				
			</section>
			
			<div class="cl"></div>
			
		</section>
	</section>

<?php get_footer(); ?>

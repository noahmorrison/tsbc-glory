<?php get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section id="main">
		
		<?php
		$featured_caption = get_the_title(get_post_thumbnail_id(get_the_ID()));
		$featured_image = get_the_post_thumbnail($post->ID,'page-banner', array('title'=>$featured_caption));
	
		if ($featured_image){
			echo '<section id="featured-image">'.$featured_image.'</section>';
		} else {
			echo '<br />';
		}

		
		?>
	
		<section id="page">
			<header>
                                <?php
                                  $term_generator = get_the_terms($post->ID, 'series');
                                  $term = array_values($term_generator)[0];
                                ?>

				<?php share_buttons(); ?>
                                <p id="breadcrumbs">
                                    <a href="<?php echo home_url() ?>">Home</a>
                                    &nbsp;&gt;&nbsp;
                                    <a href="<?php echo home_url(); echo '/series/'; echo $term->slug; ?>"><?php echo $term->name; ?></a>
                                    &nbsp;&gt;&nbsp;
                                    <?php echo $post->post_title; ?>
                                </p>

                                <img style="width:300px; height:150px;" src="<?php echo z_taxonomy_image_url($term->term_id, 'thumbnail'); ?>"> </img>
				<h1 class="bit"><?php the_title(); ?></h2>
			</header>

			<article id="content" <?php post_class('left'); ?>>
        <h6>
          <?php 	
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
    ); ?>
        </h6>


        <h6 class="entry-utility">
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
        </h6><!-- .entry-utility -->
				<?php the_content(); ?>
				<?php comments_template(); ?>
			</article>

			<section id="sidebar" class="right">
				<?php get_sidebar(); ?>				
			</section>
			
			<div class="cl"></div>
			
		</section>
	</section>
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>

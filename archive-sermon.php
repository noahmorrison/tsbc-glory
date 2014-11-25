<?php get_header(); ?>

<section id="main">

    <br />

    <section id="page">
        <header>

            <?php $post = $posts[0]; ?>
            <?php share_buttons(); ?>
            <?php js_breadcrumbs($post->ID); ?>

            <?php echo '<h1 class="bit">'.__('Sermon Archive','glory').'</h1>'; ?>

        </header>

    <!-- Sermon content -->
    <article id="content" class="left">
        <?php if (have_posts()): ?>

            <ul class="recent-sermons">
            <?php
              global $temp_counter; $temp_counter = 0; while ( have_posts() ) : the_post(); global $post; $temp_counter++;
            ?>

            <li>
                <!-- Thumbnail -->
                <?php if (has_post_thumbnail($post->ID)): ?>
                    <div class="thumb left">
                        <a href="<?php the_permalink(); ?>" class="thumb-link">
                            <?php echo get_the_post_thumbnail($post->ID,'post-thumbnail'); ?>
                        </a>
                    </div>

                <!-- Start entry -->
                    <div class="entry right">
                <?php else: ?>
                    <div class="entry">
                <?php endif ?>

            <!-- Title -->
            <h3 class="bit">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <!-- Info line one -->
            <h6>
                <?php
                    /*-- Timestamp --*/
                    echo '<span>Preached on </span>';
                    echo '<a href=' . get_permalink() . ' title=' . get_the_time() . ' rel="bookmark">';
                    echo '<span class="entry-date">' . get_the_date() . '</span></a>';
                    echo '<span> during the </span>';
                    echo get_the_term_list( $post->ID, 'service', '', ', ', '' );

                    /*-- Preacher --*/
                    echo '<span class="meta-sep"> by </span>';
                    echo get_the_term_list( $post->ID, 'preacher', '', ', ', '' );
                ?>
            </h6>

            <!-- Info line two -->
            <h6>
                
                <?php
                $items = array('passage', 'series', 'label');
                foreach ($items as $item):
                    $terms = get_the_term_list( $post->ID, $item, '', ', ', '' );
                    if ( $terms ):
                ?>
                    <span class="tag-links">
                        <?php echo '<span>' . ucfirst($item) . ': </span>' . $terms ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; endforeach; ?>

              <?php edit_post_link('edit', '', '', $post->ID) ?>
            </h6>

            <!-- Content -->
            <?php the_content(); ?>

            <!-- End entry -->
            </div> </li>

            <?php endwhile; ?>
            </ul>

        <!-- End if posts -->
        <?php endif; ?>

        <!-- Pageination -->
        <?php js_get_pagination(); wp_reset_query(); ?>

    <!-- End sermon content -->
    </article>

    <!-- Sidebar -->
    <section id="sidebar" class="right">
        <?php get_sidebar(); ?>
    </section>

    <!-- TODO: what is this? -->
    <div class="cl"></div>

    <!-- End page -->
    </section>
<!-- End main -->
</section>

<?php get_footer(); ?>

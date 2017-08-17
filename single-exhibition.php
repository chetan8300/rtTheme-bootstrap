<?php
/*
Template Name: Exhibition
Template Post Type: post
*/

get_header(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-default">
                       <?php if (have_posts()) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" class="post">
                                    <div class="panel-heading text-center">
                                        <h3>
                                            <?php echo the_title(); ?>
                                        </h3>
                                    </div>
                                    <p class="meta">
                                        Posted At:
                                        <?php the_time(); ?> on
                                        <?php the_date(); ?> by
                                        <strong><?php the_author();?></strong>
                                    </p>
                                    <div class="panel-body">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php echo the_permalink(); ?>">
                                                <div class="post-thumbnail">
                                                    <?php the_post_thumbnail(); ?>
                                                </div>
                                            </a>
                                        <?php endif;?>
                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <article>
                                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                            </article>
                        <?php endif; ?> 
                    </div>
                </div>
                <div class="col-md-4">
                    <?php if(is_active_sidebar('Sidebar')) : ?>
                        <?php dynamic_sidebar('sidebar'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
get_footer();

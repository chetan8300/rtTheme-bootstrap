
<?php get_header(); ?>
	<div class="container index">
		<div class="row">
                    <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title text-center">Blog Posts</h3>
                                </div>
                                <div class="panel-body">
                                    <?php if(have_posts()): ?>
                                        <?php while(have_posts()) : the_post(); ?>
                                            <article class="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2>
                                                            <a href="<?php echo the_permalink();?>">
                                                                <?php echo the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <p class="meta">
                                                            Posted At:
                                                            <?php the_time(); ?> on
                                                            <?php the_date(); ?> by
                                                            <strong><?php the_author();?></strong>
                                                        </p>
                                                           
                                                        <?php if(has_post_thumbnail()) :?>
                                                        <div class="post-thumbnail">
                                                            <?php the_post_thumbnail();?>
                                                        </div>
                                                        <?php endif;?>
                                                        
                                                        <br>
                                                        
                                                        <div class="content">
                                                            <?php echo the_content();?>
                                                        </div>

                                                        <br>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if(is_active_sidebar('Sidebar')) : ?>
                                <?php dynamic_sidebar('sidebar'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
		</div>
<?php get_footer(); ?>
	
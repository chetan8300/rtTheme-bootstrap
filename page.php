
<?php get_header(); ?>
	<div class="container index">
<!--		<div class="row">
                    <div class="col-md-8">-->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php if(have_posts()): ?>
                                        <?php while(have_posts()) : the_post(); ?>
                                            <article class="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="text-center">
                                                            <?php echo the_title(); ?>
                                                        </h2>
                                                        <div class="row">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <?php if(has_post_thumbnail()): ?>
                                                                    <div class="post-thumbnail">
                                                                        <?php the_post_thumbnail(); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="content">
                                                                    <?php echo the_content();?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
<!--                        </div>
                    </div>-->
		</div>
<?php get_footer(); ?>
	
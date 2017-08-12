
<?php get_header(); ?>
        <?php $slide_query = new WP_Query(array(
            'category_name' =>  'slideshow',
            'order_by'  => 'date',
            'order' => 'DESC'
        )); ?>
    <div id="slider-container" class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                $i = 0;
                while($slide_query->have_posts()): 
                    $slide_query->the_post();
                    $i++;
                ?>
                <?php if($i==1) :?>
                    <div class="item active">
                <?php else :?>
                    <div class="item">
                <?php endif; ?>
                    <?php if(has_post_thumbnail()):?>
                        <div class="text-center">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="carousel-caption">
                        <a href="<?php echo the_permalink();?>"><h2><?php the_title(); ?></h2></a>
                        <?php the_excerpt(); ?>
                        <div class="text-center">
                            <a class="btn btn-primary btn-sm" href="<?php echo the_permalink(); ?>">
                                Read More <span class="glyphicon glyphicon-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
        <br>
    </div>
    
    <div class="container index">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title text-center">Blog Posts</h3>
                        </div>
                        <div class="panel-body">
                            <?php if(have_posts()): ?>
                                <?php while(have_posts()) : 
                                    the_post(); 
                                ?>
                                    <article class="post">
                                        <div class="row">
                                            <?php if(has_post_thumbnail()): ?>
                                                <div class="col-md-4">
                                                    <div class="post-thumbnail">
                                                        <?php the_post_thumbnail(); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
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

                                                    <div class="excerpt">
                                                        <?php echo get_the_excerpt();?>
                                                    </div>

                                                    <br>

                                                    <div class="text-right">
                                                        <a class="btn btn-primary btn-lg" href="<?php echo the_permalink(); ?>">
                                                            Read More <span class="glyphicon glyphicon-forward"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php else: ?>
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

                                                    <div class="excerpt">
                                                        <?php echo get_the_excerpt();?>
                                                    </div>

                                                    <br>

                                                    <div class="text-right">
                                                        <a class="btn btn-primary btn-lg" href="<?php echo the_permalink(); ?>">
                                                            Read More <span class="glyphicon glyphicon-forward"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                <?php endwhile; 
                                    if ($wp_query->max_num_pages > 1) :   
                                        wpc_pagination();  
                                    endif;  
                                ?>
                            <?php endif; ?>
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
	
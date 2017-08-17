<?php get_header(); ?>
        <?php $slide_query = new WP_Query(array(
            'category_name' =>  'slideshow',
            'order_by'  => 'date',
            'order' => 'DESC'
        )); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="slider-container">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
            </div>
        <!--</div>-->
        <div class="col-md-4">
            <?php 
                $page_id = get_option('page_id_show');
                $pages = get_pages( $page_id );
            ?>
            <?php foreach ($pages as $page):?>
                <?php if($page->ID == $page_id) : ?>
                    <h2><?php echo $page->post_title; ?></h2>
                    <p>
                        <?php echo substr($page->post_content, 0, 650); ?>
                    </p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
        
</div>
<br><br>
<div class="container">
    <!--container for youtube slider-->
</div>

    <div class="container index">
        <div class="row">
            <div class="col-md-8">
                
                <!-- Displaying Custom Post Type Exhibition Start -->
                <?php 
                    $args = array('post_type' => 'exhibition', 'posts_per_page' => 8);
                    $the_query = new WP_Query($args);
                ?>
                <div class="panel-default">
                    <?php if ($the_query->have_posts()) : ?>
                        <div class="panel-heading">Glimpses of Exhibition</div>
                        <div class="panel-body">
                            <div class="row">
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <div class="col-md-3">
                                        <article class="post">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="post-thumbnail" style="border:1px solid black; ">
                                                        <?php the_post_thumbnail(); ?>
                                                    </div>
                                                </a>
                                            <?php endif;?>
                                            <h4>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                        </article>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Displaying Custom Post Type Exhibition End -->
                
                
                <!-- Displaying Latest Tweets and Facebook Like Box Start -->
                
                <div class="row">
                    <div class="col-md-6">
                        <!--This will show latest tweets--> 
                        <div class="panel-default">
                            <div class="panel-heading">
                                Latest Tweets
                            </div>
                            <div class="panel-body">
                                <?php if(get_option('twitter_customer_key') != '') :?>
                                    <?php require_once 'theme-options/twitter.php';?>
                                <?php else: 
                                    echo 'Twitter Variables Not Set';
                                ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--This will show Facebook Like Box--> 
                        <div class="panel-default">
                            <div class="panel-heading">
                                Facebook Page Like Box
                            </div>
                            <?php
                                $rttheme_options = get_option('theme_rttheme_options');
                                if ( !empty(get_option('facebook_username')) ) :
                            ?>
                            <div class="panel-body">
                                <div id="fb-root"></div>
                                <script>
                                (function(d, s, id) {
                                      var js, fjs = d.getElementsByTagName(s)[0];
                                      if (d.getElementById(id)) return;
                                      js = d.createElement(s); js.id = id;
                                      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
                                      fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));
                                </script>
                                <div class="fb-page" data-href="https://www.facebook.com/<?php echo get_option('facebook_username');?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/<?php echo $rttheme_options['facebook_username'];?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?php echo get_option('facebook_username');?>"><?php echo get_option('facebook_username');?></a></blockquote></div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                
                <!-- Displaying Latest Tweets and Facebook Like Box End -->
                
            </div>
            <div class="col-md-4">
                <div class="panel-default">
                    <div class="panel-heading">
                        News
                    </div>
                    <div class="panel-body">
                        <?php 
                            $sticky_post = new WP_Query(array(
                                'post_type' => 'post',
                                'post__in'  => get_option( 'sticky_posts' ),
                                'posts_per_page' => 2
                            ));
                        ?>
                        <div class="row">
                            <?php
                                $j = 0;
                                while($sticky_post->have_posts()):
                                    $sticky_post->the_post();
                                    $j++;
                                    if($j != 1){ break; }
                            ?>
                            <div class="col-md-4">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="col-md-8">
                                <?php the_title(); ?>
                                <br><br>
                                <?php the_date(); ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <br>
                        <div class="panel-default">
                            <?php
                                $news = new WP_Query(array(
                                        'category_name' => 'news',
                                        'order_by' => 'date',
                                    ));
                            ?>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <!-- News Category Posts will be shown here -->
                                    <?php
                                        while($news->have_posts()):
                                        $news->the_post();
                                    ?>
                                        <a href="<?php the_permalink(); ?>"><li class="text-style-tweets"><?php the_title(); ?></li></a>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if(is_active_sidebar('Sidebar')) : ?>
                        <?php dynamic_sidebar('sidebar'); ?>
                    <?php endif; ?>
            </div>
        </div>
        <hr>
    </div>

    
<!--    <div class="container index">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-default">
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
        </div>-->
<?php get_footer(); ?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>rtCamp Theme</title>
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,400i,700,700i" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="<?php
        echo esc_url(get_template_directory_uri());
        ;
        ?>/lib/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    </head>
    <body>
        <nav id="header-navbar" class="navbar navbar-default">
            <div class="container">    
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if (has_custom_logo()) : ?>
                        <li class="navbar-brand list-unstyled"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php the_custom_logo(); ?></a></li>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img class="navbar-brand" src='<?php echo get_template_directory_uri() . '/lib/assets/images/sitelogo.png'; ?>'></a>
                    <?php endif; ?>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'primary',
                        'theme_location' => 'primary',
                        'depth' => 2,
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                        'walker' => new WP_Bootstrap_Navwalker())
                    );
                    ?>
                     <!--Custom Google Search - Start -->
                    <div role="search" class="col-md-4 navbar-form navbar-right navbar-form-top-margin">
                        <div class="form-group" id="navbar-search" style="width: 300px;">
                            <script>
                                (function () {
                                    var cx = '007246334582528029264:x5j8peflkne';
                                    var gcse = document.createElement('script');
                                    gcse.type = 'text/javascript';
                                    gcse.async = true;
                                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(gcse, s);
                                })();
                            </script>
                            <style>
                                .cse .gsc-control-cse, .gsc-control-cse {
                                    background-color: #F8F8F8;
                                    border: 1px solid #F8F8F8; 
                                    padding: 0em; 
                                    width: auto; 
                                }

                                input.gsc-input {
                                    font-size: inherit;
                                }
                            </style>
                            <gcse:search></gcse:search>
                        </div>
                    </div>
                     <!--Custom Google Search - End-->
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
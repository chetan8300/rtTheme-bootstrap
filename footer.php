    
        <hr>
        <footer>
                <div class="footer-widget">
                    <div class="container">
                        <?php if(is_active_sidebar('Footer')) : ?>
                            <?php dynamic_sidebar('footer'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-sm-3">
                                <nav>
                                    <div class="navbar-header text-left">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                        <?php
                                            wp_nav_menu( array(
                                                'menu'              => 'footer',
                                                'theme_location'    => 'footer',
                                                'depth'             => 1,
                                                'container'         => false,
                                                'menu_class'        => 'nav navbar-nav navbar-inner navbar-default',
                                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                                'walker'            => new WP_Bootstrap_Navwalker())
                                            );
                                        ?>
                                    </div>
                                    <p class="navbar-text text-right">Copyright &copy; <?php echo Date('Y');?> <?php bloginfo('name');?></p>
                                </nav>
                            </div>
                            <div class="col-md-3 col-sm-9">
                                <?php if( has_custom_logo() ) :?>
                                    <li class="navbar-brand list-unstyled"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php the_custom_logo();?></a></li>
                                <?php else :?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="navbar-brand" src='<?php echo get_template_directory_uri().'/lib/assets/images/sitelogo.png';?>'></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>

    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/assets/js/bootstrap.js"></script>

</body>
</html>
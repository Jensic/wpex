<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <nav class="navbar navbar-expand-sm navbar-ex">
            
                    <!--<a class="navbar-brand navbar-ex__brand" href="#">WT</a>-->
                    <button class="navbar-toggler navbar-ex__button" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon navbar-ex__button__toggler"></span>
                    </button>
                    <?php bootstrap_nav(); ?>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <?php if(is_user_logged_in()) { ?>
                    
<!--                        <span class="search-trigger"><a href="<?php //echo wp_logout_url(); ?>" class=""><i class="fa fa-sign-out" aria-hidden="true"></i></a></span>-->
                    <a href="<?php echo esc_url(site_url('/my-notes')); ?>" class="navbar-ex__notes">
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo wp_logout_url(); ?>" class="navbar-ex__logout">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
<!--                       <a href="<?php //echo wp_logout_url(); ?>" class="">
                           <span><?php //echo get_avatar(get_current_user_id(), 30); ?></span>
                           <span>Log Out</span>
                       </a>-->
                    
                    <?php } ?>
                
            </nav>
        </header>
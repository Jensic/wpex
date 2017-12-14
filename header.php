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
                <div class="container">
                    <!--<a class="navbar-brand navbar-ex__brand" href="#">WT</a>-->
                    <button class="navbar-toggler navbar-ex__button" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon navbar-ex__button__toggler"></span>
                    </button>
                    <?php bootstrap_nav(); ?>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </nav>
        </header>
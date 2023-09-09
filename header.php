<!doctype html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" lang="it">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4583323373959662" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta name="description" content="collettivo di resistenza artistica a sostegno dell'attività culturale, in quanto unico elemento necessario alla sopravvivenza umana">
    <meta name="keywords" content="arti,visive,audiovisive,performative,cinema,fotografia,musica,teatro,danza,letteratura,editoria">
    <meta name="author" content="<?php bloginfo('name') ?>">
</head>

<body <?php body_class('d-flex flex-column'); ?>>
    <header class="d-flex border-bottom border-light">
        <div class="container-fluid">
            <div class="d-flex">
                <div class="ms-auto py-2">
                    <nav class="d-flex navbar navbar-expand-md navbar-light p-0">
                        <div class="container p-0">
                            <a class="navbar-brand m-0" href="#"></a>
                            <button class="navbar-toggler border-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsMedianteDefault" aria-controls="navbarsMedianteDefault" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarsMedianteDefault">
                                <?php wp_nav_menu(array(
                                    'menu'              => 'primary',
                                    'theme_location'    => 'header-menu',
                                    'depth'             => 2,
                                    'container'         => 'div',
                                    'container_class'   => '',
                                    'container_id'      => '',
                                    'menu_class'        => 'navbar-nav text-end me-auto',
                                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                    'walker'            => new wp_bootstrap_navwalker()
                                )); ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main id="main" class="flex-grow-1 overflow-auto align-items-center" style="scroll-behavior: smooth;">
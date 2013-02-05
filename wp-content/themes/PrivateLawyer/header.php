<!DOCTYPE html >
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" >
    <title><?php wp_title ( '|', true,'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/PrivateLawyer/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/PrivateLawyer/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <?php
    wp_enqueue_script('jquery');
    wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', 'jquery', false);
    wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
    wp_head();?>
    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/themes/PrivateLawyer/js/jquery.fancybox.pack.js?v=2.1.3"></script>
    <script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/themes/PrivateLawyer/js/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <meta property="og:title" content="IQ Express by Learning Technics to IQ Express" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://iq-express.com/pricing/" />
    <meta property="og:image" content="http://iq-express.com/wp-content/uploads/2013/01/brain.png" />
    <meta property="og:site_name" content="IQ Express" />
    <meta property="og:description" 
    content="IQ Express, by Learning Technics, is a learning program for treating 
    and curing learning problems like ADHD, Dyslexia, Auditory Processing Disorder, 
    Dysgraphia, and other learning disabilities. It uses a technique called 
    Physio-Neuro therapy to help rewire the brain. Fully utilizing the brain's ability to heal itself, 
    neuroplasticity." />
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php include_once(TT_TPL_ROOT_PATH.'header_tpl.php'); //header content area ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mobilefix.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fonts/cufon-yui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fonts/Humanst521_BT_400.font.js"></script>

<?php
// Theme Specific Settings

// Content Width
	if ( ! isset( $content_width ) )
	$content_width = 990; /* pixels */


// Custom Backgrounds
function themefurnace_register_custom_background() {
	$args = array(
		'default-color' => '#ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'themefurnace_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_theme_support( 'custom-background');
	}
}
add_action( 'after_setup_theme', 'themefurnace_register_custom_background' );


function load_theme_fonts() {
    $heading = get_theme_mod('google_fonts_heading_font');
    $body = get_theme_mod('google_fonts_body_font');
    if((!empty($heading) && $heading != 'none') || (!empty($body) && $body != 'none')) {
        echo '<style type="text/css">';
        $imports = array();
        $styles = array();
        if(!empty($heading) && $heading != 'none') {
            $imports[] = '@import url(//fonts.googleapis.com/css?family='.urlencode($heading).');';
            $styles[] = 'h1, h2, h3, h4, h5, h6 { font-family: "'.$heading.'" !important }';
        }
        if(!empty($body) && $body != 'none') {
            $imports[] = '@import url(//fonts.googleapis.com/css?family='.urlencode($body).');';
            $styles[] = 'body { font-family: "'.$body.'" !important }';
        }

        echo implode("\r\n", $imports);
        echo implode("\r\n", $styles);
        echo '</style>';

    }
}

// load colors
function load_theme_colors() {
    $backgroundColor = get_theme_mod('background_color', '#ffffff;');
	$contentColor = get_theme_mod('content_color', '#ffffff;');
	$accentColor = get_theme_mod('accent_color', '#384249;');
	$textColor = get_theme_mod('text_color', '#999999;');
	$headingsColor = get_theme_mod('headings_color', '#31373b;');
	$linkColor = get_theme_mod('link_color', '#8fb9d4;');
	$footerColor = get_theme_mod('footer_color', '#ffffff;');
    $sidebarLinkColor = get_theme_mod('sidebar_link_color', '#8fb9d4;');
	$sidebarHeadingColor = get_theme_mod('sidebar_heading_color', '#ffffff;');

    echo '<style type="text/css">';

    if(!empty($backgroundColor)) {
        $hash = '';
        if(strpos($backgroundColor, '#') === false) {
            $hash = '#';
        }
        echo 'body { background-color: '.$hash.$backgroundColor.'}';
    }

    if(!empty($linkColor)) {
        $hash = '';
        if(strpos($linkColor, '#') === false) {
            $hash = '#';
        }
        echo ' a { color: '.$hash.$linkColor.'}';
    }

    if(!empty($sidebarLinkColor)) {
        $hash = '';
        if(strpos($sidebarLinkColor, '#') === false) {
            $hash = '#';
        }
        echo ' #sidebar a:not(:hover) { color: '.$hash.$sidebarLinkColor.'}';
    }

    if(!empty($sidebarHeadingColor)) {
        $hash = '';
        if(strpos($sidebarHeadingColor, '#') === false) {
            $hash = '#';
        }
        echo '#sidebar h1, #sidebar h2, #sidebar h3, #sidebar h4, #sidebar h5, #sidebar h6 { color: '.$hash.$sidebarHeadingColor.'}';
    }
	
    if(!empty($contentColor)) {
        $hash = '';
        if(strpos($contentColor, '#') === false) {
            $hash = '#';
        }
		echo '.container, .container2 { background-color: '.$hash.$contentColor.'}';
    }
	
    if(!empty($accentColor)) {
        $hash = '';
        if(strpos($accentColor, '#') === false) {
            $hash = '#';
        }
		echo '#main-nav ul ul li a:hover{ border-color: '.$hash.$accentColor.'}'; 
		echo '.portfoliooverlay span, .flex-direction-nav a, .itemoverlay:before,  a.button, .button, button, html input[type="button"], input[type="reset"]{ background-color: '.$hash.$accentColor.'}';
    }
	
	if(!empty($textColor)) {
        $hash = '';
        if(strpos($textColor, '#') === false) {
            $hash = '#';
        }
		echo 'body { color: '.$hash.$textColor.'}';
    }
	
	if(!empty($headingsColor)) {
        $hash = '';
        if(strpos($headingsColor, '#') === false) {
            $hash = '#';
        }
		echo 'h1,h2,h3,h4,h5,h6, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6, blockquote, .posttitle, .posttitle a { color: '.$hash.$headingsColor.' }';
    }

    if(!empty($footerColor)) {
        $hash = '';
        if(strpos($footerColor, '#') === false) {
            $hash = '#';
        }
		echo '#footer { background-color: '.$hash.$footerColor.'}';
    }

    echo '</style>';
}
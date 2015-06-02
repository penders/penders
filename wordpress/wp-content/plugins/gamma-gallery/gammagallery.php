<?php
/*
Plugin Name:Gamma Gallery
Plugin URI: http://wordpress.org/extend/plugins/gamma-gallery/
Description: A responsive wordpress gallery with montage image arrangement.
Author: ezhil
Version: 1.9
Author URI: http://profiles.wordpress.org/ezhil/
License: GPLv2 or later
*/


define( 'GG_PATH', content_url().'/plugins/gamma-gallery' );

 remove_shortcode('gallery', 'gallery_shortcode'); // removes the original shortcode
   add_shortcode('gallery', 'gamma_gallery'); // add your own shortcode

   // loads jquery
function jq_gg_load()
{
wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts','jq_gg_load');
    function gamma_gallery($attr) {
    $post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';
?>
<link rel="stylesheet" type="text/css" href="<?php echo GG_PATH;?>/css/style.css"/>
		<script src="<?php echo GG_PATH;?>/js/modernizr.custom.70736.js"></script>
		<noscript><link rel="stylesheet" type="text/css" href="<?php echo GG_PATH;?>/css/noJS.css"/></noscript>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->				
				<div class="gamma-container gamma-loading" id="gamma-container">
					<ul class="gamma-gallery">
					<?php 
    $post_content = $post->post_content;
preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
$photos = explode(",", $ids[1]);
if ( $attr['orderby'] == 'rand' )
{
	shuffle($photos);
}
	if ($photos) {$ct=0;
		foreach ($photos as $photo => $i) {$ct++;?>
<li>
							<div data-alt="img<?php echo $ct;?>" data-description="<h3><?php echo get_the_title($i); ?> </h3>" data-max-width="1800" data-max-height="2400">
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'full');echo $image_attributes[0]; ?>" data-min-width="1300"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'large');echo $image_attributes[0]; ?>" data-min-width="1000"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'large');echo $image_attributes[0]; ?>" data-min-width="700"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'medium');echo $image_attributes[0]; ?>" data-min-width="300"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'medium');echo $image_attributes[0]; ?>" data-min-width="200"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'medium');echo $image_attributes[0]; ?>" data-min-width="140"></div>
								<div data-src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'thumbnail');echo $image_attributes[0]; ?>"></div>
								<noscript>
									<img src="<?php $image_attributes = wp_get_attachment_image_src( $i, 'medium');echo $image_attributes[0]; ?>" alt="img<?php echo $ct;?>"/>
								</noscript>
							</div>
</li>
<?php 
		}	
	} ?>
</ul>
<div class="gamma-overlay"></div>
</div>
<?php add_action('wp_footer','gg_load_scripts'); function gg_load_scripts(){?>
<script src="<?php echo GG_PATH;?>/js/jquery.masonry.min.js"></script>
<script src="<?php echo GG_PATH;?>/js/jquery.history.js"></script>
<script src="<?php echo GG_PATH;?>/js/js-url.min.js"></script>
<script src="<?php echo GG_PATH;?>/js/jquerypp.custom.js"></script>
<script src="<?php echo GG_PATH;?>/js/gamma.js"></script>
<script type="text/javascript">
jQuery(function() {
				var GammaSettings = {
						// order is important!
						viewport : [ {
							width : 1500,
							columns : 6
						}, {
							width : 1200,
							columns : 5
						}, {
							width : 800,
							columns : 4
						}, {
							width : 500,
							columns : 3
						}, { 
							width : 320,
							columns : 2
						}, { 
							width : 0,
							columns : 2
						} ]
				};
				Gamma.init( GammaSettings);
			});
</script>
<?php } }?>
=== SB Paginate ===
Contributors: skylarkcob
Donate link: http://hocwp.net/donate/
Tags: sb, paginate, pagination, sb plugin, sb paginate, wp paginate, paginate plugin
Requires at least: 3.9
Tested up to: 4.2
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

SB Paginate is a pagination plugin that allows to set up navigation on WordPress site.

== Description ==

SB Paginate is a pagination plugin that allows to set up navigation on WordPress site. SB Paginate not only supports the default query but also it can be used to show navigation for the custom query on WordPress.

**Required Plugin**

* [SB Core](https://wordpress.org/plugins/sb-core/)

**Features**

* Add the pagination on your WordPress site.
* Show pagination for the custom query.

**Translations**

* English
* Vietnamese

**Recommended WordPress Plugins**

* [SB Banner Widget](https://wordpress.org/plugins/sb-banner-widget/)
* [SB Clean](https://wordpress.org/plugins/sb-clean/)
* [SB Comment](https://wordpress.org/plugins/sb-comment/)
* [SB Login Page](https://wordpress.org/plugins/sb-login-page/)
* [SB Post Widget](https://wordpress.org/plugins/sb-post-widget/)
* [SB Tab Widget](https://wordpress.org/plugins/sb-tab-widget/)
* [SB TBFA](https://wordpress.org/plugins/sb-tbfa/)

== Installation ==

Install this plugin from your WordPress site Dashboard or follow these steps below:

1. Download plugin from WordPress Plugins directory and extract it.
1. Upload the `sb-paginate` folder to the `/wp-content/plugins/` directory.
1. Activate the SB Paginate plugin through the 'Plugins' menu in WordPress.
1. Configure the plugin by going to the `SB Options` menu that appears in your admin menu.

Examples:

For the default query:
	
	<?php if(function_exists("sb_paginate")) sb_paginate(); ?>
	
For the custom query usage with arguments:
	
	<?php $test_query = new WP_Query(array("posts_per_page" => 1, "paged" => get_query_var("paged"))); ?>
	<?php while ( $test_query->have_posts() ) : $test_query->the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; wp_reset_postdata(); ?>
	<?php if(function_exists("sb_paginate")) sb_paginate(array("query" => $test_query)); ?>

Full usage with all arguments:

    <?php if(function_exists("sb_paginate")) sb_paginate(array("query" => $test_query, "anchor" => 1, "range" => 1, "gap" => 3, "style" => "dark", "border_radius" => "none")); ?>
	
For basic usage, you can also have a look at the [plugin homepage](http://hocwp.net/).

== Frequently Asked Questions ==

Please visit [homepage](http://hocwp.net) for more details.

== Screenshots ==

1. The pagination in default style.
2. The pagination in dark style with no border radius.

== Upgrade Notice ==

Please update SB Core before you upgrade SB Paginate to new version.

== Changelog ==

= 1.1.1 =
Stop using SB Plugins if current theme doesn't support.

= 1.1.0 =
* Update testing filter.
* Re-struct SB Paginate.

= 1.0.9 =
Tested up to WordPress 4.1 version.

= 1.0.8 =
Make Vietnamese as the default language.

= 1.0.7 =
Update new check core functions.

= 1.0.6 =
Update check core function.

= 1.0.5 =
Update new check core functions.

= 1.0.4 =
New: Add option for user change pagination label.

= 1.0.3 =
Fix: Missing committed files.

= 1.0.2 =
* Update: Compress css and javascript.
* Fix: Plugin settings link bugs.

= 1.0.1 =
* New: Add SB Options page to the Dashboard menu.
* New: Now you can set option for pagination to show.

= 1.0.0 =
First release of SB Paginate.
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php the_title();?> | PEBC Education Statute Database</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	<link href='http://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<a href="/"><img style=width:200px; src="<?php bloginfo('template_url')?>/images/pebc_logo.png" /></a>
		</div>
		<div id="header_stripe">
			<div id="head_text">
				<h1>Online <span class=red>Education</span> Statute Database</h1>
				<ul>
					<li>Search Colorado education statutes by entering a search term or selecting a tag below.</li>
					<li>For best results, avoid broad terms like <strong class=red>student</strong> or <strong class=red>school</strong>.</li>
					<li>You can also put quotes around specific terms you would like to search for like <strong class=red>"school bus"</strong>.</li>
				</ul>
				<div style="clear:both"></div>
			</div>
			<div class="head_search">
				Search by term<br>
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
					<input type="text" placeholder="Enter Search Term" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="head_input" />
					<input type="submit" id="searchsubmit" value="SEARCH" class="btn" />
				</form>
			</div>
			<div class="head_search">
				Or select a tag<br>
				<form method="get" id="tagselect">
					<div class="head_search_left">
					<?php $tags = get_tags();
						$html = '<select name="tag" placeholder="Select a Tag" class="post_tags head_input"><option></option>';
						foreach ( $tags as $tag ) {
						$tag_link = get_tag_link( $tag->term_id );
						$tag_slug = $tag->slug;
						$html .= '<option value="'. $tag_link . '" ';
						if (is_tag($tag_slug)) {
							$html .= 'selected';
							}
						$html .= '>' . $tag->name . '</option>';
						}
						echo $html;
						echo '</select>';
					?>
					</div>
					<input type="button" id="tagsubmit" value="SEARCH" class="btn" onClick="window.open(tag.value, '_parent')" />
				</form>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title>PEBC Education Statute Database | <?php the_title(); ?></title>
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
			<img style=width:200px; src="<?php bloginfo('template_url')?>/images/pebc_logo.png" />
		</div>
		<div id="head_text">
			<h1>Online <span class=red>Education</span> Statute Database</h1>
			<p>Search Colorado education statutes by entering a search term below. For best results, avoid broad terms like "student" and "school." You can also search by selecting a tag from the drop down.</p>
			<p>If you have any questions, comments or suggestions, please contact <a href="mailto:statutedb@pebc.org">statutedb@pebc.org</a></p>
			<div style="clear:both"></div>
		</div>
		<div id="search_area">
			<div id="search_form">
				Search by term<br>
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
					<div>
						<input type="text" size="60" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="Search" class="btn" />
					</div>
				</form>
			</div>
			<div id="tag_select">
				Or select a tag<br>
				<form method="get" id="tagselect">
				<?php $tags = get_tags();
					$html = '<select name="tag" class="post_tags">';
					foreach ( $tags as $tag ) {
					$tag_link = get_tag_link( $tag->term_id );
					$tag_slug = $tag->slug;
					$html .= '<option value="'. $tag_link . '" ';
					if (is_tag($tag_slug)) {
						$html .= 'selected';
						}
					$html .= '>' . $tag->name . '</option>';
					}
					echo '</select>';
					echo $html;
				?>
					<input type="button" id="tagsubmit" value="search" class="btn" onClick="window.open(tag.value, '_parent')" />
				</form>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
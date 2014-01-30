<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h2 class="archive-title"><?php echo 'There are ' . $wp_query->found_posts . ' statutes tagged: <strong class=red>'. single_tag_title( '', false ); ?></strong></h2>
				<ul>
					<li>Click on the source or subject to view the full description and text of the statute.</li>
					<li>Click on a tag to show all statues with that tag</li>
				</ul>
				<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
			<div id="sr_index">
				<div class="sr_title">
					Source and subject
				</div>
				<div class="sr_excerpt">
					Abstract
				</div>
				<div class="sr_tags">
					Tags
				</div>
				<div style="clear:both;"></div>
			</div>
			
			<?php /* The loop */ ?>
			<div class="srs">
			<?php while ( have_posts() ) : the_post();
				/* Retrieve statute data */
				$esdb_legal_origin = get_post_meta($post->ID, 'esdb_legal_origin', true);
				$esdb_reference_number = get_post_meta($post->ID, 'esdb_reference_number', true);
				$esdb_aka = get_post_meta($post->ID, 'esdb_aka', true);
			?>
			<div class="sr">
				<div class="sr_id">
					<h3>
						<a href="<?php the_permalink();?>">
							<?php
							echo $esdb_reference_number; 
							if (!empty($esdb_aka)) {
								echo ' - ' . $esdb_aka;
								}
							?>
					</h3>
				</div>
				<div class="sr_title">
					<?php the_title(); ?>
						</a>
				</div>
				<div class="sr_excerpt">
					<?php the_excerpt(); ?>
				</div>
				<div class="sr_tags">
					<?php the_tags('','<br>'); ?>
				</div>
				<div style="clear:both;">
				</div>
			</div>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php numeric_posts_nav(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
<?php get_header(); ?>
<div id="main_content">
	<?php while ( have_posts() ) : the_post();
	/* Retrieve existing statute data */
	$esdb_legal_origin = get_post_meta($post->ID, 'esdb_legal_origin', true);
	$esdb_reference_number = get_post_meta($post->ID, 'esdb_reference_number', true);
	$esdb_aka = get_post_meta($post->ID, 'esdb_aka', true);
	$esdb_authority = get_post_meta($post->ID, 'esdb_authority', true);
	$esdb_collaboration = get_post_meta($post->ID, 'esdb_collaboration', true);
	$esdb_timeframe = get_post_meta($post->ID, 'esdb_timeframe', true);
	$esdb_references = get_post_meta($post->ID, 'esdb_references', true);
	$esdb_other_documents = get_post_meta($post->ID, 'esdb_other_documents', true);
	?>
	<div id="statute_title">
		<h1><?php
		echo $esdb_reference_number;
		if (!empty($esdb_aka)) {
			echo ' - ' . $esdb_aka;
			}
		?>
		</h1>
	</div>
	<table id="statute_table">
		<col width="200">
		<tr>
			<td class="statute_attrib_title">Subject</td>
			<td><?php the_title();?></td>
		</tr>
		<tr>
			<td class="statute_attrib_title">Description</td>
			<td><?php the_excerpt();?></td>
		</tr>
		<tr>
			<td class="statute_attrib_title">Key topics</td>
			<td><?php the_tags('', '<br>', '');?></td>
		</tr>
		<tr><?php
			if (!empty($esdb_legal_origin)) {?>
				<td class="statute_attrib_title">Legal origin</td>
				<td><?php echo $esdb_legal_origin;?></td>
				<?php } ?>
		</tr>
		<tr><?php
			if (!empty($esdb_authority)) {?>
				<td class="statute_attrib_title">Authority</td>
				<td><?php echo $esdb_authority;?></td>
				<?php } ?>
		</tr>
		<tr><?php
			if (!empty($esdb_collaboration)) {?>
				<td class="statute_attrib_title">Collaboration</td>
				<td><?php echo $esdb_collaboration;?></td>
				<?php } ?>
		</tr>
		<tr><?php
			if (!empty($esdb_timeframe)) {?>
				<td class="statute_attrib_title">Timeframe</td>
				<td><?php echo $esdb_timeframe;?></td>
				<?php } ?>
		</tr>
		<tr><?php
			if (!empty($esdb_references)) {?>
				<td class="statute_attrib_title">References</td>
				<td><?php echo $esdb_references;?></td>
				<?php } ?>
		</tr>
		<tr><?php
			if (!empty($esdb_other_documents)) {?>
				<td class="statute_attrib_title">Other Relevant Documents</td>
				<td><?php echo $esdb_other_documents;?></td>
				<?php } ?>
		</tr>
		<tr>
			<td class="statute_attrib_title">Full text</td>
			<td><?php the_content(); ?></td>
		</tr>
	</table>
	<?php endwhile; ?>
<?php get_footer(); ?>
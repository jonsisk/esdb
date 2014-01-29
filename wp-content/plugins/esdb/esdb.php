<?php
/*
Plugin Name: Education Statute Database
Plugin URI: http://esdb.pebc.org
Description: Creates custom post type for PEBC education statute database
Version: 0.1
Author: Jonathan Sisk
Author URI: http://www.itjon.com
License: GPL2
*/

/* Run function to create post type at init */
add_action( 'init', 'esdb_create_post_type' );

/* The function to add the custom post type to wordpress tag searches */
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','esdb_statute');
    $query->set('post_type',$post_type);
	return $query;
    }
}

/* The function that creates the custom post type */
function esdb_create_post_type() {
	register_post_type( 'esdb_statute',
		array(
			'labels' => array(
				'name' => ( 'Statutes' ),
				'singular_name' => ( 'Statute' ),
				'add_new_item' => ( 'Add New Statute' ),
				'edit_item' => ('Edit Statute' ),
				'new_item' => ('New Statute'),
				'view_item' => ('View Statute'),
				'search_items' => ( 'Search Statutes' ),
				'not_found' => ('No Statutes found'),
				),
			'public' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'excerpt'),
			'rewrite' => array('slug' => 'statutes'),
			'register_meta_box_cb' => 'add_esdb_metabox'
			)
		);
	register_taxonomy_for_object_type( 'post_tag', 'esdb_statute');
	}

/* Callback function to create custom metabox for statute info */
function add_esdb_metabox() {
	add_meta_box('esdb_statute_metabox', 'Statute Information', 'esdb_statute_metabox', 'esdb_statute');
	}
	
/* The function that contains the HTML for the metabox */
function esdb_statute_metabox() {
	global $post;
	
	/* Retrieve existing statute data */
	$esdb_legal_origin = get_post_meta($post->ID, 'esdb_legal_origin', true);
	$esdb_reference_number = get_post_meta($post->ID, 'esdb_reference_number', true);
	$esdb_aka = get_post_meta($post->ID, 'esdb_aka', true);
	$esdb_authority = get_post_meta($post->ID, 'esdb_authority', true);
	$esdb_collaboration = get_post_meta($post->ID, 'esdb_collaboration', true);
	$esdb_timeframe = get_post_meta($post->ID, 'esdb_timeframe', true);
	$esdb_references = get_post_meta($post->ID, 'esdb_references', true);
	$esdb_other_documents = get_post_meta($post->ID, 'esdb_other_documents', true);
	
	/* The HTML form */
	?>
	<input type="hidden" name="statute_meta_noncename" id="statute_meta_noncename" value="<?php wp_create_nonce( plugin_basename(__FILE__) )?>" />
	<label>Legal Origin</label>
	<input type="text" name="esdb_legal_origin" value="<?php echo $esdb_legal_origin ?>" class="widefat" />
	<label>Title-Article-Section(s)</label>
	<input type="text" name="esdb_reference_number" value="<?php echo $esdb_reference_number ?>" class="widefat" />
	<label>AKA</label>
	<input type="text" name="esdb_aka" value="<?php echo $esdb_aka ?>" class="widefat" />
	<label>Authority</label>
	<input type="text" name="esdb_authority" value="<?php echo $esdb_authority ?>" class="widefat" />
	<label>Interagency Collaboration</label>
	<input type="text" name="esdb_collaboration" value="<?php echo $esdb_collaboration ?>" class="widefat" />
	<label>Timeframe</label>
	<input type="text" name="esdb_timeframe" value="<?php echo $esdb_timeframe ?>" class="widefat" />
	<label>References</label>
	<input type="text" name="esdb_references" value="<?php echo $esdb_references ?>" class="widefat" />
	<label>Other Relevant Documents</label>
	<input type="text" name="esdb_other_documents" value="<?php echo $esdb_other_documents ?>" class="widefat" />
	<?php
	}
	
/* The function to save the metabox data */
function esdb_save_statute_meta($post_id, $post) {
	/* Verify nonce */
	//if (!wp_verify_nonce($_POST['statute_meta_noncename'], plugin_basename(__FILE__))) { return $post->ID;}
	
	/* Verify user has permission to save */
	if (!current_user_can( 'edit_post', $post->ID)) { return $post->ID;}
	
	/* Put meta into array */
	$esdb_statute_meta['esdb_legal_origin'] = $_POST['esdb_legal_origin'];
	$esdb_statute_meta['esdb_reference_number'] = $_POST['esdb_reference_number'];
	$esdb_statute_meta['esdb_aka'] = $_POST['esdb_aka'];
	$esdb_statute_meta['esdb_authority'] = $_POST['esdb_authority'];
	$esdb_statute_meta['esdb_collaboration'] = $_POST['esdb_collaboration'];
	$esdb_statute_meta['esdb_timeframe'] = $_POST['esdb_timeframe'];
	$esdb_statute_meta['esdb_references'] = $_POST['esdb_references'];
	$esdb_statute_meta['esdb_other_documents'] = $_POST['esdb_other_documents'];
	
	/* Loop through statute meta array */
	foreach ($esdb_statute_meta as $key => $value) {
		
		/* Don't save revision */
		//if ($post->post_type== 'revision' ) return;
		
		/* If value is array, make it a CSV */
		$value = implode (',', (array)$value);
		
		/* Adds or updates field */
		update_post_meta($post->ID, $key, $value);
		
		/* Delete if blank */
		if(!$value) {delete_post_meta($post->ID, $key);}
		}
	}
	
/* Save the statute meta */	
add_action('save_post','esdb_save_statute_meta',1, 2);
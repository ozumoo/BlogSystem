<?php
require_once('config.php');

function add_post($title, $contents, $category) {
	$title 		= $GLOBALS['link']->real_escape_string($title);
	$contents 	= $GLOBALS['link']->real_escape_string($contents);
	$category 	= (int) $category;
	//var_dump($category);
 
	$GLOBALS['link']->query("INSERT INTO `posts` SET

			`cat_id` 		= '{$category}',
			`title`			= '{$title}',
			`contents`		= '{$contents}',
			`date_posted`	= NOW()");
}

function edit_post($id, $title, $contents, $category) {
	$id 		= (int) $id;
	$title 		= $GLOBALS['link']->real_escape_string($title);
	$contents 	= $GLOBALS['link']->real_escape_string($contents);
	$category 	= (int) $category;

	$GLOBALS['link']->query("UPDATE `posts` SET
		`cat_id`	= '{$category}',
		`title`		= '{$title}',
		`contents`	= '{$contents}'
		WHERE `id` = {$id} ") ;

}

function add_category($name) {
	$name = $GLOBALS['link']->real_escape_string($name);
	//var_dump($name);

	$GLOBALS['link']->query("INSERT INTO categories SET name = '{$name}'");
}

function delete($table, $id) {
	$table = $GLOBALS['link']->real_escape_string($table);
	$id    = (int) $id;

	$GLOBALS['link']->query("DELETE FROM `{$table}` WHERE `id` = {$id}");
}

function get_posts($id = null, $cat_id = null) {
	$posts = array();
	$query = "SELECT posts.id AS post_id, categories.id AS category_id, title, contents, date_posted, categories.name FROM posts INNER JOIN categories ON categories.id = posts.cat_id ";
	
	if ( isset($id) ) {
		$id = (int) $id;
		$query .= " WHERE `posts` . `id` = {$id}";
	}

	if (isset($cat_id) ){
		$cat_id = (int) $cat_id;
		$query .= " WHERE `cat_id` = {$cat_id}";
	}

	$query .= " ORDER BY `posts`.`id` DESC";
	$query = $GLOBALS['link']->query($query);

	while ($row = $query->fetch_assoc() ) {
		$posts[] = $row;
	}


	return $posts;
}

function get_categories($id = null){
	$categories = array();

	$query = $GLOBALS['link']->query(" SELECT id, name FROM categories ");

	while ($row = $query->fetch_assoc() ) {
		$categories[] = $row;
	}

	return $categories;
}


function category_exists($field, $value) {
	$field = $GLOBALS['link']->real_escape_string($field);
	$value = $GLOBALS['link']->real_escape_string($value);
	$q = "SELECT COUNT(*) FROM `categories` WHERE `{$field}`='{$value}'";

	$row = $GLOBALS['link']->query($q)->fetch_assoc();

	if( $row['COUNT(*)'] > 0) 
		return true; 
	else
		return false;
}


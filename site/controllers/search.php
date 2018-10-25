<?php

return function($site, $pages, $page) {
	//= Section searching...
	$section = page('products')->children();

	//= Limit results.
	$limit = 2;

	//= Get name input search.
	$query   = get('q');

	//= Function search and pagination results.
	$results = $section->search($query, 'title | text');
	$results = $results->paginate($limit);

	//= Total number for results.
	$total = $results->count();

	return array(
		'query'   => $query,
		'limit'   => $limit,
		'results' => $results,
		'total' => $total,
		'pagination' => $results->pagination()
	);
};
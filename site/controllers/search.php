<?php

return function($site, $pages, $page) {
	//= Section searching...
	$section = page('products')->children();

	//= Limit results.
	$limit = 2;

	//= Get name input search.
	$query   = get('q');
	$city = get('city');
	$age = get('age');

	//= Function search and pagination results.
	if ($city!='' && $age=='') {
		$results = $section->search($city, 'city');
		$results = $results->paginate($limit);
		//= Total number for results.
		$total = $results->count();
	} elseif($age!='' && $city=='') {
		$results = $section->search($age, 'age');
		$results = $results->paginate($limit);
		//= Total number for results.
		$total = $results->count();
	} elseif($age!='' && $city!='') {
		$test = $city+' '+$age;
		$results = $section->search($test, 'city | age');
		$results = $results->paginate($limit);
		//= Total number for results.
		$total = $results->count();
		var_dump($test);
	} else {
		$results = $section->search($query, 'title');
		$results = $results->paginate($limit);
		//= Total number for results.
		$total = $results->count();
	}

	return array(
		'query'   => $query,
		'limit'   => $limit,
		'city'   => $city,
		'age'   => $age,
		'results' => $results,
		'total' => $total,
		'pagination' => $results->pagination()
	);
};
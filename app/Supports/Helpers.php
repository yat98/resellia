<?php

function appendsQueryString($params)
{
	$query = request()->all();
	foreach ($params as $key => $value) {
		$query[$key] = $value;
	}

	return request()->url() . '?' . http_build_query($query);
}

function isQueryStringEqual($params)
{
	return !array_diff($params, request()->all());
}

function bankList()
{
	$banks = config('bank-accounts');
	$results = [];
	foreach ($banks as $account => $detail) {
		$results[$account] = $detail['title'];
	}

	return $results;
}

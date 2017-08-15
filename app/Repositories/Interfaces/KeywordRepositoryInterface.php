<?php

namespace App\Repositories\Interfaces;

interface KeywordRepositoryInterface
{
	public function findByKeyword($value);
    public function findId($value='');
    public function hasMeanings($keyword='', $lang, $order = 'desc');
    public function hasMeaningsGroupByType($keyword = '', $lang, $order = 'desc');
}
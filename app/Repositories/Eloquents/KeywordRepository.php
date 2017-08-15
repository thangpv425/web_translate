<?php

namespace App\Repositories\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\KeywordRepositoryInterface;
use App\Keyword;
use App\Meaning;

class KeywordRepository extends EloquentRepository implements KeywordRepositoryInterface
{
	/**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Keyword::class;
    }
    /**
     * select * from binary where ....
     * @param  string $value [description]
     * @return [array]        [array of keyword = $value and actived]
     */
    public function findByKeyword($value='')
    {
    	$result = 
            DB::select(DB::raw("SELECT * 
                FROM `wt_keyword` 
                WHERE BINARY keyword = :keyword 
                AND status = 1"), 
                array('keyword' => $value)
            );
        return $result;
    }

    public function findId($value='')
    {
        $keyword = $this->findByKeyword($value);
        if ($keyword == null) {
            return -1;
        } else {
            return $keyword[0]->id;
        }
        
    }
    /**
     * all meanings of keyword order by $order
     * @param  string  $keyword [description]
     * @param integer $lang meaning language
     * @param string $order [option]
     * @return query builder          [description]
     */
    public function hasMeanings($keyword='', $lang = VIETNAMESE, $order = 'desc')
    {
        $keyword_id = $this->findId($keyword);
        $meanings = 
            Meaning::
                select('id', 'meaning', 'type', 'index')
                ->where([
                    ['keyword_id', $keyword_id],
                    ['language', $lang],
                    ['status', ACTIVE]
                ])
                ->orderBy('index', $order);
        return $meanings;
    }

    /**
     * separate meanings into multi group of type and order by index
     * @param  string  $keyword [description]
     * @param integer $lang meaning language
     * @param string $order asc or desc
     * @return collection          [collection of collection, each collection is a group of type like noun, verb ... order by index asc]
     */
    public function hasMeaningsGroupByType($keyword = '', $lang = VIETNAMESE, $order = 'desc')
    {
        $meanings = 
            $this->hasMeanings($keyword, $lang, $order)
                ->orderBy('type')
                ->get()
                ->groupBy('type');
        return $meanings;
    }
    public function bestMeaning($keyword='', $lang = VIETNAMESE)
    {
        $meaning = $this->hasMeanings($keyword, $lang)->first();
        if ($meaning != null) {
            return $meaning->meaning;
        }
        return '';
    }
}
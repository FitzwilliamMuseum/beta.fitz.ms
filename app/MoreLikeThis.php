<?php

namespace App;

use Illuminate\Http\Request;
use Solarium\Client;
use Solarium\Core\Client\Adapter\Curl;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Solarium\Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Mews\Purifier;

class MoreLikeThis {

  protected $_query;

  public function setQuery($query) {
    $this->_query = $query;
    return $this;
  }

  public function getQuery()
  {
    return $this->_query;
  }

  protected $_type;

  public function setType($type) {
    $this->_type = $type;
    return $this;
  }

  public function getType()
  {
    return $this->_type;
  }

  protected $_limit = 3;

  public function setLimit($limit) {
    $this->_limit = $limit;
    return $this;
  }

  public function getLimit()
  {
    return $this->_limit;
  }

  public function getData()
  {
    $queryString = $this->getQuery();
    #\Purifier::clean($this->getQuery(), array('HTML.Allowed' => ''));
    $key = md5($queryString . 'mlt' . $this->getLimit() . $this->getType());
    $expiresAt = now()->addMinutes(3600);
    if (Cache::has($key)) {
        $data = Cache::store('file')->get($key);
    } else {
        $configSolr = \Config::get('solarium');
        //dd($configSolr);
        $client = new Client(new Curl(), new EventDispatcher(), $configSolr);
        $query = $client->createMoreLikeThis();
        $query->setQuery('slug:' . $queryString);
        $query->setMltFields('title,description');
        $query->setMinimumDocumentFrequency(1);
        $query->setMinimumTermFrequency(1);
        $query->createFilterQuery('type')->setQuery('contentType:' . $this->getType());
        $query->setInterestingTerms('details');
        $query->setMatchInclude(true);
        $query->setRows($this->getLimit());
        $data = $client->select($query);
        Cache::store('file')->put($key, $data, $expiresAt);
    }
    $records = $data->getDocuments();
    return $records;
  }

}

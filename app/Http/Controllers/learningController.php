<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\DirectUs;
use App\MoreLikeThis;
use App\FitzElastic\Elastic;
use Elasticsearch\ClientBuilder;

class learningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function getApi(){
       $directus = new DirectUs;
       return $directus;
     }

     public function getElastic()
     {
       return new Elastic();
     }

    public function lookthinkdomain()
    {
        $api = $this->getApi();
        $api->setEndpoint('look_think_do');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*'
          )
        );
        $ltd = $api->getData();
        return view('learning.lookthinkdomain', compact('ltd'));
    }

    public function lookthinkdoactivity($slug)
    {
        $api = $this->getApi();
        $api->setEndpoint('look_think_do');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[slug][eq]' => $slug
          )
        );
        $ltd = $api->getData();
        $params = [
          'index' => 'ciim',
          'size' => 1,
          'body'  => [
            'query' => [
              'match' => [
                'identifier.accession_number' => strtoupper($ltd['data'][0]['adlib_id_number'])
              ]
            ]
          ]
        ];
        $adlib = $this->getElastic()->setParams($params)->getSearch();
        $adlib = $adlib['hits']['hits'];
        return view('learning.lookthinkdoactivity', compact('ltd', 'adlib'));
    }

    public function resources()
    {
        $api = $this->getApi();
        $api->setEndpoint('stubs_and_pages');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[section][eq]' => 'learning',
              'filter[landing_page][eq]' => '1',
              'filter[slug][eq]' => 'resources'
          )
        );
        $pages = $api->getData();

        $api2 = $this->getApi();
        $api2->setEndpoint('learning_pages');
        $api2->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[page_type][eq]' => 'Fact Sheets'
          )
        );
        $res = $api2->getData();

        $api3 = $this->getApi();
        $api3->setEndpoint('learning_pages');
        $api3->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[page_type][neq]' => 'Fact Sheets',
              'sort' => '-id'
          )
        );
        $stages = $api3->getData();

        return view('learning.resources', compact('pages', 'res', 'stages'));
    }

    public function resource($slug)
    {
        $api = $this->getApi();
        $api->setEndpoint('learning_pages');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[slug][eq]' => $slug
          )
        );
        $res = $api->getData();
        return view('learning.resource', compact('res'));
    }

    public static function schoolsessions()
    {
        $api = new DirectUs;
        $api->setEndpoint('school_sessions');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*'        )
        );
        $sessions = $api->getData();
        return $sessions;
    }

    public static function youngpeople()
    {
        $api = new DirectUs;
        $api->setEndpoint('stubs_and_pages');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[subsection][eq]' => 'young-people'
            )
        );
        $sessions = $api->getData();
        return $sessions;
    }

    public function session($slug)
    {
        $api = $this->getApi();
        $api->setEndpoint('school_sessions');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[slug][eq]' => $slug
          )
        );
        $session = $api->getData();

        $mlt = new MoreLikeThis;
        $mlt->setLimit(3)->setType('schoolsessions')->setQuery($slug);
        $records = $mlt->getData();
        return view('learning.session', compact('session','records'));
    }

    public function young($slug)
    {
        $api = $this->getApi();
        $api->setEndpoint('stubs_and_pages');
        $api->setArguments(
          $args = array(
              'fields' => '*.*.*.*',
              'meta' => '*',
              'filter[slug][eq]' => $slug
          )
        );
        $session = $api->getData();

        $mlt = new MoreLikeThis;
        $mlt->setLimit(3)->setType('schoolsessions')->setQuery($slug);
        $records = $mlt->getData();
        return view('learning.young', compact('session','records'));
    }

}

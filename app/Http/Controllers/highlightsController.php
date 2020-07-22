<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Solarium\Core\Client\Client;

use App\DirectUs;
use App\MoreLikeThis;

class highlightsController extends Controller
{
    public function index(Request $request)
    {
      $perPage = 12;
      $offset = ($request->page -1) * $perPage ;
      $api = $this->getApi();
      $api->setEndpoint('pharos');
      $api->setArguments(
        $args = array(
            'fields' => '*.*.*.*',
            'meta' => '*',
            'limit' => $perPage,
            'offset' => $offset
        )
      );
      $pharos = $api->getData();
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $total = $pharos['meta']['total_count'];
      $paginator = new LengthAwarePaginator($pharos, $total, $perPage, $currentPage);
      $paginator->setPath('highlights');
      return view('highlights.index', compact('pharos', 'paginator'));
    }

    public function details( $slug)
    {
      $api = $this->getApi();
      $api->setEndpoint('pharos');
      $api->setArguments(
        $args = array(
            'fields' => '*.*.*.*.*',
            'meta' => '*',
            'filter[slug][eq]' => $slug,
        )
      );
      $pharos = $api->getData();
      $mlt = new MoreLikeThis;
      $mlt->setLimit(3)->setType('pharos')->setQuery($slug);
      $records = $mlt->getData();
      return view('highlights.details', compact('pharos', 'records'));
    }

    public function associate($section, $slug)
    {
      $api = $this->getApi();
      $api->setEndpoint('pharos_pages');
      $api->setArguments(
        $args = array(
            'fields' => '*.*.*.*.*.*',
            'meta' => '*',
            'filter[slug][eq]' => $slug,
            'filter[section][eq]' => $section
        )
      );
      $pharos = $api->getData();

      $mlt = new MoreLikeThis;
      $mlt->setLimit(3)->setType('pharospages')->setQuery($slug);
      $records = $mlt->getData();
      return view('highlights.associate', compact('pharos', 'records'));
    }

    public function landing()
    {
      return view('highlights.landing');
    }


    /** Get results for search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function results(Request $request)
    {

        $this->validate($request, [
            'query' => 'required|max:200|min:3',
        ]);

        $queryString = \Purifier::clean($request->get('query'), array('HTML.Allowed' => ''));
        $key = md5($queryString . ' contentType:pharos'. $request->get('page'));
        $perPage = 20;
        $expiresAt = now()->addMinutes(3600);
        $from = ($request->get('page', 1) - 1) * $perPage;
        if (Cache::has($key)) {
            $data = Cache::store('file')->get($key);
        } else {
            $configSolr = \Config::get('solarium');
            $this->client = new Client($configSolr);
            $query = $this->client->createSelect();
            $query->setQuery($queryString . ' contentType:pharos');
            $query->setQueryDefaultOperator('AND');
            $query->setStart($from);
            $query->setRows($perPage);
            // get the facetset component
            $facetSet = $query->getFacetSet();

            $data = $this->client->select($query);
            Cache::store('file')->put($key, $data, $expiresAt);
        }
        $number = $data->getNumFound();
        $records = $data->getDocuments();
        $paginate = new LengthAwarePaginator($records, $number, $perPage);
        $paginate->setPath($request->getBaseUrl() . '?query='. $queryString);
        return view('highlights.results', compact('records', 'number', 'paginate', 'queryString'));
    }

    public function audioguide()
    {
      $first = new DirectUs;
      $first->setEndpoint('audio_guide');
      $first->setArguments(
        array(

          'fields' => '*.*.*.*',
          'sort' => 'stop_number'
        )
      );
      $stops = $first->getData();
      return view('highlights.audioguide', compact('stops'));
    }

    public function stop( $slug)
    {
      $api = $this->getApi();
      $api->setEndpoint('audio_guide');
      $api->setArguments(
        $args = array(
            'fields' => '*.*.*.*.*',
            'meta' => '*',
            'filter[slug][eq]' => $slug,
        )
      );
      $stop = $api->getData();
      // dd($stop);

      $mlt = new MoreLikeThis;
      $mlt->setLimit(3)->setType('audioguide')->setQuery($slug);
      $records = $mlt->getData();
      return view('highlights.stop', compact('stop', 'records'));
    }

    public function pharosSections($section){
      $api = $this->getApi();
      $api->setEndpoint('pharos_pages');
      $api->setArguments(
        $args = array(
            'fields' => '*.*.*.*.*.*',
            'meta' => '*',
            'filter[section][eq]' => $section
        )
      );
      $pharos = $api->getData();
      return view('highlights.sections', compact('pharos'));
    }

    public function contextual()
    {
      $api = $this->getApi();
      $api->setEndpoint('pharos_pages');
      $api->setArguments(
        $args = array(
            'fields' => 'section,hero_image.*',
            'meta' => '*'
        )
      );
      $pharos = $api->getData();
      $context = $this->group_by("section", $pharos['data']);
      return view('highlights.context', compact('context'));
    }

    /**
     * Function that groups an array of associative arrays by some key.
     *
     * @param {String} $key Property to sort by.
     * @param {Array} $data Array that stores multiple associative arrays.
     */
     public function group_by($key, $data) {
        $result = array();

        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }

        return $result;
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'homeController@index');
Route::get('about-us/directors', 'aboutusController@directors');
Route::get('about-us/directors/{slug}', 'aboutusController@director');
Route::get('about-us/press-room', 'aboutusController@press');
Route::get('about-us/governance', 'aboutusController@governance');
Route::get('research/', 'researchController@index');
Route::get('research/projects/', 'researchController@projects');
Route::get('research/projects/{slug}/', 'researchController@project');
Route::get('research/staff-profiles', 'researchController@profiles');
Route::get('research/staff-profiles/{slug}', 'researchController@profile');
Route::get('research/online-resources/', 'researchController@resources');
Route::get('research/online-resources/{slug}', 'researchController@resource');
Route::get('collections', 'collectionsController@index');
Route::get('visit-us/', 'visitController@index');
Route::get('news/', 'newsController@index');
Route::get('departments/', 'departmentsController@index');
Route::get('departments/{slug}', 'departmentsController@details');
Route::get('news/feed/', 'newsController@atom');
Route::get('news/{slug}/', 'newsController@article');
Route::get('collections/{slug}/', 'collectionsController@details');
Route::get('departments/titled/{slug}/', 'departmentsController@details');
Route::get('learning/look-think-do/', 'learningController@lookthinkdomain');
Route::get('learning/look-think-do/{slug}', 'learningController@lookthinkdoactivity');
Route::get('learning/resources/', 'learningController@resources');
Route::get('learning/resources/{slug}', 'learningController@resource');
Route::get('learning/school-sessions/{slug}', 'learningController@session');
Route::get('learning/young-people/{slug}', 'learningController@young');
Route::get('themes/', 'themesController@index');
Route::get('themes/{slug}', 'themesController@theme');
Route::get('galleries', 'galleriesController@index');
Route::get('galleries/{slug}', 'galleriesController@gallery');
Route::get('exhibitions/', 'exhibitionsController@index');
Route::get('exhibitions/archive', 'exhibitionsController@archive');
Route::get('exhibitions/future', 'exhibitionsController@future');
Route::get('exhibitions/{slug}', 'exhibitionsController@details');
Route::get('objects-and-artworks/highlights', 'highlightsController@index');
Route::get('objects-and-artworks/', 'highlightsController@landing');
Route::get('objects-and-artworks/highlights/context/', 'highlightsController@contextual');
Route::get('objects-and-artworks/highlights/{slug}/', 'highlightsController@details');
Route::match(array('GET','POST'),'objects-and-artworks/highlights/search/results/', 'highlightsController@results');


Route::get('objects-and-artworks/highlights/context/{section}/', 'highlightsController@pharosSections');
Route::get('objects-and-artworks/highlights/context/{section}/{slug}/', 'highlightsController@associate');
Route::get('objects-and-artworks/audio-guide/', 'highlightsController@audioguide');
Route::get('objects-and-artworks/audio-guide/{slug}/', 'highlightsController@stop');

Route::get('search', 'searchController@index');
Route::get('search/staff', 'searchController@staff');
Route::get('search/news', 'searchController@news');
Route::get('search/stubs', 'searchController@stubs');
Route::get('search/researchprojects', 'searchController@researchprojects');
Route::get('search/galleries', 'searchController@galleries');
Route::get('search/collections', 'searchController@collections');
Route::get('search/lookthinkdo', 'searchController@lookthinkdo');
Route::get('search/pressroom', 'searchController@pressroom');
Route::get('search/departments', 'searchController@departments');
Route::get('search/directors', 'searchController@directors');
Route::get('search/themes', 'searchController@themes');
Route::get('search/highlightspages', 'searchController@pharospages');
Route::get('search/highlights', 'searchController@highlights');
Route::get('search/floor', 'searchController@floor');
Route::get('search/gov', 'searchController@governance');
Route::get('search/learningfiles', 'searchController@learningfiles');
Route::get('search/exhibitions', 'searchController@exhibitions');
Route::get('search/instagram', 'searchController@instagram');
Route::get('search/audio', 'searchController@audio');
Route::get('search/sessions', 'searchController@sessions');

Route::match(array('GET', 'POST'), 'search/results', [
    'uses' => 'searchController@results',
    'as' => 'search.results'
]);
/*
 * Route for checking solr up and running
 */
Route::get('/ping', 'searchController@ping');

//
//


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/{section}/{slug}/', 'pagesController@index');
Route::get('/{section}/', 'pagesController@landing');

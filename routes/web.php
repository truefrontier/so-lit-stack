<?php

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

use Statamic\Facades\Collection;

Collection::all()->each(function ($collection) {
    $collection->queryEntries()->get()->each(function ($entry) {
        $route = $entry->routeData();
        $url = $entry->url();
        $name = ltrim(str_replace('/', '.', $url), '.') ?: str_replace('/', '.', $route['slug']);
        Route::any($url, 'PageController@index')->name($name);
    });
});

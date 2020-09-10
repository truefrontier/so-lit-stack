<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Statamic\Entries\Collection;
use Statamic\Facades\Data;
use Statamic\Facades\Site;
use Statamic\Fields\Value;
use Statamic\Http\Controllers\FrontendController;
use Statamic\Statamic;
use Statamic\Support\Str;

class PageController extends FrontendController {

    public function index(Request $request) {
        $url = Site::current()->relativePath(
            str_finish($request->getUri(), '/')
        );

        if ($url === '') {
            $url = '/';
        }

        if (Statamic::isAmpRequest()) {
            $url = str_after($url, '/' . config('statamic.amp.route'));
        }

        if (Str::contains($url, '?')) {
            $url = substr($url, 0, strpos($url, '?'));
        }

        ## BEGIN EDIT
        $routeName = ltrim(str_replace('/', '.', $url), '.') ?: 'home';

        $pageName = collect(explode('.', $routeName))->map(function ($segment) {
            return Str::studly($segment);
        })->join('/');

        $cms = new \stdClass;
        $layoutName = null;
        $templateName = null;

        if ($data = Data::findByUri($url, Site::current()->handle())) {
            $cms = $data->toAugmentedArray();

            if (isset($cms['collection']) && $cms['collection'] instanceof Collection) {
                $collection = $cms['collection']->toArray();
                if (isset($collection['layout'])) {
                    $layoutName = Str::studly($collection['layout']);
                }
            }

            if (isset($cms['template']) && $cms['template'] instanceof Value) {
                $templateName = Str::studly($cms['template']->raw());
            }
        }

        // if (isset($cms['parent'])) {
        //     $cms['parent'] = $cms['parent']->toAugmentedArray();
        // }
        unset($cms['parent']);

        return Inertia::render($pageName, [
            'cms' => $cms,
        ])->withViewData([
            'statamic' => [
                'cms' => $cms,
                'pageName' => $pageName,
                'layoutName' => $layoutName,
                'templateName' => $templateName,
            ],
        ]);
        ## END EDIT ##
    }
}

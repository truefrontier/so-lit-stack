<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
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

        ## BEGIN EDIT - avoid error when the pages collection is set to Orderable
        ## The root route works fine, but any "children" throw an error
        if ($url === '/') {
            $url = '/home';
        }

        $pageName = collect(explode('/', $url))->filter()->map(function ($segment) {
            return Str::studly($segment);
        })->join('/');

        $layoutName = null;
        $templateName = null;
        $routeName = Str::studly($request->route()->getName());
        ## END EDIT ##

        if ($data = Data::findByUri($url, Site::current()->handle())) {
            ## BEGIN EDIT - return inertia render with augmented data
            $cms = $data->toAugmentedArray();

            if (isset($cms['template']) && $cms['template'] instanceof Value) {
                $layoutName = Str::studly($cms['template']->raw());
            }

            if (isset($cms['template']) && $cms['template'] instanceof Value) {
                $templateName = Str::studly($cms['template']->raw());
            }

            return Inertia::render($pageName, [
                'cms' => $cms,
            ])->withViewData([
                'statamic' => [
                    'cms' => $cms,
                    'pageName' => $pageName,
                    'layoutName' => $layoutName,
                    'templateName' => $templateName,
                    'routeName' => $routeName,
                ],
            ]);
            ## END EDIT ##
        }

        ## BEGIN EDIT - instead of 404 response, return Inertia render with empty array
        return Inertia::render($name, [
            'cms' => [],
        ])->withViewData([
            'statamic' => [
                'cms' => [],
                'pageName' => $pageName,
                'layoutName' => $layoutName,
                'templateName' => $templateName,
                'routeName' => $routeName,
            ],
        ]);
        ## END EDIT ##
    }

}

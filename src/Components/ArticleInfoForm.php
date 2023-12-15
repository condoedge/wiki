<?php

namespace Anonimatrix\Knowledge\Components;

use Anonimatrix\PageEditor\Components\Cms\PageInfoForm;
use Illuminate\Support\Facades\Route;

class ArticleInfoForm extends PageInfoForm
{
    public function beforeSave()
    {
        $this->model->associated_route = request('associated_route');
    }

    public function extraInputs()
    {
        return _Rows(
            _Input('translate.knowledge.subtitule')->name('subtitle'),
            _Select('translate.knowledge.linked-route')->options(
                collect(Route::getRoutes()->getRoutesByName())->mapWithKeys(fn($route, $name) => [$name => $name]),
            )->name('associated_route')
        );
    }
}
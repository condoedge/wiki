<?php

namespace Anonimatrix\Knowledge\Components\Forms;

use Anonimatrix\PageEditor\Components\Cms\PageInfoForm;
use Illuminate\Support\Facades\Route;

class ArticleInfoForm extends PageInfoForm
{
    public function beforeSave()
    {
        $this->model->associated_route = request('associated_route');
        $this->model->group_type = 'knowledge';
    }

    public function afterSave()
    {
        $this->model->tags()->sync(
            array_merge(request('subcategories_ids', []), request('categories_ids', [])),
        );
    }

    public function extraInputs()
    {
        return _Rows(
            _Input('knowledge.page-exterior-color')->type('color')->value($this->model->getExteriorBackgroundColor())->name('exterior_background_color'),
            _Input('knowledge.subtitle')->name('subtitle'),
            _Select('knowledge.linked-route')->options(
                collect(Route::getRoutes()->getRoutesByName())->mapWithKeys(fn($route, $name) => [$name => $name]),
            )->name('associated_route'),
            new ArticleCategoriesForm($this->model->id),
        );
    }
}
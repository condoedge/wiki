<?php

namespace Anonimatrix\Knowledge\Components\Forms;

use Anonimatrix\PageEditor\Components\Cms\PageInfoForm;
use Anonimatrix\PageEditor\Models\Tags\Tag;
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
            _Input('translate.knowledge.page-exterior-color')->type('color')->value($this->model->getExteriorBackgroundColor())->name('exterior_background_color'),
            _Input('translate.knowledge.subtitule')->name('subtitle'),
            _Select('translate.knowledge.linked-route')->options(
                collect(Route::getRoutes()->getRoutesByName())->mapWithKeys(fn($route, $name) => [$name => $name]),
            )->name('associated_route'),
            _FlexBetween(
                _MultiSelect('translate.knowledge.categories')->class('w-full')->options(
                    Tag::forPage()->categories()->pluck('name','id'),
                )->name('categories_ids', false)
                    ->default($this->model->tags()->categories()->pluck('tags.id'))
                    ->selfGet('getSubcategoriesSubSelect')->inPanel('subcategories_select'),
                _Button()->icon('plus')->class('ml-4')->selfGet('getCategoriesFormModal')->inModal(),
            ),
            _Panel(
                $this->getSubcategoriesSubSelect(),
            )->id('subcategories_select')
        );
    }

    public function getCategoriesFormModal()
    {
        return new ArticleCategoriesForm();
    }

    public function getSubcategoriesSubSelect()
    {
        return _MultiSelect('translate.knowledge.subcategories')
            ->options(
                Tag::forPage()->subcategories(request('categories_ids'))->pluck('name','id'),
            )->name('subcategories_ids', false)
            ->default($this->model->tags()->subcategories()->pluck('tags.id'));
    }
}
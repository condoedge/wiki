<?php

namespace Anonimatrix\Knowledge\Components\Forms;

use Anonimatrix\Knowledge\Components\ArticlesTagsQuery;
use Anonimatrix\PageEditor\Models\Page;
use Anonimatrix\PageEditor\Models\Tags\Tag;
use Kompo\Form;

class ArticleCategoriesForm extends Form
{
    public const ID = 'article_categories_form';
    public $id = self::ID;
    public $model = Page::class;

    public function render()
    {
        return _Rows(
            _FlexBetween(
                _MultiSelect('knowledge.categories')->class('w-full')->options(
                    Tag::forPage()->categories()->pluck('name','id'),
                )->name('categories_ids', false)
                    ->default($this->model->tags()->categories()->pluck('tags.id'))
                    ->selfGet('getSubcategoriesSubSelect')->inPanel('subcategories_select'),
                _Button()->icon('view-list')->class('ml-4')->selfGet('getTagsList')->inModal(),
                _Button()->icon('plus')->class('ml-4')->selfGet('getTagsFormModal')->inModal(),
            ),
            _Panel(
                $this->getSubcategoriesSubSelect(),
            )->id('subcategories_select')
        );
    }

    public function getTagsList()
    {
        return new ArticlesTagsQuery();
    }

    public function getTagsFormModal()
    {
        return new ArticlesTagsForm();
    }

    public function getSubcategoriesSubSelect()
    {
        return _MultiSelect('knowledge.subcategories')
            ->options(
                Tag::forPage()->subcategories(request('categories_ids'))->pluck('name','id'),
            )->name('subcategories_ids', false)
            ->default($this->model->tags()->subcategories()->pluck('tags.id'));
    }
}
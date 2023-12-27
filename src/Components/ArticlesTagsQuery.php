<?php

namespace Anonimatrix\Knowledge\Components;

use Anonimatrix\Knowledge\Components\Forms\ArticleCategoriesForm;
use Anonimatrix\PageEditor\Models\Tags\Tag;
use Kompo\Grid;

class ArticlesTagsQuery extends Grid
{
    public $class = 'px-8 py-6';

    public function query()
    {
        return Tag::forPage();
    }

    public function top()
    {
        return _Rows(
            _Html('translate.knowledge.tags')->class('font-semibold text-xl mb-4'),
        );
    }

    public function render($tag)
    {
        return _FlexBetween(
            _Html($tag->name)->class('text-blue-700'),
            _DeleteLink()->icon('x')->byKey($tag)->class('text-red-500 hover:text-red-700')->refresh(ArticleCategoriesForm::ID),
        )->class('mb-2 px-4 py-2 rounded-lg bg-blue-50 gap-2 mr-3');
    }
}
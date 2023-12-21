<?php

namespace Anonimatrix\Knowledge\Components\Forms;

use Anonimatrix\PageEditor\Components\Cms\PageContentForm;

class ArticlePageContentForm extends PageContentForm
{
    public $class = 'py-8';
    protected $prefixGroup = 'knowledge';

    protected function top()
    {
        return _FlexBetween(
            _Link('translate.knowledge.back-to-articles')->icon('arrow-left')->href('knowledge.list')->class('mb-4'),
            !$this->model->id ? null : _Link('translate.knowledge.article-in-list')->href('knowledge.articles', ['id' => $this->model->id])->class('mb-4'),
        );
    }
}
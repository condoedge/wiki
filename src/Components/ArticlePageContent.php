<?php

namespace Anonimatrix\Knowledge\Components;

use Anonimatrix\PageEditor\Components\Cms\PageContentForm;

class ArticlePageContent extends PageContentForm
{
    public $class = 'py-8';
    protected $prefixGroup = 'knowledge';

    public function beforeSave()
    {
        $this->model->group_type = 'knowledge';
    }
}
<?php

namespace Anonimatrix\Knowledge\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class KnowledgeServiceProvider extends ServiceProvider
{
    public function boot()
    {
       $this->publishes([
        __DIR__ . '/../../migrations/' => database_path('migrations/knowledge'),
       ], 'knowledge');

       Config::set('page-editor.components.knowledge.page-content-form', \Anonimatrix\Knowledge\Components\ArticlePageContent::class);
       Config::set('page-editor.components.knowledge.page-info-form', \Anonimatrix\Knowledge\Components\ArticleInfoForm::class);
       Config::set('page-editor.components.knowledge.page-design-form', \Anonimatrix\PageEditor\Components\Cms\PageDesignForm::class);
    }
}
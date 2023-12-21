<?php

namespace Anonimatrix\Knowledge\Services;

use Illuminate\Support\Facades\Route;

class KnowledgeService 
{
    public static function setEditorRoute()
    {
        Route::get('knowledge-editor/{id?}', \Anonimatrix\Knowledge\Components\Forms\ArticlePageContentForm::class)->name('knowledge.editor');
    }

    public static function setRawListRoute()
    {
        Route::get('knowledge-list', \Anonimatrix\Knowledge\Components\ArticleRawList::class)->name('knowledge.list');
    }

    public static function setArticlesRoute()
    {
        Route::get('knowledge-articles/whats-new', \Anonimatrix\Knowledge\Components\ArticlePage::class)->name('knowledge.whats-new');
        Route::get('knowledge-articles/{id?}', \Anonimatrix\Knowledge\Components\ArticlePage::class)->name('knowledge.articles');
    }
}
<?php

namespace Anonimatrix\Knowledge\Services;

use Illuminate\Support\Facades\Route;

class KnowledgeService
{
    /**
     * Set the routes for the knowledge editor.
     */
    public static function setEditorRoute()
    {
        Route::get('knowledge-editor/{id?}', \Anonimatrix\Knowledge\Components\Forms\ArticlePageContentForm::class)->name('knowledge.editor');
    }

    /**
     * Set route for the raw list of articles. Used for admin purposes.
     */
    public static function setRawListRoute()
    {
        Route::get('knowledge-list', \Anonimatrix\Knowledge\Components\ArticleRawList::class)->name('knowledge.list');
    }

    /**
     * Set the routes for the articles. We have two routes:
     * 1. The articles list route and the article page route
     * 2. The what's new route
     */
    public static function setArticlesRoute()
    {
        Route::get('knowledge-articles/whats-new', \Anonimatrix\Knowledge\Components\ArticlePage::class)->name('knowledge.whats-new');
        Route::get('knowledge-articles/{id?}', \Anonimatrix\Knowledge\Components\ArticlePage::class)->name('knowledge.articles');
    }
}

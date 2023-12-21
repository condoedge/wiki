<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->get('knowledge-editor/{id?}', \Anonimatrix\Knowledge\Components\Forms\ArticlePageContentForm::class)->name('knowledge.editor');
Route::get('knowledge-articles/{id?}', \Anonimatrix\Knowledge\Components\ArticlePage::class)->name('knowledge.articles');
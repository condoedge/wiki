<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->get('knowledge-editor/{id?}', \Anonimatrix\Knowledge\Components\ArticlePageContent::class)->name('knowledge.editor');
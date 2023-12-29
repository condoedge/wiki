<?php

namespace Anonimatrix\Knowledge\Components;

use Anonimatrix\PageEditor\Models\Page;
use Kompo\Table;

class ArticleRawList extends Table
{
    public $orderable = 'order';
	public $dragHandle = '.dragHandle';
	public $browseAfterOrder = true;

	public $id = 'pages-orderable-list';

	public function query()
	{
		return Page::whereNull('page_id')->orderBy('order')
            ->where('group_type', 'knowledge');
	}

	public function top()
	{
		return _Rows(
			_Flexbetween(
				_H1('knowledge.articles')->medTitle()->class('text-level3'),
				_Link('knowledge.create-article')->button()->icon('icon-plus')->href('knowledge.editor'),
			),
            _FlexEnd(
                _Input()->placeholder('knowledge.search')->name('title')->class('mb-0 whiteField w-full')->filter()
            ),
		)->class('space-y-4 mb-4');
	}

    public function headers()
    {
        return [
            _Th('#')->class('pl-14'),
            _Th('knowledge.title')->class('pl-4'),
            _Th('knowledge.actions')->class('pr-2 w-20'),
        ];
    }

    public function render($page)
    {
        return _TableRow(
            _Html(),
            _Link($page->title)->href('knowledge.editor', ['id'=> $page->id]),
            _Link()->icon('pencil')->href('knowledge.editor', ['id'=> $page->id]),
        );
    }
}
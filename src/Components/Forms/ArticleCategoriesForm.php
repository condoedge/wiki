<?php

namespace Anonimatrix\Knowledge\Components\Forms;

use Anonimatrix\PageEditor\Models\Tags\Tag;
use Kompo\Modal;

class ArticleCategoriesForm extends Modal
{
    public $model = Tag::class;

    public $_Title = 'translate.knowledge.categories';

    public function beforeSave()
    {
        $this->model->tag_id = request('tag_id');
    }

    public function body()
    {
        return _Rows(
            _Hidden()->name('tag_type')->value(Tag::TAG_TYPE_PAGE),
            _Input('translate.knowledge.category-name')->name('name'),
            _ButtonGroup('translate.knowledge.tag-type')
                ->optionClass('px-4 py-2 text-center cursor-pointer')
                ->selectedClass('bg-level3 text-white font-medium', 'bg-gray-200 text-level3 font-medium')
                ->class('mb-2')->options([
                    'categorie' => 'translate.knowledge.categorie',
                    'subcategorie' => 'translate.knowledge.subcategorie',
                ])->name('type', false)->default('categorie')->selfGet('getTypeInputs')->inPanel('type_inputs'),
            _Panel()->id('type_inputs'),
            _FlexEnd(
                _SubmitButton('translate.knowledge.save')->closeModal(),
            )->class('mt-4'),
        );
    }

    public function getTypeInputs()
    {
        if(request('type') == 'categorie') return null;

        return _Select('translate.knowledge.category-parent')->options(
            Tag::forPage()->categories()->pluck('name','id'),
        )->name('tag_id')->class('mt-2');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'tag_type' => 'required',
            'tag_id' => 'required_if:type,subcategorie',
        ];
    }
}
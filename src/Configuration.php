<?php

namespace SysHub\UnionSkinAdapter;

use Option;

class Configuration
{
    public function render()
    {
        $form = Option::form(
            'union_skin_adapter',
            trans('SysHub\UnionSkinAdapter::options.title'),
            function ($form) {
                $form->textarea(
                    'union_skin_adapter_intro_'.config('app.locale'),
                    trans('SysHub\UnionSkinAdapter::options.custom_intro.title')
                )->rows(5)
                ->description(trans('SysHub\UnionSkinAdapter::options.custom_intro.description'));
            }
        )->handle();

        return view('SysHub\UnionSkinAdapter::config', compact('form'));
    }
}

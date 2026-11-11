<?php

use App\Services\Hook;

return function () {
    Hook::addMenuItem('user', 3, [
        'title' => 'SysHub\UnionSkinAdapter::config.generate-config',
        'link' => 'user/config',
        'icon' => 'fa-book',
    ]);

    Hook::addRoute(function () {
        Route::get(
            '/user/config',
            'SysHub\UnionSkinAdapter\Controller@generate'
        )->middleware(['web', 'auth']);
    });
};

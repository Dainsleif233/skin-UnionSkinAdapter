<?php

namespace SysHub\UnionSkinAdapter;

use App\Services\Hook;

class Controller
{
    public function generate()
    {
        $siteName = option_localized('site_name');

        $mojang = ['name' => 'Mojang', 'type' => 'MojangAPI'];
        $union = [
            'name' => 'Union',
            'type' => 'MojangAPI',
            'apiRoot' => 'https://skin.mualliance.ltd/api/union/yggdrasil/api/',
            'sessionRoot' => 'https://skin.mualliance.ltd/api/union/yggdrasil/sessionserver/',
        ];
        $self = [
            'name' => $siteName,
            'root' => url('/csl').'/',
            'type' => 'CustomSkinAPI',
        ];
        $csl = [
            'enable' => true,
            'loadlist' => [$union, $self, $mojang],
        ];

        Hook::addScriptFileToPage(plugin_assets('union-skin-adapter', 'generator.js'));

        $jsonConstants = JSON_PRETTY_PRINT
            | JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES;

        return view('SysHub\UnionSkinAdapter::generator', [
            'csl' => json_encode($csl, $jsonConstants),
            'site' => $siteName,
        ]);
    }
}

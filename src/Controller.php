<?php

namespace SysHub\UnionSkinAdapter;

use App\Services\Hook;
use App\Services\PluginManager;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class Controller
{
    public function generate(PluginManager $plugins)
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

        $intro = option_localized('union_skin_adapter_intro', '');
        $converter = new GithubFlavoredMarkdownConverter();
        $intro = $converter->convertToHtml($intro);

        return view('SysHub\UnionSkinAdapter::generator', [
            'csl' => json_encode($csl, $jsonConstants),
            'has_legacy' => optional($plugins->get('legacy-api'))->isEnabled(),
            'site' => $siteName,
            'custom_intro' => $intro,
        ]);
    }
}

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
        $self = [
            'name' => $siteName,
            'root' => url('/csl').'/',
            'type' => 'CustomSkinAPI',
        ];
        if (option('csl_first', 'self') === 'self') {
            $csl = [
                'enable' => true,
                'loadlist' => [$self, $mojang],
            ];
        } else {
            $csl = [
                'enable' => true,
                'loadlist' => [$mojang, $self],
            ];
        }

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

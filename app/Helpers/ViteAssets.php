<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;

class ViteAssets
{
    /**
     * @return HtmlString
     */
    public static function generate(): HtmlString {
        $devServerIsRunning = false;

        if(app()->environment('local')) {
            $devServerIsRunning = true;
        }

        if($devServerIsRunning) {
            return new HtmlString(<<<HTML
            <script type="module" src="http://localhost:3001/@vite/client"></script>
            <script type="module" src="http://localhost:3001/resources/js/app.ts"></script>
        HTML
            );
        }

        $manifest = json_decode(file_get_contents(public_path('dist/manifest.json')), true);

        return new HtmlString(<<<HTML
        <script type="module" src="/dist/{$manifest['resources/js/app.ts']['file']}"></script>
        <link rel="stylesheet" href="/dist/{$manifest['resources/js/app.ts']['css'][0]}">
    HTML
        );
    }
}
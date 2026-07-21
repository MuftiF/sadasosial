<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/', RecursiveRegexIterator::GET_MATCH);

$map = [
    '📝' => '<x-heroicon-o-pencil-square class="w-4 h-4 inline-block mr-1" />',
    '📁' => '<x-heroicon-o-folder class="w-4 h-4 inline-block mr-1" />',
    '📥' => '<x-heroicon-o-arrow-down-tray class="w-4 h-4 inline-block mr-1" />',
    '✏️' => '<x-heroicon-o-pencil class="w-4 h-4 inline-block mr-1" />',
    '⚠️' => '<x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" />',
    '📋' => '<x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" />',
    '🚗' => '<x-heroicon-o-truck class="w-5 h-5 inline-block mr-1" />',
    '✅' => '<x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" />',
    '📊' => '<x-heroicon-o-chart-bar class="w-5 h-5 inline-block mr-1" />',
    '🖨️' => '<x-heroicon-o-printer class="w-4 h-4 inline-block mr-1" />',
    '📤' => '<x-heroicon-o-arrow-up-tray class="w-5 h-5 inline-block mr-1" />',
    '📎' => '<x-heroicon-o-paper-clip class="w-5 h-5 inline-block mr-1" />',
    '🖼️' => '<x-heroicon-o-photo class="w-5 h-5 inline-block mr-1" />',
    '📄' => '<x-heroicon-o-document-text class="w-4 h-4 inline-block mr-1" />',
    '🔑' => '<x-heroicon-o-key class="w-5 h-5 inline-block mr-1" />',
    '🗳️' => '<x-heroicon-o-inbox-stack class="w-5 h-5 inline-block mr-1" />',
    '📸' => '<x-heroicon-o-camera class="w-5 h-5 inline-block mr-1" />',
    '⏳' => '<x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" />',
    '⬜' => '<x-heroicon-o-stop class="w-4 h-4 inline-block mr-1" />',
    '❌' => '<x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" />',
    '✓'  => '<x-heroicon-s-check class="w-3 h-3 inline-block" />',
    '🏠' => '<x-heroicon-o-home class="w-5 h-5 inline-block mr-1" />',
    '🔍' => '<x-heroicon-o-magnifying-glass class="w-5 h-5 inline-block mr-1" />',
    '👥' => '<x-heroicon-o-users class="w-5 h-5 inline-block mr-1" />',
    '⚙️' => '<x-heroicon-o-cog-6-tooth class="w-5 h-5 inline-block mr-1" />',
    '🚪' => '<x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 inline-block mr-1" />',
    '✨' => '<x-heroicon-o-sparkles class="w-5 h-5 inline-block mr-1" />',
    '🛡️' => '<x-heroicon-o-shield-check class="w-5 h-5 inline-block mr-1" />',
    '💳' => '<x-heroicon-o-credit-card class="w-5 h-5 inline-block mr-1" />',
    '🔔' => '<x-heroicon-o-bell class="w-5 h-5 inline-block mr-1" />',
    '🚀' => '<x-heroicon-o-rocket-launch class="w-5 h-5 inline-block mr-1" />',
    '📍' => '<x-heroicon-o-map-pin class="w-5 h-5 inline-block mr-1" />',
    '💼' => '<x-heroicon-o-briefcase class="w-5 h-5 inline-block mr-1" />',
    '📑' => '<x-heroicon-o-document-duplicate class="w-5 h-5 inline-block mr-1" />',
];

$count = 0;
foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $newContent = strtr($content, $map);
    if ($content !== $newContent) {
        file_put_contents($path, $newContent);
        echo "Updated: $path\n";
        $count++;
    }
}
echo "Total files updated: $count\n";

<?php
defined('ALTUMCODE') || die();

return (object) [
    'plugin_id' => 'aix',
    'name' => 'AIX - Text & Images AI Assistant',
    'description' => 'This plugin implements the OpenAI API system for content writing & image generation.',
    'version' => '3.0.0',
    'url' => 'https://altumco.de/aix-plugin',
    'author' => 'AltumCode',
    'author_url' => 'https://altumcode.com/',
    'status' => 'inexistent',
    'actions'=> true,
    'settings_url' => url('admin/settings/aix'),
    'avatar_style' => 'background: #4CA1AF;background: -webkit-linear-gradient(to right, #C4E0E5, #4CA1AF); background: linear-gradient(to right, #C4E0E5, #4CA1AF);',
    'icon' => '🤖',
];

<?php
use App\Models\ThemeModel;

function getActiveTheme()
{
    $themeModel = new ThemeModel();
    $activeTheme = $themeModel->where('is_active', 1)->first();

    return $activeTheme ? 'themes/' . $activeTheme['theme_name'] . '/' : 'themes/default/';
}

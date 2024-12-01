<?php

use App\Models\SlideModel;
use App\Models\SliderModel;
use App\Models\ThemeModel;

function getActiveTheme()
{
    $themeModel = new ThemeModel();
    $activeTheme = $themeModel->where('is_active', 1)->first();

    return $activeTheme ? 'themes/' . $activeTheme['theme_name'] . '/' : 'themes/default/';
}

//loades slides to the home slider
function homeSlides($sliderId)
{
    $sliderModel = new SliderModel();
    $slideModel = new SlideModel();
    // Fetch slider
    $slider = $sliderModel->find($sliderId);

    // Get the response object
    $response = service('response');
    if (!$slider) {
        return $response->setStatusCode(404, 'Slider not found');
    }

    // Fetch slides for the slider
    $slides = $slideModel
        ->select('title, description, image, button_text, button_link')
        ->where('slider_id', $sliderId)
        ->orderBy('position', 'ASC')
        ->findAll();

    // Return slides object
    return $slides;
}
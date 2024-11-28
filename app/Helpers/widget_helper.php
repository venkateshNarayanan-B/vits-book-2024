<?php
use App\Models\WidgetPlacementModel;

if (!function_exists('renderWidgets')) {
    /**
     * Render widgets for a specific position
     *
     * @param int $position The position identifier (e.g., Header, Footer, etc.)
     * @return void
     */
    function renderWidgets($position) {
        $widgetPlacementModel = new WidgetPlacementModel();

        // Fetch widgets for the given position
        $widgets = $widgetPlacementModel
            ->where('position', $position)
            ->orderBy('order', 'ASC')
            ->findAll();

        // Render widgets
        foreach ($widgets as $widget) {
            // Example: Echo the widget content (or load a view for advanced rendering)
            echo $widget['content']; // Replace 'content' with the correct column name
        }
    }
}

<?php
namespace app\core;
/**
 * представление
 */
class View
{
    function render(string $view, $data = null)
    {
        if (is_array($data)) extract($data);
        include 'app/views/' . $view;
    }
}
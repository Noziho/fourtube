<?php

namespace App\Controller;

abstract class AbstractController {

    abstract public function index ();

    public static function render(string $template, array $data = []): void
    {
        ob_start();
        require __DIR__ . "/../../View/" . $template . ".html.php";
        $html = ob_get_clean();
        require __DIR__ . "/../../View/base.html.php";
    }

    public static function formIsset(...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name]) || empty($_POST[$name])) {
                return false;
            }
        }
        return true;
    }

    public static function rangeCheck (int $min, int $max, string $inputName, string $redirect): void
    {
        if (strlen($inputName) < $min || strlen($inputName) > $max) {
            header("Location: $redirect");
            exit();
        }
    }
}
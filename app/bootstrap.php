<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/routes.php");


(new \Symfony\Component\Dotenv\Dotenv())->usePutenv()->load(__DIR__ . '/../.env');

$twig_loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views/');
Flight::register("view", "Twig\Environment", [$twig_loader, ["cache" => __DIR__ . "/../../var/cache/twig/", 'debug' => (bool)getenv('DEBUG')]], function ($twig) {
    if ((bool)getenv('DEBUG')) {
        $twig->addExtension(new \Twig\Extension\DebugExtension());
    }
});
Flight::map('render', function (string $template, array $data = []) : void {
    echo Flight::view()->render($template . ".html.twig", $data);
});

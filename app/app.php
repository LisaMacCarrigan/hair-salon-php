<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=hair_salon";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app["twig"]->render("index.html.twig");
    });

//--------------------------- Stylists ----------------------------//

    $app->get("/stylists", function() use ($app) {
        return $app["twig"]->render("stylists.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->get("/add_stylist", function() use ($app) {
        $new_stylist_name = $_GET["input-stylist-name"];
        $new_stylist = new Stylist($new_stylist_name);
        $new_stylist->save();
    });

    return $app;
 ?>

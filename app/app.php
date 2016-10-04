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

    $app->get("/stylists/{stylist_id}", function($stylist_id) use($app) {
    $current_stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array(
            'single_stylist' => $current_stylist,
            'all_clients' => Client::getAll(),
            'clients_for_this_stylist' => $current_stylist->getClients()
        ));
    });

    $app->post("/add_stylist", function() use ($app) {
        $new_stylist_name = $_POST["input-stylist-name"];
        $new_stylist = new Stylist($new_stylist_name);
        $new_stylist->save();
        return $app["twig"]->render("stylists.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->post("delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app["twig"]->render("stylists.html.twig");
    });



//--------------------------- Clients ----------------------------//

    $app->get("/clients", function() use ($app) {
        return $app["twig"]->render("clients.html.twig", array("clients" => Client::getAll()));
    });

    $app->post("/add_client", function() use ($app) {
        $new_client_name = $_POST["input-client-name"];
        $id = null;
        $new_client = new Client($id, $new_client_name);
        $new_client->save();
        return $app["twig"]->render("clients.html.twig", array("clients" => Client::getAll()));
    });

    $app->post("delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app["twig"]->render("clients.html.twig");
    });

    return $app;
 ?>

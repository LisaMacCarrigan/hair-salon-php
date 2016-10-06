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

//--------------------------- Stylists Logic ----------------------------//

    $app->get("/stylists", function() use ($app) {
        return $app["twig"]->render("stylists.html.twig", array("stylists" => Stylist::getAll()));
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

//--------------------------- Individual Stylist Logic ----------------------------//

    $app->get("/stylists/{id}", function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app["twig"]->render("stylist.html.twig", array(
            "stylist" => $stylist,
            "clients" => $stylist->getClients(),
        ));
    });

    $app->post("/add_client_to_stylist", function() use ($app) {
        $new_client_name = $_POST["input-client-name"];
        $stylist_id = $_POST["stylist_id"];
        $stylist = Stylist::find($stylist_id);
        $new_client = new Client($new_client_name, $stylist_id);
        $new_client->save();
        return $app["twig"]->render("stylist.html.twig", array(
            "stylist" => $stylist,
            "clients" => $stylist->getClients()
        ));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app["twig"]->render("stylist_edit.html.twig", array(
            "stylist" => $stylist
        ));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST["stylist_name"];
        $stylist = Stylist::find($id);
        $stylist->updateStylist($name);
        return $app["twig"]->render("stylist.html.twig", array(
            "stylist" => $stylist,
            "clients" => $stylist->getClients()
        ));
    });


//--------------------------- Clients Logic ----------------------------//

    $app->get("/clients", function() use ($app) {
        return $app["twig"]->render("clients.html.twig", array(
            "clients" => Client::getAll(),
            "stylists" => Stylist::getAll()
        ));
    });

    $app->post("/add_client", function() use ($app) {
        $new_client_name = $_POST["input-client-name"];
        $stylist_id = $_POST["stylist_id"];
        $new_client = new Client($new_client_name, $stylist_id);
        $new_client->save();
        return $app["twig"]->render("clients.html.twig", array(
            "clients" => Client::getAll(),
            "stylists" => Stylist::getAll()
        ));
    });

    $app->post("delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app["twig"]->render("clients.html.twig", array(
            "stylists" => Stylist::getAll()
        ));
    });

    //--------------------------- Individual Client Logic ----------------------------//

    $app->get("/clients/{id}", function($id) use($app) {
        $client = Client::find($id);
        $client_stylist_id = $client->getStylistId();
        $client_stylist = Stylist::find($client_stylist_id);

        return $app["twig"]->render("client.html.twig", array(
            "client" => $client,
            "stylist" => $client_stylist
        ));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app["twig"]->render("client_edit.html.twig", array(
            "client" => $client
        ));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
        $updated_name = $_POST["client_name"];
        $client = Client::find($id);
        $client_stylist_id = $client->getStylistId();
        $client_stylist = Stylist::find($client_stylist_id);
        $client->updateClient($updated_name);
        return $app["twig"]->render("client.html.twig", array(
            "client" => $client,
            "stylist" => $client_stylist
        ));
    });



    return $app;
 ?>

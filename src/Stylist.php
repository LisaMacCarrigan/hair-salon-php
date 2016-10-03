<?php

    class Stylist
    {
        private $id;
        private $name;

        function __construct($id = null, $stylist_name_input)
        {
            $this->id = $id;
            $this->name = $stylist_name_input;
        }

        function getId()
        {
            return $this->id;
        }

        function setStylistName($stylist_name_input)
        {
            $this->name = $stylist_name_input;
        }

        function getStylistName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getStylistName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach ($returned_stylists as $stylist) {
                $id = $stylist['id'];
                $name = $stylist['name'];
                $new_stylist = new Stylist($id, $name);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $stylist_search_result = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist)
            {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id)
                {
                    $stylist_search_result = $stylist;
                }
                return $stylist_search_result;
            }
        }

        function updateStylist($new_stylist_name)
        {
          $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_stylist_name}' WHERE id = {$this->getId()};");
          $this->setStylistName($new_stylist_name);
        }

        function getClients()
        {
            $clients = array();

            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");

            foreach ($returned_clients as $client)
            {
              $id = $client["id"];
              $name = $client["name"];
              $stylist_id = $client["stylist_id"];

              $new_client = new Client($id, $name, $stylist_id);
              array_push($clients, $new_client);
            }
            return $clients;
        }

    }

?>

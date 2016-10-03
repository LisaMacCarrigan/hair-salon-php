<?php

    class Client
    {
        private $id;
        private $name;
        private $stylist_id;

        function __construct($id = null, $client_name_input, $the_stylist_id)
        {
            $this->id = $id;
            $this->name = $client_name_input;
            $this->stylist_id = $the_stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setClientName($client_name_input)
        {
            $this->name = $client_name_input;
        }

        function getClientName()
        {
            return $this->name;
        }

        function setStylistId($the_stylist_id)
        {
            $this->stylist_id = $the_stylist_id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients");
            $clients = array();
            foreach($returned_clients as $client) {
                $id = $client['id'];
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($id, $name, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients where id = {$this->getId()};");
        }

        static function find($search_id) {
            $client_search_result = null;
            $clients = Client::getAll();
            foreach($clients as $client)
            {
                $client_id = $client->getId();
                if ($client_id == $search_id)
                {
                    $client_search_result = $client;
                }
                return $client_search_result;
            }
        }

        function updateClient($new_client_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_client_name}' WHERE id = {$this->getId()};");
            $this->setClientName($new_client_name);
        }
    }

?>

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
    }

?>

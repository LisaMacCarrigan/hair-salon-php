<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase {
        protected function tearDown() {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function testSave() {

            //ARRANGE
            $id = null;
            $name = "Lisa Marie";
            $stylist_id = 1;
            $new_client_test = new Client($id, $name, $stylist_id);
            $new_client_test->save();

            //ACT
            $result = $new_client_test::getAll();

            //ASSERT

            $this->assertEquals($new_client_test, $result[0]);
        }

        function testGetAll() {

            //ARRANGE
                // ---- save a new client ----
            $id = null;
            $name_1 = "Lisa Marie";
            $stylist_id = 1;
            $new_client_1 = new Client($id, $name_1, $stylist_id);
            $new_client_1->save();

                // ---- save another new client ----
            $id = null;
            $name_2 = "Jane Doe";
            $stylist_id = 1;
            $new_client_2 = new Client($id, $name_2, $stylist_id);
            $new_client_2->save();

            //ACT
            $result = Client::getAll();

            //ASSERT
            $this->assertEquals([$new_client_1, $new_client_2], $result);
        }

        function testDeleteAll() {

            //ARRANGE
                // ---- save a new client ----
            $id = null;
            $name_1 = "Lisa Marie";
            $stylist_id = 1;
            $new_client_1 = new Client($id, $name_1, $stylist_id);
            $new_client_1->save();

                // ---- save another new client ----
            $id = null;
            $name_2 = "Jane Doe";
            $stylist_id = 1;
            $new_client_2 = new Client($id, $name_2, $stylist_id);
            $new_client_2->save();

            //ACT
            Client::deleteAll();
            $result = Client::getAll();

            //ASSERT
            $this->assertEquals([], $result);
        }

        function testFind() {

            //ARRANGE
            $id = null;
            $name = "Lisa Marie";
            $stylist_id = 1;
            $new_client = new Client($id, $name, $stylist_id);
            $new_client->save();

            //ACT
            $result = Client::find($new_client->getId());

            //ASSERT
            $this->assertEquals($new_client, $result);
        }
    }


?>

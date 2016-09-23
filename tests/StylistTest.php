<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Stylist::deleteAll();
        }

        function test_save() {

            // ARRANGE
            $id = null;
            $name = "Kyle Krieger";
            $new_stylist_test = new Stylist($id, $name);
            $new_stylist_test->save();

            // ACT
            $result = $new_stylist_test::getAll();

            // ASSERT
            $this->assertEquals($new_stylist_test, $result[0]);

        }

    }

?>

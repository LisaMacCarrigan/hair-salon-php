<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php"; // this might not be necessary

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

        function test_getAll() {

            // ARRANGE
                // ---- save a new stylist ----
            $id = null;
            $name_1 = "Kyle Krieger";
            $new_stylist_1 = new Stylist($id, $name_1);
            $new_stylist_1->save();
                // ---- save another new stylist ----
            $name_2 = "Nicky Clarke";
            $new_stylist_2 = new Stylist($id, $name_2);
            $new_stylist_2->save();

            // ACT
            $result = Stylist::getAll();

            // ASSERT
            $this->assertEquals([$new_stylist_1, $new_stylist_2], $result);

        }

        function test_deleteAll() {

            // ARRANGE
            $id = null;
            $name_1 = "Kyle Krieger";
            $new_stylist_1 = new Stylist($id, $name_1);
            $new_stylist_1->save();
                // ---- save another new stylist ----
            $name_2 = "Nicky Clarke";
            $new_stylist_2 = new Stylist($id, $name_2);
            $new_stylist_2->save();

            // ACT
            Stylist::deleteAll();
            $result = Stylist::getAll();

            // ASSERT
            $this->assertEquals([], $result);

        }

        function test_find() {

            // ARRANGE
            $id = null;
            $name = "Kyle Krieger";
            $new_stylist = new Stylist($id, $name);
            $new_stylist->save();

            // ACT
            $result = Stylist::find($new_stylist->getId());

            // ASSERT
            $this->assertEquals($new_stylist, $result);

        }

        function test_UpdateStylist() {

          // ARRANGE
          $id = null;
          $name = "Kyle Krieger";
          $new_stylist = new Stylist($id, $name);
          $new_stylist->save();

          $new_stylist_name = "Nicky Clarke";

          // ACT
          $new_stylist->updateStylist($new_stylist_name);

          // ASSERT
          $this->assertEquals($new_stylist_name, $new_stylist->getStylistName());

        }

    }

?>

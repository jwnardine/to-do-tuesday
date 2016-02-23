<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Task.php";
   require_once "src/Category.php";

   $server = 'mysql:host=localhost;dbname=to_do_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);


   class TaskTest extends PHPUnit_Framework_TestCase
   {
       protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Home stuff"
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_cateogry->getId();
            $test_Task = new Task($description, $id, $category_id);
            $test_task->save();

            //Act
            $result = $test_Task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }



       function test_save()
       {
           //Arrange
           $description = "Wash the dog";
           $test_task = new Task($description);

           //Act
           $test_task->save();

           //Assert
           $result = Task::getAll();
           $this->assertEquals($test_task, $result[0]);
       }

       function test_getAll()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            $id = $test_task->getId();
            $result = Task::find($id);

            //Assert
            $this->assertEquals($test_task, $result);
        }
   }

?>

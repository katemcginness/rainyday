<?php
include "templates/header.php";
include "templates/navnew.php";

//simple if/else statement to check if the id is available
if (isset($_GET['id'])) {
    //yes the id exists
    try {
        // include the config file that we created last week
        require "../config.php";
        require "common.php";
        
        // run when submit button is clicked
        if (isset($_POST['save'])) {
            try {
                $connection = new PDO($dsn, $username, $password, $options);  
                
                //grab elements from form and set as varaible
                $expenses =[
                    "id"         => $_POST['id'],
                    "expensename" => $_POST['expensename'],
                    "expenseamount"  => $_POST['expenseamount'],
                    "expensefrequency"   => $_POST['expensefrequency']
                ];
            
                // create SQL statement
                $sql = "UPDATE `expenses` 
                        SET id = :id, 
                            expensename = :expensename, 
                            expenseamount = :expenseamount, 
                            expensefrequency = :expensefrequency
                        WHERE id = :id";
            
                //prepare sql statement
                $statement = $connection->prepare($sql);
            
                //execute sql statement
                $statement->execute($expenses);
  
                
                } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }

        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set if as variable
        $id = $_GET['id'];

        //select statement to get the right data
        $sql = "SELECT * FROM expenses WHERE id = :id";

        // prepare the connection
        $statement = $connection->prepare($sql);

        //bind the id to the PDO id
        $statement->bindValue(':id', $id);

        // now execute the statement
        $statement->execute();

        // attach the sql statement to the new income variable so we can access it in the form
        $income = $statement->fetch(PDO::FETCH_ASSOC);

    } catch (PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    
    ?>

<div class="container">
    <div class="col s12">
        <h2>Edit expense</h2>
        <p>How to input the value into a select?</p>
            <form method="post">
                <div class="row">
                    
                    <input type="hidden" name="id" id="id" value="<?php echo escape($expenses['id']); ?>" > 

                    <div class="col s4">
                        <label for="expensename">Expense name</label>    
                        <input type="text" name="expensename" id="expensename" class="validate" value="<?php echo escape($expenses['expensename']); ?>">                   
                    </div>
                
                    <div class="col s4">
                        <label for="expenseamount">Expense amount (to the dollar)</label>
                        <input type="text" name="expenseamount" id="expenseamount" class="validate" value="<?php echo escape($expenses['expenseamount']); ?>">
                    </div>

                    <div class="col s4">
                        <label for="expensefrequency">Expense amount (to the dollar)</label>
                        <input type="text" name="expensefrequency" id="expensefrequency" class="validate" value="<?php echo escape($expenses['expensefrequency']); ?>">
                    </div>
                    
                    
            
            </div>

            <div class="row col s12">
                <input onclick="return confirm('Are you sure you want to save?')" class="btn waves-effect waves-light" type="submit" name="save" value="save">
                <a href="index.php" class="waves-effect waves-teal btn-flat">Cancel</a>
            </div>
        
        </form> 
    </div>
</div>


<?php
} else {
    // no id, show error
    echo "No id - something went wrong";
    //exit;
}
?>
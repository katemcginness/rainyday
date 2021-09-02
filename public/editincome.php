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
                $income =[
                    "id"         => $_POST['id'],
                    "incomename" => $_POST['incomename'],
                    "incomeamount"  => $_POST['incomeamount'],
                    "incomefrequency"   => $_POST['incomefrequency']
                ];
            
                // create SQL statement
                $sql = "UPDATE `income` 
                        SET id = :id, 
                            incomename = :incomename, 
                            incomeamount = :incomeamount, 
                            incomefrequency = :incomefrequency
                        WHERE id = :id";
            
                //prepare sql statement
                $statement = $connection->prepare($sql);
            
                //execute sql statement
                $statement->execute($income);
  
                
                } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }

        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set if as variable
        $id = $_GET['id'];

        //select statement to get the right data
        $sql = "SELECT * FROM income WHERE id = :id";

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
        <h2>Edit income</h2>
            <form method="post">
                <div class="row">
                    
                    <input type="hidden" name="id" id="id" value="<?php echo escape($income['id']); ?>" > 

                    <div class="col s4">
                        <label for="incomename">Income name</label>    
                        <input type="text" name="incomename" id="incomename" class="validate" value="<?php echo escape($income['incomename']); ?>">                   
                    </div>
                
                    <div class="col s4">
                        <label for="incomeamount">Income amount (to the dollar)</label>
                        <input type="text" name="incomeamount" id="incomeamount" class="validate" value="<?php echo escape($income['incomeamount']); ?>">
                    </div>
                    
                    <div class="input-field col s4">
                    <label class="active" for="incomefrequency">Income frequency</label>
                    <?php
                    
                        if($income['incomefrequency'] == "Weekly") {
                            echo "<select class='visible' name='incomefrequency' id='incomefrequency'>
                                <option selected value='Weekly'>Weekly</option>
                                <option value='Fortnightly'>Fortnightly</option>
                                <option value='Monthly'>Monthly</option>
                            </select>";
                        }
                        elseif($income['incomefrequency'] == "Fortnightly") {
                            echo "<select class='visible' name='incomefrequency' id='incomefrequency'>
                                <option value='Weekly'>Weekly</option>
                                <option selected value='Fortnightly'>Fortnightly</option>
                                <option value='Monthly'>Monthly</option>
                            </select>";
                        }
                        elseif($income['incomefrequency'] == "Monthly") {
                            echo "<select class='visible' name='incomefrequency' id='incomefrequency'>
                                <option value='Weekly'>Weekly</option>
                                <option value='Fortnightly'>Fortnightly</option>
                                <option selected value='Monthly'>Monthly</option>
                            </select>";
                        }
                    ?>
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
include "templates/footer.php";

?>
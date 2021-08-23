<div id="expenses">
<?php
if (isset($_POST['addexpense'])) {

    // include the config file
        require "../config.php";
    
        try {
    
            $connection = new PDO($dsn, $username, $password, $options);
    
            $expenses = array(
                "expensename" => $_POST['expensename'],
                "expenseamount" => $_POST['expenseamount'],
                "expensefrequency" => $_POST['expensefrequency'],
            );
    
            $sql = "INSERT INTO expenses (
                expensename,
                expenseamount,
                expensefrequency
            ) VALUES (
                :expensename,
                :expenseamount,
                :expensefrequency
            )";
    
            $statement = $connection->prepare($sql);
            $statement->execute($expenses);
    
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
?>

<div class="container">
    <div class="col s12">
        <h3>Add an expense</h3>
        <?php if (isset($_POST['submit']) && $statement) {
            echo "<p>Expense successfully added.</p>";
        }?>
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" name="expensename" id="expensename" class="validate">
                    <label for="expensename">Expense name</label>
                </div>
            
                <div class="input-field col s4">
                    <input type="text" name="expenseamount" id="expenseamount" class="validate">
                    <label for="expenseamount">Expense amount (to the dollar)</label>
                </div>

                <div class="input-field col s4">
                    <input type="text" name="expensefrequency" id="expensefrequency" class="validate">
                    <label for="expensefrequency">Expense frequency</label>
                </div>
            
                <!-- <div class="input-field col s4">
                    <select name="incomefrequency" id="incomefrequency">
                        <option value="">Choose frequency</option>
                        <option value="weekly">Weekly</option>
                        <option value="fortnlightly">Fortnightly</option>
                        <option value="monthly">Monthly</option>
                    </select>    
                    <label for="incomefrequency">Income frequency</label>
                </div> -->
            </div>
            <div class="row">
            <input  class="btn waves-effect waves-light" type="submit" name="addexpense" value="Add expense">
            </div>
        </form>
    </div>
</div>

<?php
// include the config file that we created before
    require "../config.php";
// This code will only run if the delete button is clicked
if (isset($_GET["id"])) {
    // this is called a try/catch statement 
    try {
        // define database connection
        $connection = new PDO($dsn, $username, $password, $options);
        
        // set id variable
        $id = $_GET["id"];
        
        // Create the SQL 
        $sql = "DELETE FROM expenses WHERE id = :id";

        // Prepare the SQL
        $statement = $connection->prepare($sql);
        
        // bind the id to the PDO
        $statement->bindValue(':id', $id);
        
        // execute the statement
        $statement->execute();

        // Success message
        $success = "Expense successfully deleted";

    } catch(PDOException $error) {
        // if there is an error, tell us what it is
        echo $sql . "<br>" . $error->getMessage();
    }
};

// this is called a try/catch statement
    try {
// FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
// SECOND: Create the SQL
        $sql = "SELECT * FROM expenses";
// THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
// FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
// if there is an error, tell us what it is
        echo $sql . "<br>" . $error->getMessage();
    }
?>
<?php
//if there are some results
    if ($result && $statement->rowCount() > 0) {?>
<div class="container">
    <div class="col s12">
        <h5>Expenses</h5>
    </div>
    </div>

<div class="container">
    <div class="col s12">
    <table>
        <tr>
            <th style="display:none;">Expense ID</th>
            <th style="width: 20%;">Expense name</th>
            <th style="width: 20%;">Expense amount</th>
            <th style="width: 20%;">Expense frequency</th>
            <th style="width: 20%;">Actions</th>
            <th style="width: 20%;">Expense annually</th>
        </tr>
    </table>
    </div>
    </div>
    <?php
        // This is a loop, which will loop through each result in the array
            foreach ($result as $row) {
        ?>
 <div class="container">
    <div class="col s12">
        <table>
        <tr>
            <td style="display:none;"><?php echo $row['id']; ?></td>   
            <td style="width: 20%;"><?php echo $row['expensename']; ?></td>
            <td style="width: 20%;"><?php echo $row['expenseamount']; ?></td>
            <td style="width: 20%;"><?php echo $row['expensefrequency']; ?></td>
            <td style="width: 20%;">
                <a href='editincome.php?id=<?php echo $row['id']; ?>'>Edit</a> | 
                <a href='index.php?id=<?php echo $row['id']; ?>'>Delete</a>
            </td>
            <td style="width: 20%;">
                <?php 

                    if ($row['expensefrequency'] == 'Weekly') {
                        $annualexpenses = $row['expenseamount'] * 52; 
                        echo '$' . $annualexpenses;
                    }     

                    if ($row['expensefrequency'] == 'Fortnightly') {
                        $annualexpenses = $row['expenseamount'] * 26; 
                        echo '$' . $annualexpenses;
                    }

                    if ($row['expensefrequency'] == 'Monthly') {
                        $annualexpenses = $row['expenseamount'] * 12; 
                        echo '$' . $annualexpenses;
                    }
                ?>
            </td>
        </tr>
        </table>
    </div>
</div>

<?php }
        ; //close the foreach
    }
    ;
;
?>

<div class="container">
    <div class="col s12">
        <h5>Total expenses</h5>
        <p>How do I add up all the annual expenses?</p>
        <p><?php echo '$' . $annualexpenses . " per year"; ?></p>
    </div>
</div>

</div>
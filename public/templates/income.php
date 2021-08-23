<div  id="income">
    <?php
if (isset($_POST['addincome'])) {

    // include the config file
        require "../config.php";
    
        try {
    
            $connection = new PDO($dsn, $username, $password, $options);
    
            $income = array(
                "incomename" => $_POST['incomename'],
                "incomeamount" => $_POST['incomeamount'],
                "incomefrequency" => $_POST['incomefrequency'],
            );
    
            $sql = "INSERT INTO income (
                incomename,
                incomeamount,
                incomefrequency
            ) VALUES (
                :incomename,
                :incomeamount,
                :incomefrequency
            )";
    
            $statement = $connection->prepare($sql);
            $statement->execute($income);
    
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
?>

<div class="container">
    <div class="col s12">
        <h3>Add an income</h3>
        <?php if (isset($_POST['submit']) && $statement) {
            echo "<p>Income successfully added.</p>";
        }?>
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" name="incomename" id="incomename" class="validate">
                    <label for="incomename">Income name</label>
                </div>
            
                <div class="input-field col s4">
                    <input type="text" name="incomeamount" id="incomeamount" class="validate">
                    <label for="incomeamount">Income amount (to the dollar)</label>
                </div>

                <div class="input-field col s4">
                    <input type="text" name="incomefrequency" id="incomefrequency" class="validate">
                    <label for="incomefrequency">Income frequency</label>
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
            <input  class="btn waves-effect waves-light" type="submit" name="addincome" value="Add income">
            </div>
        </form>
    </div>
</div>

<?php
// include the config file that we created before
    require "../config.php";
    if (isset($_GET["id"])) {
        // this is called a try/catch statement 
        try {
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["id"];
            
            // Create the SQL 
            $sql = "DELETE FROM income WHERE id = :id";
    
            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();
    
            // Success message
            $success = "Income successfully deleted";
    
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
        $sql = "SELECT * FROM income";
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
        <h5>Incomes</h5>
    </div>
    </div>
    <div class="container">
    <div class="col s12">
    <table>
        <tr>
            <th style="display:none;">Income ID</th>
            <th style="width: 25%;">Income name</th>
            <th style="width: 25%;">Income amount</th>
            <th style="width: 25%;">Income frequency</th>
            <th style="width: 25%;">Actions</th>
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
            <td style="width: 25%;"><?php echo $row['incomename']; ?></td>
            <td style="width: 25%;"><?php echo $row['incomeamount']; ?></td>
            <td style="width: 25%;"><?php echo $row['incomefrequency']; ?></td>
            <td style="width: 25%;">
                <a href='editincome.php?id=<?php echo $row['id']; ?>'>Edit</a> | 
                <a onclick="return confirm('Are you sure you want to delete?')" href='index.php?id=<?php echo $row['id']; ?>'>Delete</a>
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
</div>
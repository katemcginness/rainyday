<div  id="income">
    <?php
    // session_start();

        $annualincome = 0;
        $totalincome = 0;
        $incomename_error = "";
        $incomeamount_error = "";
        $incomefrequency_error = "";

if (isset($_POST['addincome'])) {

    // include the config file
        require "../config.php";

        
           
            
                try {
            
                    $connection = new PDO($dsn, $username, $password, $options);
            
                    $income = array(
                        "userid" => $_SESSION['id'],
                        "incomename" => $_POST['incomename'],
                        "incomeamount" => $_POST['incomeamount'],
                        "incomefrequency" => $_POST['incomefrequency'],
                    );
            
                    $sql = "INSERT INTO income (
                        userid,
                        incomename,
                        incomeamount,
                        incomefrequency
                    ) VALUES (
                        :userid,
                        :incomename,
                        :incomeamount,
                        :incomefrequency
                    )";
            
                    $statement = $connection->prepare($sql);
                    

                    if (empty($_POST["incomename"])) {
                        $incomename_error = "Income name is required";
                    }
                    if (empty($_POST["incomeamount"])) {
                        $incomeamount_error = "Income amount is required";
                    }
                    if (empty($_POST["incomefrequency"])) {
                        $incomefrequency_error = "Income name is required";
                    }
                    
                    $statement->execute($income);
            
                } 
                catch (PDOException $error) {
                    // echo $sql . "<br>" . $error->getMessage();
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
                    <span class="helper-text error"><?php echo $incomename_error; ?></span>
                    
                </div>
            
                <div class="input-field col s4">
                    <input type="text" name="incomeamount" id="incomeamount" class="validate">
                    <label for="incomeamount">Income amount (to the dollar)</label>
                    <span class="helper-text error"><?php echo $incomeamount_error; ?>
                </div>

                <div class="input-field col s4">
                <select name="incomefrequency" id="incomefrequency">
                    <option value="Weekly">Weekly</option>
                    <option value="Fortnightly">Fortnightly</option>
                    <option value="Monthly">Monthly</option>
                </select>
                <span class="helper-text error"><?php echo $incomefrequency_error; ?>
                </div>
            
                
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
        $sql = "SELECT * FROM income WHERE userid=:uid";
        
// THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->bindValue(':uid', $_SESSION['id']);
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
            <th style="width: 20%;">Income name</th>
            <th style="width: 20%;">Income amount</th>
            <th style="width: 20%;">Income frequency</th>
            <th style="width: 20%;">Actions</th>
            <th style="width: 20%;">Income annually</th>
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
            <td style="width: 20%;"><?php echo $row['incomename']; ?></td>
            <td style="width: 20%;"><?php echo '$' . $row['incomeamount']; ?></td>
            <td style="width: 20%;"><?php echo $row['incomefrequency']; ?></td>
            <td style="width: 20%;">
                <a href='editincome.php?id=<?php echo $row['id']; ?>'>Edit</a> | 
                <a onclick="return confirm('Are you sure you want to delete?')" href='index.php?id=<?php echo $row['id']; ?>'>Delete</a>
            </td>
            <td style="width: 20%;">
                <?php 

                    if ($row['incomefrequency'] == 'Weekly') {
                        $annualincome = $row['incomeamount'] * 52; 
                        echo '$' . $annualincome;
                    }     

                    elseif ($row['incomefrequency'] == 'Fortnightly') {
                        $annualincome = $row['incomeamount'] * 26; 
                        echo '$' . $annualincome;
                    }

                    elseif ($row['incomefrequency'] == 'Monthly') {
                        $annualincome = $row['incomeamount'] * 12; 
                        echo '$' . $annualincome;
                    }
                    $totalincome += $annualincome;
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
        <h5>Total income</h5>
        <p><?php echo '$' . $totalincome . " per year"; ?></p>
    </div>
</div>

</div>
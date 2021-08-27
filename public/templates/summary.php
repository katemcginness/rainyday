<div id="summary">
    <div class="container">
        <div class="col s12">
            <h3>Summary</h3>
            <table>
                <tr>
                    <th style="width: 25%;">Frequency</th>    
                    <th style="width: 25%;">Income</th>
                    <th style="width: 25%;">Expenses</th>
                    <th style="width: 25%;">Remaining</th>
                </tr>
                <tr>
                    <td>
                        <?php
                            $weekly = 'Weekly';
                            echo $weekly;
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyincome = $totalincome / 52;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $totalexpenses / 52;
                            echo '$' . round($weeklyexpenses, 2);
                        ?>
                    </td>
                    <td>
                        <?php echo '$' . round($weeklyincome - $weeklyexpenses, 2);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                            $weekly = 'Fortnightly';
                            echo $weekly;
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyincome = $totalincome / 26;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $totalexpenses / 26;
                            echo '$' . round($weeklyexpenses, 2);
                        ?>
                    </td>
                    <td>
                        <?php echo '$' . round($weeklyincome - $weeklyexpenses, 2);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                            $weekly = 'Monthly';
                            echo $weekly;
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyincome = $totalincome / 12;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $totalexpenses / 12;
                            echo '$' . round($weeklyexpenses, 2);
                        ?>
                    </td>
                    <td>
                        <?php echo '$' . round($weeklyincome - $weeklyexpenses, 2);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                            $weekly = 'Annually';
                            echo $weekly;
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyincome = $totalincome;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $totalexpenses;
                            echo '$' . round($weeklyexpenses, 2);
                        ?>
                    </td>
                    <td>
                        <?php echo '$' . round($weeklyincome - $weeklyexpenses, 2);?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
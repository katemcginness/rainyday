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
                            $weeklyincome = $annualincome / 52;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $annualexpenses / 52;
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
                            $weeklyincome = $annualincome / 26;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $annualexpenses / 26;
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
                            $weeklyincome = $annualincome / 12;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $annualexpenses / 12;
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
                            $weeklyincome = $annualincome;
                            echo '$' . round($weeklyincome, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $weeklyexpenses = $annualexpenses;
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
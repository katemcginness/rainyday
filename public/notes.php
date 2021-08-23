<select name="incomefrequency" id="incomefrequency">
    <option value="Weekly" <?php if($incomefrequency == "Weekly") { echo "SELECTED"; } ?>>Weekly</option>
    <option value="Fortnightly" <?php if($incomefrequency == "Fortnightly") { echo "SELECTED"; } ?>>Fortnightly</option>
    <option value="Monthly" <?php if($incomefrequency == "Monthly") { echo "SELECTED"; } ?>>Monthly</option
  </select>



  <label for="incomefrequency">Income frequency</label>
                    <input type="text" name="incomefrequency" id="incomefrequency" class="validate" value="<?php echo escape($income['incomefrequency']); ?>">


<!-- <div class="input-field col s4">
                    <select name="incomefrequency" id="incomefrequency">
                        <option value="">Choose frequency</option>
                        <option value="weekly">Weekly</option>
                        <option value="fortnlightly">Fortnightly</option>
                        <option value="monthly">Monthly</option>
                    </select>    
                    <label for="incomefrequency">Income frequency</label>
                </div> -->


                <option value="Weekly" <?php if($incomefrequency == "Weekly") { echo "SELECTED"; } ?>>Weekly</option>
                    <option value="Fortnightly" <?php if($incomefrequency == "Fortnightly") { echo "SELECTED"; } ?>>Fortnightly</option>
                    <option value="Monthly" <?php if($incomefrequency == "Monthly") { echo "SELECTED"; } ?>>Monthly</option>



                    <div class="col s4">
                        <select name="incomefrequency" id="incomefrequency" class="validate">
                            <option value="Weekly">Weekly</option>
                            <option value="Fortnightly">Fortnightly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>
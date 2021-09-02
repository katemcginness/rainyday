<?php
include "templates/header.php";
include "templates/navnew.php";


    ?>

<div class="container">
    <div class="col s8">
        <h2>Rationale</h2>
            <p>Rainy day is a simple budget tool that allows users to input their household income and expenses and calculate their savings capacity. </p>
            <h3>Framework selection</h3>
            <p>Whilst researching popular frameworks such as bootstrap, I came across Materialize which was inspired by <a href="https://material.io/design">Google’s Material Design System</a>. It implements the various principles of Material design, including providing feedback to users through motion when clicking a button or selecting a tab in the menu.   </p>
            <h3>Initialising the components</h3>
            <p>Whilst Materialize uses mostly CSS for its components, some javascript is used to create the mobile navigation and the tab system which shows and hides content based on an ID assigned to a div. These components are initialised in simple javascript which is documented on the Materialize CSS website.</p>
            <img src="assets/images/jsexample.png" alt="example of javascript code to initialise materialize components">
    </div>
    <div class="row col s8">
        <hr>
        <a href="index.php" class="waves-effect waves-teal btn-flat">Return to application</a>
    </div>
</div>


<?php
include "templates/footer.php";
?>
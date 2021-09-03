<?php
include "templates/header.php";
include "templates/navnew.php";


    ?>

<div class="container">
    <div class="col s8">
        <h2>Rationale</h2>
            <p>Rainy day is a simple budget tool that allows users to input their household income and expenses and calculate their savings capacity. </p>
            <h3>Framework selection</h3>
            <p>Whilst researching popular frameworks such as bootstrap, I came across <a href="https://materializecss.com/">Materialize</a> which was inspired by Google’s <a href="https://material.io/design">Material Design System</a>. It implements the various principles of Material design, including providing feedback to users through motion when clicking a button or selecting a tab in the menu.   </p>
            <img src="assets\images\materialdesign.png" alt="screenshot of material design site">
            <h3>Initialising the components</h3>
            <p>Whilst Materialize uses mostly CSS for it’s components, some javascript is used to create the mobile navigation and the tab system which shows and hides content based on an ID assigned to a div. These components are initialised in simple javascript which is documented on the Materialize website.</p>
            <img src="assets/images/jsexample.png" alt="example of javascript code to initialise materialize components">
            <h3>Creating an account</h3>
            <p>The user can create an account using a simple user ID and password. These details are saved to the database and the password is stored using <code>password_hash</code> to protect the user’s privacy. </p>
            <img src="assets/images/creatingaccount.png" alt="">
            <h3>Linking users to their data</h3>
            <p>As financial data is sensitive, it was important that the user is only able to see the data associated with their user id. This is done by adding a <code>userid</code> column in the income and expenses tables and linking the user’s login credentials to that data. </p>
            <p>When loading the data into the application session, all data is selected <code>WHERE</code> the <code>userid</code> matches that of the user that is logged in.</p>
            <h3>Inputting data</h3>
            <p>The user can create data in two tables – income and expenses. Whilst the data structure is similar in both tables, separating the two allowed for calculations to be done that shows a summary of their income and expenses, and what is remaining that they can potentially save by using their budget.</p>
            <p>Creating data is done by using <code>INSERT</code> sql, which takes the data entered by the user and inserts into a row in the income or expenses table. </p>
            <h3>Edit</h3>
            <p>Editing the user’s income or expenses data is done by using the row id and attaching that to a URL.</p>
            <img src="assets/images/editurl.png" alt="">
            <p>The <code>UPDATE</code> statement is then used to take the new data entered by the user and update the row selected by the id.</p>
            <h3>Delete</h3>
            <p>The delete function works similarly to the edit function, where it uses the ID to select the row of data. The <code>DELETE</code> statement is then used to delete the income where the row matches the id selected.</p>
            <img src="assets/images/delete.png" alt="">
            <h3>User feedback</h3>
            <p>The number one <a href="https://www.nngroup.com/articles/ten-usability-heuristics/">usability heuristic published by Nielson Norman group</a> is to ensure an application has visibility of system status. I provided success messages when a record was successfully added, a prompt before deleting a record and a success message when a record has been updated.</p>
            <img src="assets/images/userfeedback.png" alt="">
            <h3>Calculations</h3>
            <p>To provide a positive user experience, the application calculates the user’s income and expenses per week, fortnight, month, and year and informs them on what is remaining. At the top of the page, two variables are created, <code>$annualincome/$annualexpenses</code> and <code>$totalincome/$totalexpenses.</code> </p>
            <p>An if statement then checks what frequency was selected for each entry and calculates how much that expense would cost annually. It then adds that amount to a total income/expense amount.</p>
            <img src="assets/images/calculations.png" alt="">
            <p>These variables are then used to calculate the users’ expenses per week, fortnight, month and year and display what is remaining. To ensure the data is displayed in a user-friendly format, it rounds the amount to the nearest two decimal points.</p>

            

    </div>
    <div class="row col s8">
        <hr>
        <a href="index.php" class="waves-effect waves-teal btn-flat">Return to application</a>
    </div>
</div>


<?php
include "templates/footer.php";
?>
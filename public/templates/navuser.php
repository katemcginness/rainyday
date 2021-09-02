


  <nav class="nav-extended">
    <div class="nav-wrapper">
      <img src="rainy.svg" alt="">
      <a href="#" class="brand-logo">rainyDay</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="rationale.php">Rationale</a></li>
          <li><a href="reset-password.php">Reset password</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a class="active" href="#income">Income</a></li>
        <li class="tab"><a href="#expenses">Expenses</a></li>
        <li class="tab"><a href="#summary">Summary</a></li>
       
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="reset-password.php">Reset password</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>

  <?php 
  
    include "templates/income.php";
    include "templates/expenses.php";
    include "templates/summary.php";

  ?>


 



<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/bus.jpg" class="navbar-brand-img h-120" style="border-radius: 50px 50px 50px 50px" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Gestion Bus</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 1){echo 'bg-gradient-primary active';}?>"  href="index.php?page=dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Tableau de Bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 2){echo 'bg-gradient-primary active';}?>" href="index.php?page=payments">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons opacity-10">credit_score</span>
            </div>
            <span class="nav-link-text ms-1">Versements Bus</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 3){echo 'bg-gradient-primary active';}?>" href="index.php?page=deposits">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons opacity-10">account_balance</span>
            </div>
            <span class="nav-link-text ms-1">Dépots Chèques</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 4){echo 'bg-gradient-primary active';}?>" href="index.php?page=costs">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons opacity-10">payments</span>
            </div>
            <span class="nav-link-text ms-1">Dépenses & Salaires</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 5){echo 'bg-gradient-primary active';}?>" href="index.php?page=workers">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">Employé</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 6){echo 'bg-gradient-primary active';}?>" href="index.php?page=cars">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons opacity-10">directions_bus</span>
            </div>
            <span class="nav-link-text ms-1">Bus</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 7){echo 'bg-gradient-primary active';}?>" href="index.php?page=users">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons opacity-10">person</span>
            </div>
            <span class="nav-link-text ms-1">Utilisateurs</span>
          </a>
        </li>

        
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Rapport</h6>
        </li>
       
        <li class="nav-item">
          <a class="nav-link text-white  <?php if($current== 8){echo 'bg-gradient-primary active';}?>" href="../pages/report.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">analytics</i>
            </div>
            <span class="nav-link-text ms-1">Statistiques</span>
          </a>
        </li>
       
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        
        <a class="btn bg-gradient-primary w-100" href="logout.php" type="button">Déconnexion</a>
      </div>
    </div>
  </aside>
<?php  

     $pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments"); 
     $depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs");
     $depot_query = $conn->query("SELECT SUM(amount) as depot FROM deposits"); 
     $car_query = $conn->query("SELECT SUM(price) as prices FROM cars"); 


     $pay = $pay_query ->fetch();
     $depense = $depense_query ->fetch();
     $depot =$depot_query ->fetch();
     $car =$car_query ->fetch();


     $cars_query = $conn->query("SELECT * FROM cars"); 

     $lastpay_query = $conn->query("SELECT * FROM payments ORDER BY idPay Limit 1"); 
     $lastdepense_query = $conn->query("SELECT * FROM costs ORDER BY idCost Limit 1");
     $lastdepot_query = $conn->query("SELECT * FROM deposits ORDER BY idDeposit Limit 1");
     
     $lastpay = $lastpay_query ->fetch();
     $lastdepense = $lastdepense_query ->fetch();
     $lastdepot =$lastdepot_query ->fetch();

     
                
  ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau de Bord </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Tableau de Bord   Aujourd'hui</h6>
        </nav>
       <?php include '../includes/navBar.php'; ?>'
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">credit_score</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">versements</p>
                <h4 class="mb-0"><?php echo str_replace(',','.', number_format($pay['vers'])); ?> F</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-dark text-sm font-weight-bolder"> Aujourd'hui</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Dépenses</p>
                <h4 class="mb-0"><?php echo str_replace(',','.', number_format($depense['dep'])); ?> F</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-primary text-sm font-weight-bolder">Aujourd'hui</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">directions_bus</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Montant Entrée</p>
                <h4 class="mb-0"><?php echo str_replace(',','.', number_format($pay['vers'] - $depense['dep'])); ?> F</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-info text-sm font-weight-bolder">Aujourd'hui</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 ">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">account_balance</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Dépots </p>
                <h4 class="mb-0"><?php echo str_replace(',','.', number_format($depot['depot'])); ?> F</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Aujourd'hui</p>
            </div>
          </div>
        </div>
       
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Versements</h6>
              <p class="text-sm "></p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> 7 jours derniers</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Dépenses</h6>
              <p class="text-sm "> </p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> 7 jours derniers</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Caisse</h6>
              <p class="text-sm "></p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1"></i>
                <p class="mb-0 text-sm">7 jours derniers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Statistiques des Bus</h6>
                  
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table table-striped align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxl font-weight-bolder ">Bus</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Caisse</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder  ps-2">P.A</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Achèvement</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php  
                
                        while($row = $cars_query->fetch()):

                        $id = $row['idCar'];
                        $plaque = $row["plaque"];


                        $p_query = $conn->query("SELECT SUM(amount) as inputs FROM payments WHERE bus = '$plaque' "); 
                        $d_query = $conn->query("SELECT SUM(priceCost) as outputs FROM costs WHERE car ='$plaque'");
                        $dsalary_query = $conn->query("SELECT SUM(co.priceCost) as salari FROM costs co, workers wo WHERE co.worker = wo.idWorker AND wo.car ='$plaque'");

                        $pa = $p_query ->fetch();
                        $de = $d_query ->fetch();
                        $dsalary = $dsalary_query ->fetch();

                    ?>

                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/bus.jpg" class="avatar avatar-xl me-3" alt="xd">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['plaque']; ?></h6>
                          </div>
                        </div>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"> <?php

                         echo str_replace(',','.',number_format($pa['inputs'] - $de['outputs'] - $dsalary['salari'])); ?>  
                         
                         
                         F</span>
                      </td>
                    
                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"> <?php echo str_replace(',','.',number_format($row['price'])); ?>  F</span>
                      </td>

                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xl font-weight-bold">
                              <?php



                                $hundre = ($pa['inputs'] - $de['outputs']  - $dsalary['salari']) *100;
                                $perc = $hundre / $row['price'];


                                  echo str_replace(',','.',number_format($perc,2));
                              ?>

                              %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-<?php echo number_format($perc,0); ?>" role="progressbar" aria-valuenow="<?php echo $perc; ?>" aria-valuemin="0.005" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                   

                    <?php endwhile; ?>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Derniers Activités</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">24%</span> this month
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-success text-gradient">notifications</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo str_replace(',','.',number_format($lastdepense['priceCost'])); ?> F, <?php echo  $lastdepense['nameCost']; ?></h6>
                    <p class="text-secondary font-weight-bold text-xl mt-1 mb-0"><?php echo  date('M d Y H:i ', strtotime($lastdepense['dateCost'])); ?></p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-danger text-gradient">payments</i>
                  </span>
                  <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo str_replace(',','.',number_format($lastpay['amount'])); ?> F, Versement</h6>
                    <p class="text-secondary font-weight-bold text-xl mt-1 mb-0"><?php echo  date('M d Y H:i ', strtotime($lastpay['datePay'])); ?></p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-icons text-info text-gradient">credit_card</i>
                  </span>
                  <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo str_replace(',','.',number_format($lastdepot['amount'])); ?> F, Dépot à la Banque</h6>
                    <p class="text-secondary font-weight-bold text-xl mt-1 mb-0"><?php echo  date('M d Y H:i ', strtotime($lastdepot['dateDeposit'])); ?></p>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include '../includes/footer.php'; ?>

    </div>
  </main>
  
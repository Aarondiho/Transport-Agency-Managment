<?php 

include '../connection/db_connect.php';  
include '../includes/session.php'; 


$current = 8;


$month = date('Y-m');
$month1 = date('Y-m',strtotime("-1 months"));
$month2 = date('Y-m',strtotime("-2 months"));
$month3 = date('Y-m',strtotime("-3 months"));
$month4 = date('Y-m',strtotime("-4 months"));
$month5 = date('Y-m',strtotime("-5 months"));
$month6 = date('Y-m',strtotime("-6 months"));


//month
$pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month%' "); 
$depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month%' ");
//1
$pay_query1 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month1%' "); 
$depense_query1 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month1%' ");
//2
$pay_query2 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month2%' "); 
$depense_query2 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month2%' ");
//3
$pay_query3 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month3%' "); 
$depense_query3 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month3%' ");
//4
$pay_query4 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month4%' "); 
$depense_query4 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month4%' ");
//5
$pay_query5 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month5%' "); 
$depense_query5 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month5%' ");
//6
$pay_query6 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$month6%' "); 
$depense_query6 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$month6%' ");

//0
$pay = $pay_query ->fetch();
$depense = $depense_query ->fetch();
//1
$pay1 = $pay_query1 ->fetch();
$depense1 = $depense_query1 ->fetch();
//2
$pay2 = $pay_query2 ->fetch();
$depense2 = $depense_query2 ->fetch();
//3
$pay3 = $pay_query3 ->fetch();
$depense3 = $depense_query3 ->fetch();
//4
$pay4 = $pay_query4 ->fetch();
$depense4 = $depense_query4 ->fetch();
//5
$pay5 = $pay_query5 ->fetch();
$depense5 = $depense_query5 ->fetch();
//6
$pay6 = $pay_query6 ->fetch();
$depense6 = $depense_query6 ->fetch();

$depenseArray = ($depense6['dep']? $depense6['dep'] :0).','.($depense5['dep']? $depense5['dep'] :0).','.($depense4['dep']? $depense4['dep'] :0).','.($depense3['dep']? $depense3['dep'] :0).','.($depense2['dep']? $depense2['dep'] :0).','.($depense1['dep']? $depense1['dep'] :0).','.($depense['dep']? $depense['dep'] :0);

$payArray = ($pay6['vers']? $pay6['vers'] : 0).','.($pay5['vers']? $pay5['vers'] : 0).','.($pay4['vers']? $pay4['vers'] : 0).','.($pay3['vers']? $pay['vers'] : 0).','.($pay2['vers']? $pay2['vers'] : 0).','.($pay1['vers']? $pay1['vers'] : 0).','.($pay['vers']? $pay['vers'] : 0);

$caisseArray = ($pay6['vers']? $pay6['vers'] : 0) -( $depense6['dep']? $depense6['dep'] :0).','.($pay5['vers']? $pay5['vers'] : 0) -( $depense5['dep']? $depense5['dep'] :0).','.($pay4['vers']? $pay4['vers'] : 0) -( $depense4['dep']? $depense4['dep'] :0).','.($pay3['vers']? $pay3['vers'] : 0) -( $depense3['dep']? $depense3['dep'] :0).','.($pay2['vers']? $pay2['vers'] : 0) -( $depense2['dep']? $depense2['dep'] :0).','.($pay1['vers']? $pay1['vers'] : 0) -( $depense1['dep']? $depense1['dep'] :0).','.($pay['vers']? $pay['vers'] : 0) -( $depense['dep']? $depense['dep'] :0);

$months = '"'.date('M').'"';
$months1 = '"'.date('M',strtotime("-1 months")).'"';
$months2 = '"'.date('M',strtotime("-2 months")).'"';
$months3 = '"'.date('M',strtotime("-3 months")).'"';
$months4 = '"'.date('M',strtotime("-4 months")).'"';
$months5 = '"'.date('M',strtotime("-5 months")).'"';
$months6 = '"'.date('M',strtotime("-6 months")).'"';

$mo = $months6.','.$months5.','.$months4.','.$months3.','.$months2.','.$months1.','.$months;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/bus.jpg">
  <title>
    Rapport
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <!-- data table -->
  <link href="../assets/css/DT_bootstrap.css" rel="stylesheet" media="screen">

   <!-- sweet alert -->
   <script src="../assets/js/plugins/sweetalert2.all.js"></script>

<!-- By default sweetalert2 doesn't support IE. To enable IE 11 support, include Promise polyfill -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="../assets/js/jquery-1.9.1.min.js"></script>

<!-- Daterange picker -->
<link rel="stylesheet" href="../assets/bootstrap-daterangepicker/daterangepicker.css">

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="../assets/moment/min/moment.min.js"></script>
  <script src="../assets/bootstrap-daterangepicker/daterangepicker.js"></script>


</head>

<body class="g-sidenav-show  bg-gray-200">


<?php  


$initialDate = isset($_GET["initialDate"])? $_GET["initialDate"] :'';
$finalDate =isset($_GET["finalDate"])? $_GET["finalDate"]:'';

if($initialDate == ''){

  $pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments"); 
  $depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs ");
  $depot_query = $conn->query("SELECT SUM(amount) as depot FROM deposits "); 
  $car_query = $conn->query("SELECT SUM(price) as prices,COUNT(*) as allCar FROM cars"); 
  
  
  }else if($initialDate == $finalDate){

    $pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$finalDate%'"); 
    $depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$finalDate%'");
    $depot_query = $conn->query("SELECT SUM(amount) as depot FROM deposits WHERE dateDeposit LIKE '%$finalDate%'"); 
    $car_query = $conn->query("SELECT SUM(price) as prices,COUNT(*) as allCar FROM cars"); 


    }else{

    $actualDate = new DateTime();
    $actualDate ->add(new DateInterval("P1D"));
    $actualDatePlusOne = $actualDate->format("Y-m-d");

    $finalDate2 = new DateTime($finalDate);
    $finalDate2 ->add(new DateInterval("P1D"));
    $finalDatePlusOne = $finalDate2->format("Y-m-d");


    $pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay BETWEEN '$initialDate' AND '$finalDatePlusOne'"); 
    $depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne'");
    $depot_query = $conn->query("SELECT SUM(amount) as depot FROM deposits WHERE dateDeposit BETWEEN '$initialDate' AND '$finalDatePlusOne'"); 
    $car_query = $conn->query("SELECT SUM(price) as prices, COUNT(idCar) as allCar FROM cars");  

    }   

    


     $pay = $pay_query ->fetch();
     $depense = $depense_query ->fetch();
     $depot =$depot_query ->fetch();
     $car =$car_query ->fetch();


     $cars_query = $conn->query("SELECT * FROM cars"); 


     
                
  ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-dark active font-weight-bolder" aria-current="page"><?php echo  date('d / m / Y',strtotime($initialDate)).' au '.date('d / m / Y',strtotime($finalDate));?> </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Rapport</h6>
        </nav>
       <?php include '../includes/navBar.php'; ?>'
      </div>
    </nav>
   
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
      
      <div class="row mb-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
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
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xxl font-weight-bolder ">Bus</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Versement</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Dépense</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Caisse</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder  ps-2">P.A</th>
                      <th class="text-center text-uppercase text-primary text-xxl font-weight-bolder ">Achèvement</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php  

                      $totVers = 0;
                      $totDep = 0;
                      $totCaisse = 0;
                      $achat = 0;
                      $i = 0;
                
                        while($row = $cars_query->fetch()):

                          $i += 1;

                        $id = $row['idCar'];
                        $plaque = $row["plaque"];

                        if($initialDate == ''){

                        $p_query = $conn->query("SELECT SUM(amount) as inputs FROM payments WHERE bus = '$plaque'"); 
                        $d_query = $conn->query("SELECT SUM(priceCost) as outputs FROM costs WHERE car ='$plaque'");
                        $dother_query = $conn->query("SELECT SUM(priceCost) as other FROM costs  WHERE worker = 0 AND car ='0'"); 
                        $dsalary_query = $conn->query("SELECT SUM(co.priceCost) as salari FROM costs co, workers wo WHERE co.worker = wo.idWorker AND wo.car ='$plaque'");
                        $allcost_query = $conn->query("SELECT SUM(priceCost) as allCost FROM costs");
                     


                        }else if($initialDate == $finalDate){

                        $p_query = $conn->query("SELECT SUM(amount) as inputs FROM payments WHERE bus = '$plaque'   AND datePay LIKE '%$finalDate%'"); 
                        $d_query = $conn->query("SELECT SUM(priceCost) as outputs FROM costs WHERE car ='$plaque'  AND dateCost LIKE '%$finalDate%'");
                        $dother_query = $conn->query("SELECT SUM(priceCost) as other FROM costs  WHERE worker = 0 AND car ='0' AND dateCost LIKE '%$finalDate%'"); 
                        $dsalary_query = $conn->query("SELECT SUM(co.priceCost) as salari FROM costs co, workers wo WHERE co.worker = wo.idWorker AND wo.car ='$plaque' AND co.dateCost LIKE '%$finalDate%'");
                        $allcost_query = $conn->query("SELECT SUM(priceCost) as allCost FROM costs  WHERE dateCost  LIKE '%$finalDate%'");
                     

                      }else{

                        $actualDate = new DateTime();
                        $actualDate ->add(new DateInterval("P1D"));
                        $actualDatePlusOne = $actualDate->format("Y-m-d");
                        
                        $finalDate2 = new DateTime($finalDate);
                        $finalDate2 ->add(new DateInterval("P1D"));
                        $finalDatePlusOne = $finalDate2->format("Y-m-d");

                        $p_query = $conn->query("SELECT SUM(amount) as inputs FROM payments WHERE bus = '$plaque'   AND datePay BETWEEN '$initialDate' AND '$finalDatePlusOne'"); 
                        $d_query = $conn->query("SELECT SUM(priceCost) as outputs FROM costs WHERE car ='$plaque'  AND dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne'");
                        $dother_query = $conn->query("SELECT SUM(priceCost) as other FROM costs  WHERE worker = 0 AND car ='0' AND dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne'"); 
                        $dsalary_query = $conn->query("SELECT SUM(co.priceCost) as salari FROM costs co, workers wo WHERE co.worker = wo.idWorker AND wo.car ='$plaque' AND co.dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne'");
                        $allcost_query = $conn->query("SELECT SUM(priceCost) as allCost FROM costs  WHERE dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne'");
                      }       

                        $pa = $p_query ->fetch();
                        $de = $d_query ->fetch();
                        $dsalary = $dsalary_query ->fetch();
                        $dother = $dother_query ->fetch();
                        $allCost = $allcost_query ->fetch();

                        $otherCosts =  $dother['other'] / $car['allCar'];

                        $totVers += $pa['inputs'];
                        $totDep =  $allCost['allCost'];
                        $achat += 0;

                    ?>

                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          <h6 class=" w-10 text-xl font-weight-bold mb-0"><?php echo $i ; ?>  <img src="../assets/img/bus.jpg" class="avatar avatar-xl me-3" alt="xd">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['plaque']; ?></h6>
                          </div>
                        </div>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"> <?php echo str_replace(',','.',number_format($pa['inputs']?$pa['inputs']:0)); ?> F</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"><?php  echo str_replace(',','.',number_format( (($de['outputs']?$de['outputs']:0) + ($dsalary['salari']?$dsalary['salari']:0) + ($otherCosts?$otherCosts:0)),0)); ?>   F</span>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"> <?php echo str_replace(',','.',number_format(($pa['inputs']?$pa['inputs']:0) - ($de['outputs']?$de['outputs']:0) - ($dsalary['salari']?$dsalary['salari']:0) - ($otherCosts?$otherCosts:0) ,0)); ?>   F</span>
                      </td>
                    
                      <td class="align-middle text-center text-sm">
                        <span class="text-xl font-weight-bold"> <?php echo str_replace(',','.',number_format($row['price']?$row['price']:0)); ?>  F</span>
                      </td>

                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xl font-weight-bold">
                              <?php



                                $hundre = (($pa['inputs']?$pa['inputs']:0) - (($de['outputs']?$de['outputs']:0) + ($dsalary['salari']?$dsalary['salari']:0) + ($otherCosts?$otherCosts:0))) *100;
                                $perc = $hundre / ($row['price']?$row['price']:1);


                                  echo str_replace(',','.',number_format($perc,2));
                              ?>

                              %</span>
                            </div>
                          </div>
                          <div class="progress">
                          <div class="progress-bar bg-gradient-info w-<?php 

                              $percent = number_format($perc,0);

                              $per = substr_replace($percent, '0', -1);


                              echo $per; ?>" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="1" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                   

                    <?php endwhile; ?>

                    <tr>

                      <td class="align-middle text-center text-sm"> <h6 class="mb-0 text-sm">Total</h6></td>
                      <td class="align-middle text-center text-sm"> <h6 class="mb-0 text-sm"><?php echo str_replace(',','.',number_format($totVers));?> F</h6></td>
                      <td class="align-middle text-center text-sm"> <h6 class="mb-0 text-sm"><?php echo str_replace(',','.',number_format(($totDep?$totDep:0)));?> F</h6></td>
                      <td class="align-middle text-center text-sm"> <h6 class="mb-0 text-sm"><?php echo str_replace(',','.',number_format($totVers - $totDep ));?> F</h6></td>
                      <td class="align-middle text-center text-sm"> <h6 class="mb-0 text-sm"><?php echo str_replace(',','.',number_format($car['prices']?$car['prices']:0));?> F</h6></td>
                      <td class="align-middle text-center text-sm">

                      <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xl font-weight-bold">
                              <?php



                                $hundres = ($totVers - $totDep) *100;
                                $perce = $hundres / ($car['prices']?$car['prices']:1);


                                  echo str_replace(',','.',number_format($perce,2));
                              ?>

                              %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-<?php 

                                      $percent = number_format($perce,0);

                                      $per = substr_replace($percent, '0', -1);
                            
                            
                            echo $per; ?>" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="1" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>

                    </tr>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <?php include '../includes/footer.php'; ?>

    </div>
  </main>


 

 

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/DT_bootstrap.js"></script>
  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>

    print();

$(document).ready(function () {
    $('#example').DataTable();
    });
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [<?php echo $mo; ?>],
        datasets: [{
          label: "Versements",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: [<?php echo $payArray; ?>],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: [<?php echo $mo; ?>],
        datasets: [{
          label: "Dépense",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [<?php echo $depenseArray; ?>],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: [<?php echo $mo; ?>],
        datasets: [{
          label: "Caisse",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [<?php echo $caisseArray; ?>],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    
    function start_load(){

    $(document).ajaxSend(function() {
        $('.spinner').prepend('<img id="loaderIcon" src="../assets/img/preloader.gif" alt="..."/>');
        $("#overlay").fadeIn(300);　
    });

    }

  </script>

<script>

 
    
if(localStorage.getItem("captureRange2") != null){

$("#daterange-btn2 span").html(localStorage.getItem("captureRange2"));


}else{

$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Choisir Date')

}

/*=============================================
DATES RANGE
=============================================*/

$('#daterange-btn2').daterangepicker(
{
  ranges   : {
    'Aujourd`hui'       : [moment(), moment()],
    'Hier'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Dernier 7 jours ' : [moment().subtract(6, 'days'), moment()],
    'Dernier 30 jours': [moment().subtract(29, 'days'), moment()],
    'Ce Mois en Cours'  : [moment().startOf('month'), moment().endOf('month')],
    'Le Mois passé'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  },
  startDate: moment(),
  endDate  : moment()
},
function (start, end) {
  $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

  var initialDate = start.format('YYYY-MM-DD');

  var finalDate = end.format('YYYY-MM-DD');

  var captureRange = $("#daterange-btn2 span").html();
 
   localStorage.setItem("captureRange2", captureRange);

   window.location = "report.php?initialDate="+initialDate+"&finalDate="+finalDate;

}

)

/*=============================================
CANCEL DATES RANGE
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

localStorage.removeItem("captureRange2");
localStorage.clear();
window.location = "report.php";
})

/*=============================================
CAPTURE TODAY'S BUTTON
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(){

var todayButton = $(this).attr("data-range-key");

if(todayButton == "Aujourd`hui"){

  var d = new Date();
  
  var day = d.getDate();
  var month= d.getMonth()+1;
  var year = d.getFullYear();

  if(month < 10){

    var initialDate = year+"-0"+month+"-"+day;
    var finalDate = year+"-0"+month+"-"+day;

  }else if(day < 10){

    var initialDate = year+"-"+month+"-0"+day;
    var finalDate = year+"-"+month+"-0"+day;

  }else if(month < 10 && day < 10){

    var initialDate = year+"-0"+month+"-0"+day;
    var finalDate = year+"-0"+month+"-0"+day;

  }else{

    var initialDate = year+"-"+month+"-"+day;
      var finalDate = year+"-"+month+"-"+day;

  }	

    localStorage.setItem("captureRange2", "Aujourd`hui");

    window.location = "report.php?initialDate="+initialDate+"&finalDate="+finalDate;

}

})



</script>
 
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
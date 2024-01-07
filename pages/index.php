<?php 

include '../connection/db_connect.php';  
include '../includes/session.php';  

$pages = isset($_GET['page']) ?$_GET['page'] : "dashboard";;

if($pages =='dashboard'){

    $current=1;

}else if($pages =='payments' || $pages =='paymentAdd'){

  $current= 2;

}else if($pages =='deposits' || $pages =='depositAdd'){

    $current= 3;

}else if($pages =='costs' || $pages =='costAdd'){

    $current= 4;


}else if($pages =='workers' || $pages =='workerAdd'){

    $current= 5;

}else if($pages =='cars' || $pages =='carAdd'){

    $current= 6;

}else if($pages =='users' || $pages =='userAdd'){

    $current= 7;

}else if($pages =='report'){

    $current= 8;

}


$today = date('Y-m-d');
$today1 = date('Y-m-d',strtotime("-1 days"));
$today2 = date('Y-m-d',strtotime("-2 days"));
$today3 = date('Y-m-d',strtotime("-3 days"));
$today4 = date('Y-m-d',strtotime("-4 days"));
$today5 = date('Y-m-d',strtotime("-5 days"));
$today6 = date('Y-m-d',strtotime("-6 days"));


//today
$pay_query = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today%' "); 
$depense_query = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today%' ");
//1
$pay_query1 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today1%' "); 
$depense_query1 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today1%' ");
//2
$pay_query2 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today2%' "); 
$depense_query2 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today2%' ");
//3
$pay_query3 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today3%' "); 
$depense_query3 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today3%' ");
//4
$pay_query4 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today4%' "); 
$depense_query4 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today4%' ");
//5
$pay_query5 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today5%' "); 
$depense_query5 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today5%' ");
//6
$pay_query6 = $conn->query("SELECT SUM(amount) as vers FROM payments WHERE datePay LIKE '%$today6%' "); 
$depense_query6 = $conn->query("SELECT SUM(priceCost) as dep FROM costs WHERE dateCost LIKE '%$today6%' ");

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

$days = '"'.date('D').'"';
$days1 = '"'.date('D',strtotime("-1 days")).'"';
$days2 = '"'.date('D',strtotime("-2 days")).'"';
$days3 = '"'.date('D',strtotime("-3 days")).'"';
$days4 = '"'.date('D',strtotime("-4 days")).'"';
$days5 = '"'.date('D',strtotime("-5 days")).'"';
$days6 = '"'.date('D',strtotime("-6 days")).'"';



$da = $days6.','.$days5.','.$days4.','.$days3.','.$days2.','.$days1.','.$days;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/bus.jpg">
  <title>
    Bus
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
 
     include '../includes/sideBar.php' ;

    $page = isset($_GET['page']) ?$_GET['page'] : "dashboard";
    include $page.'.php';

?>

 
 <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
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

$(document).ready(function () {
    $('#example').DataTable();
    });
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [<?php echo $da; ?>],
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
        labels: [<?php echo $da; ?>],
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
        labels: [<?php echo $da; ?>],
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
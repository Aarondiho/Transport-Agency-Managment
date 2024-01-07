<?php  


include '../connection/db_connect.php'; 


    $initialDate = isset($_GET["initialDate"])? $_GET["initialDate"] : date('Y-m-01');
    $finalDate =isset($_GET["finalDate"])? $_GET["finalDate"]:date('Y-m-d');

    if($initialDate == $finalDate){

      $pay_query = $conn->query("SELECT * FROM payments WHERE datePay LIKE '%$finalDate%' ORDER BY idPay DESC"); 

    }else{

      $actualDate = new DateTime();
      $actualDate ->add(new DateInterval("P1D"));
      $actualDatePlusOne = $actualDate->format("Y-m-d");
  
      $finalDate2 = new DateTime($finalDate);
      $finalDate2 ->add(new DateInterval("P1D"));
      $finalDatePlusOne = $finalDate2->format("Y-m-d");


     $pay_query = $conn->query("SELECT * FROM payments WHERE datePay BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idPay DESC"); 

    }       
    
    


  ?>
  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/bus.jpg">
  <title>
    Listes des Versements
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


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card card-body mx-4 mx-md-4 ">
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-dark active font-weight-bolder" aria-current="page"><?php echo  date('d / m / Y',strtotime($initialDate)).' au '.date('d / m / Y',strtotime($finalDate));?> </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Versements</h6>
        </nav>
            
            <div class="card-body px-0 pb-2">
              <div class=" p-0">
              <table id="example" class="table table-striped align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xl font-weight-bold ">Récus</th>
                      <th class="text-uppercase text-xl font-weight-bolder  ps-2">montant</th>
                      <th class="text-uppercase text-xl font-weight-bolder  ps-2">Bus</th>
                      <th class="text-uppercase text-xl font-weight-bolder  ps-2">Fait Par</th>
                      <th class="text-center text-uppercase text-xl font-weight-bolder ">Date</th>
                    </tr>
                  </thead>
                  <tbody>

                 
                    
                    <?php  

                    
                              $i = 0;
                              $total = 0;

                              while($row = $pay_query->fetch()):

                                $id = $row['idPay'];

                                $i += 1;
                                $total += $row['amount'];
                
                       
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                        <a class="d-block shadow-xl border-radius-xl" href="../photos/<?php  echo $row['cheque']; ?>" target="_blank">
                        <?php echo $i ; ?>  <img src="../photos/<?php echo $row['cheque']; ?>" class="avatar avatar-xs me-3 border-radius-lg" alt="cost1">
                          </a>
                          
                        </div>
                      </td>

                      

                      <td>
                      <h6 class="text-xs font-weight-bold mb-0"><?php echo str_replace(',','.',number_format($row['amount'])); ?> F</h6>
                      </td>

                      <td>
                        <h6 class="text-xs font-weight-bold mb-0"><?php echo nl2br(htmlspecialchars($row['bus'])); ?></h6>
                      </td>

                      <td>
                        <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">
                            <?php 
                              

                                      $user_query = $conn->query("SELECT * FROM users  WHERE idUser=".$row['user']);
                                    $rows = $user_query ->fetch();

                                    echo $rows['firstName'].' '.$rows['lastName']; 

                                    
                            ; ?></h6>
                          </div>
                        </td>

                      <td>
                        <h6 class="text-xs font-weight-bold mb-0 text-center"><?php echo date('d-m-Y', strtotime($row['datePay'])); ?></h6>
                      </td>

                     
                    </tr>

                    <?php endwhile; ?>

                    <tr>
                      
                      <td  class="text-center">
                        <h6 class=" w-10 text-xl text-center font-weight-bold mb-0"></h6>
                      </td>
                      <td>
                        <h6 class="text-xl font-weight-bold mb-0">Total : <?php echo str_replace(',','.',number_format($total)); ?>  F</h6>
                      </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
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

</body>
<script>

 
 print();

</script>
</html>

 
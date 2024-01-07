
<?php  



$initialDate = isset($_GET["initialDate"])? $_GET["initialDate"] : date('Y-m-01');
$finalDate =isset($_GET["finalDate"])? $_GET["finalDate"]:date('Y-m-d');

if($initialDate == $finalDate){

  $cost_query = $conn->query("SELECT * FROM costs WHERE dateCost LIKE '%$finalDate%' ORDER BY idCost DESC"); 

}else{

  $actualDate = new DateTime();
  $actualDate ->add(new DateInterval("P1D"));
  $actualDatePlusOne = $actualDate->format("Y-m-d");

  $finalDate2 = new DateTime($finalDate);
  $finalDate2 ->add(new DateInterval("P1D"));
  $finalDatePlusOne = $finalDate2->format("Y-m-d");


 $cost_query = $conn->query("SELECT * FROM costs WHERE dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idCost DESC"); 

}       




?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dépenses</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Listes des Dépenses</h6>
        </nav>
        
        <?php include '../includes/navBar.php'; ?>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
        <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-8">

                        
                           <button type="button" class="btn btn-default" id="daterange-btn2">
                          
                          <span class="text-info">
                            <i class="fa fa-calendar"></i> Choisir Date
                          </span>

                          <i class="fa fa-caret-down"></i>

                        </button>

                          <div class="box-tools pull-right ml-2">

                              <a class="btn bg-gradient-dark mb-0" href="index.php?page=costAdd"><i class="material-icons text-xl">add_circle</i>&nbsp;&nbsp;Dépense</a>
                        
                              
                         </div>

                      </div>
                    <div class="col-4 text-end">
                      <a href="costPDF.php?initialDate=<?php echo $initialDate;?>&finalDate=<?php echo $finalDate;?>">
                            <button  class="btn btn-success" style="margin-top:5px">PDF</button>
                      </a>
                      <a href="excel.php?page=cost&initialDate=<?php echo $initialDate;?>&finalDate=<?php echo $finalDate;?>">
                          <button class="btn btn-danger" style="margin-top:5px">Excel</button>
                      </a>
                    </div>
                </div>
            </div>
            <br> 
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
          </div>
          <div class="card card-body mx-2  mt-n10">
            
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="example" class="table table-striped align-items-center  mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">Dépense</th>
                      <th class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7 ps-2">cout</th>
                      <th class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">Date</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php  

                        $i = 0;
                        $total = 0;

                        while($row = $cost_query->fetch()):

                        $i += 1;
                        $id = $row['idCost'];

                        $total += $row['priceCost'];
                    ?>
                    <tr>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          <h6 class=" w-10 text-xl font-weight-bold mb-0"><?php echo $i ; ?></h6> <img src="../photos/<?php  if(!empty($row['bill'])){echo $row['bill'];}else{ echo 'bill.png';}; ?>" class="avatar avatar-xm me-3 border-radius-lg" alt="cost1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['nameCost']; ?></h6>
                            <p class="text-xl text-black font-weight-bold mb-0"><?php 
                            
                            if($row['nameCost'] =='Salaire'){

                                    $worker_query = $conn->query("SELECT * FROM workers  WHERE idWorker=".$row['worker']);
                                    $rows = $worker_query ->fetch();

                                    echo $rows['firstName'].' '.$rows['lastName']; 

                                    
                            }else  if($row['nameCost'] =='Garage'){

                              echo $row['car'] ;
                            } ; ?>
                           </p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xl font-weight-bold mb-0"><?php echo str_replace(',','.',number_format($row['priceCost'])); ?> F</p>
                      </td>

                      <td>
                        <h6 class="text-xl font-weight-bold mb-0 text-center"><?php echo date('d/m/Y', strtotime($row['dateCost'])); ?> </h6>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <a href="index.php?page=costAdd&id=<?php echo $id ; ?>" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit sport">
                        <span class="badge badge-xl bg-gradient-primary">
                        <i class="fas fa-edit  text-sm opacity-10"></i>
                        </span>
                        </a>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                         <a href="index.php?page=costs&supp=<?php echo $id; ?>" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit club">
                            <span class="badge badge-xl bg-gradient-danger">
                                <i class="fas fa-trash  text-sm opacity-10"></i>
                            </span>
                        </a>
                        
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

  <?php

if(isset($_GET["supp"])){
  $idtodelete=$_GET["supp"];
  $delete=$conn->EXEC("DELETE FROM costs WHERE idCost = $idtodelete");
  if($delete){
    ?>
    <script>
            swal({
                        type: "success",
                        title: "supprimé avec succés",
                        showConfirmButton: true,
                        confirmButtonText: "Fermer"
                    
                        }).then(() => {
                        
                            window.location = "index.php?page=costs";
                            
                        })
                      
          
    </script>
<?php
}
}
?>

<?php
if(isset($_GET['idInit'])){
  $id = $_GET['idInit'];
  $password = 12345;
  $crypt_pass = md5($password);
  
  $stmt = $conn->prepare("UPDATE costs SET password =? WHERE idCost=?");
  $save = $stmt->execute([$crypt_pass,$id]);
      

  if($save){

?>


          <script>
              swal({
                                    type: "success",
                                    title: "Réinitialisé avec succés",
                                    showConfirmButton: true,
                                    confirmButtonText: "Fermer"
                        
                                    }).then(() => {
                                    

                                        window.location = "index.php?page=costs";

                                        
                                    })
                      
          </script>
<?php  }
}?>


 
<?php

if(isset($_GET['idActive'])){
$status = $_GET['status'];
$id = $_GET['idActive'];

  if($status == 0 ){
    $stat= 1;

  }else{

  $stat = 0;
    
  }

  $save = $conn->EXEC("UPDATE costs SET status ='$stat' WHERE idCost='$id'");

  if($save){
    
    ?>
<script>
    
  
    swal({
                                    type: "success",
                                    title: "Désactivé avec succés",
                                    showConfirmButton: true,
                                    confirmButtonText: "Fermer"
                        
                                    }).then(() => {
                                    

                                        window.location = "index.php?page=costs";

                                        
                                    })

</script>

<?php  
  } 
}
?>


<script>

 
    
if(localStorage.getItem("captureRange2") != null){

$("#daterange-btn2 span").html(localStorage.getItem("captureRange2"));
localStorage.removeItem("captureRange2");


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
  $('#daterange-btn2 span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));

  var initialDate = start.format('YYYY-MM-DD');

  var finalDate = end.format('YYYY-MM-DD');

  var captureRange = $("#daterange-btn2 span").html();
 
   localStorage.setItem("captureRange2", captureRange);

   window.location = "index.php?page=costs&initialDate="+initialDate+"&finalDate="+finalDate;

}

)

/*=============================================
CANCEL DATES RANGE
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

localStorage.removeItem("captureRange2");
localStorage.clear();
window.location = "index.php?page=payments";
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

    window.location = "index.php?page=costs&initialDate="+initialDate+"&finalDate="+finalDate;

}

})



</script>

 


 
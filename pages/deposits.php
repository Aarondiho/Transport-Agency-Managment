<?php  



    $initialDate = isset($_GET["initialDate"])? $_GET["initialDate"] : date('Y-m-01');
    $finalDate =isset($_GET["finalDate"])? $_GET["finalDate"]:date('Y-m-d');

    if($initialDate == $finalDate){

      $depot_query = $conn->query("SELECT * FROM deposits WHERE dateDeposit LIKE '%$finalDate%' ORDER BY idDeposit DESC"); 

    }else{

      $actualDate = new DateTime();
      $actualDate ->add(new DateInterval("P1D"));
      $actualDatePlusOne = $actualDate->format("Y-m-d");
  
      $finalDate2 = new DateTime($finalDate);
      $finalDate2 ->add(new DateInterval("P1D"));
      $finalDatePlusOne = $finalDate2->format("Y-m-d");


     $depot_query = $conn->query("SELECT * FROM deposits WHERE dateDeposit BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idDeposit DESC"); 

    }       
    
    


  ?>
<div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dépots</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dépots</h6>
        </nav>
        <?php include '../includes/navBar.php'; ?>
      
      <!-- End Navbar -->
        
        <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-8">

                          <button type="button" class="btn btn-default" id="daterange-btn2">
                          
                          <span class="text-info">
                            <i class="fa fa-calendar"></i> Choisir Date
                          </span>

                          <i class="fa fa-caret-down"></i>

                        </button>
                   
                          <div class="box-tools pull-right">

                          <a class="btn bg-gradient-dark mb-0" href="index.php?page=depositAdd">
                              <i class="material-icons text-xl">add_circle</i>&nbsp;&nbsp;Dépot
                          </a>
                          

                              
                         </div>

                      </div>
                    <div class="col-4 text-end">
                      <a href="depositPDF.php?initialDate=<?php echo $initialDate;?>&finalDate=<?php echo $finalDate;?>">
                            <button  class="btn btn-success" style="margin-top:5px">PDF</button>
                      </a>
                      <a href="excel.php?page=deposit&initialDate=<?php echo $initialDate;?>&finalDate=<?php echo $finalDate;?>">
                          <button class="btn btn-danger" style="margin-top:5px">Excel</button>
                      </a>
                    </div>
                </div>
            </div>
            <br> 

    
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n9">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                Dépots
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                Faites
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
           
          </div>
        </div>
        <div class="row">
          <div class="row">
            
            <div class="col-12 mt-4">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Listes des Chéques</h6>
              </div>
              <div class="row">

              <?php  
                   $i = 0;

                  
                while($row = $depot_query->fetch()):

                  $id = $row['idDeposit'];

                     $i += 1;
            ?>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 ">
                  <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                      <a class="d-block shadow-xl border-radius-xl" href="../photos/<?php  echo $row['cheque']; ?>" target="_blank">
                      <h6 class=" w-10 text-xl font-weight-bold mb-0"><?php echo $i ; ?></h6><img src="../photos/<?php  echo $row['cheque']; ?>" style="height:150px" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body p-3">
                      <p class="mb-0 text-sm font-weight-bold "><?php echo date('d M Y', strtotime($row['dateDeposit'])); ?></p>
                      <a href="javascript:;">
                        <h5>
                        <?php echo str_replace(',','.',number_format($row['amount'])); ?> F
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                      <?php if(!empty($row['content'])){ echo nl2br(htmlspecialchars($row['content']));}else{ echo 'Pas des Commentaires';} ?>
                      </p>
                      <div >
                        <a href="index.php?page=depositAdd&id=<?php echo $id ; ?>" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit sport">
                        <span class="badge badge-xl bg-gradient-success">
                        <i class="fas fa-edit  text-sm opacity-10"></i>
                        </span>
                        </a>

                        <a href="index.php?page=deposits&supp=<?php echo $id; ?>" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="text-secondary font-weight-bold text-xl ml-5" data-toggle="tooltip" data-original-title="Edit club">
                            <span class="badge badge-xl bg-gradient-danger">
                                <i class="fas fa-trash  text-sm opacity-10"></i>
                            </span>
                        </a>
                       
                      </div>
                    </div>
                  </div>
                </div>

                <?php  
                
                endwhile;
            ?>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include '../includes/footer.php'; ?>
  </div>

  <?php

if(isset($_GET["supp"])){
  $idtodelete=$_GET["supp"];
  $delete=$conn->EXEC("DELETE FROM deposits WHERE idDeposit = $idtodelete");
  if($delete){
    ?>
    <script>
            swal({
                        type: "success",
                        title: "Supprimé avec succés",
                        showConfirmButton: true,
                        confirmButtonText: "Fermer"
                    
                        }).then(() => {
                        
                            window.location = "index.php?page=deposits";
                            
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

   window.location = "index.php?page=deposits&initialDate="+initialDate+"&finalDate="+finalDate;

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

    window.location = "index.php?page=deposits&initialDate="+initialDate+"&finalDate="+finalDate;

}

})



</script>

 
  

</body>

</html>
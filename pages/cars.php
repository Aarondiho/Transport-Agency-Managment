<?php  

     $car_query = $conn->query("SELECT * FROM cars ORDER BY idCar DESC"); 
                
?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bus</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Listes des Bus</h6>
        </nav>
   <?php 

   include '../includes/navBar.php';

   ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0"></h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn bg-gradient-dark mb-0" href="index.php?page=carAdd"><i class="material-icons text-xl">add_circle</i>&nbsp;&nbsp;Bus</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
          </div>
          <div class="card card-body mx-2 mx-md-1 mt-n10">
            
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="example" class="table table-striped align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plaque</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prix</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php  
                
                        while($row = $car_query->fetch()):

                        $id = $row['idCar'];
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/bus.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="car1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['plaque']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <h6 class="mb-0 text-sm"><?php echo str_replace(',','.',number_format($row['price'])); ?></h6>
                        
                      </td>
                     
                      <td class="align-middle text-center text-sm">
                        <a href="index.php?page=cars&idActive=<?php echo $id; ?>&status=<?php echo $row['status']; ?>" 
                        onclick="return confirm('Voulez-vous vraiment modifier?')" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit car">
                        <span class="badge badge-sm <?php if($row['status']==1){ echo 'bg-gradient-danger'; }else{ echo 'bg-gradient-secondary'; }; ?> ">
                            <?php if($row['status']==1){ echo 'Desactiver'; }else{ echo 'Activer'; }; ?>
                        </a>
                        
                      </td>

                      <td class="align-middle text-center text-sm">
                        <a href="index.php?page=carAdd&id=<?php echo $id ; ?>" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit sport">
                        <span class="badge badge-xl bg-gradient-primary">
                        <i class="fas fa-edit  text-sm opacity-10"></i>
                        </span>
                        </a>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                         <a href="index.php?page=cars&supp=<?php echo $id; ?>" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="Edit club">
                            <span class="badge badge-xl bg-gradient-danger">
                                <i class="fas fa-trash  text-sm opacity-10"></i>
                            </span>
                        </a>
                        
                      </td>
                    </tr>

                    <?php endwhile; ?>
                  
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
  $delete=$conn->EXEC("DELETE FROM cars WHERE idCar = $idtodelete");
  if($delete){
    ?>
    <script>
            swal({
                        type: "success",
                        title: "supprimé avec succés",
                        showConfirmButton: true,
                        confirmButtonText: "Fermer"
                    
                        }).then(() => {
                        
                            window.location = "index.php?page=cars";
                            
                        })
                      
          
    </script>
<?php
}
}
?>


<?php

if(isset($_GET['idActive'])){
$status = $_GET['status'];
$id = $_GET['idActive'];

  if($status == 0 ){
    $stat= 1;

  }else{

  $stat = 0;
    
  }

  $save = $conn->EXEC("UPDATE cars SET status ='$stat' WHERE idCar='$id'");

  if($save){
    
    ?>
<script>
    
  
        swal({
            type: "success",
            title: "Désactivé avec succés",
            showConfirmButton: true,
            confirmButtonText: "Fermer"
    
            }).then(() => {
            
                window.location = "index.php?page=cars";
                
        })

</script>

<?php  
  } 
}
?>


 
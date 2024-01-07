<?php 

if(isset($_GET['id'])){
  
    $worker_query = $conn->query("SELECT * FROM costs  WHERE idCost=".$_GET['id']);
  
      foreach($worker_query->fetch() as $k =>$v){
        $meta[$k] = $v;
      }


  }

?>
<div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl blur shadow-blur mt-4 left-auto top-1  " >
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dépenses</li>
          </ol>
          <h6 class="font-weight-bolder mb-0"><?php if(isset($_GET['id'])){ echo 'Editer une Dépense' ;}else{ echo 'Ajouter une Dépense' ;} ?></h6>
        </nav>

        <?php include '../includes/navBar.php'; ?>
      
    <!-- End Navbar -->


    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-4 mx-md-4 mt-n10">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../photos/bill.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php if(isset($_GET['id'])){ echo 'Modifier' ;}else{ echo 'Nouvelle' ;} ?> 
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
              Dépense
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
             
            </div>
          </div>
        </div>
        <div class="card-body">
                <form role="form" class="text-start" id="add_cost" enctype="multipart/form-data">

                <input class="form-control" type="hidden" name="id" value="<?php echo isset($meta['idCost']) ? $meta['idCost']: '' ?>" required>
                <input type="hidden"  name="detail" value="" >


                  <div class="input-group input-group-outline my-3">
                        <select name="nameCost"  id ="newExpense" class="form-control" required>


                            <?php 
                            
                            if(isset($_GET['id'])){ ?>
                            
                                <option value="<?php echo isset($meta['nameCost']) ? $meta['nameCost']: ''; ?>"> <?php echo isset($meta['nameCost']) ? $meta['nameCost']: '' ; ?> </option>
                            
                            <?php }   ?>

                            <option value="0">Choisir Type  Dépense</label>

                        <?php
                            
                            $worker_query = $conn->query("SELECT * FROM typecost ORDER BY idTypeCost DESC");  
                            
                            while($row = $worker_query->fetch()): ?> 

                                <option value ="<?php echo $row['nameTypeCost']; ?>"> <?php echo $row['nameTypeCost']; ?></option>

                            <?php endwhile; ?>

                            <option value ="0"> Ajouter Type  Dépense</option>

                        </select>
                  </div>
                  <div class="input-group input-group-outline my-3" id="dep">
                    <label class="form-label">Nouveau type Dépense</label>
                        <input type="text" class="form-control"  name="nameTypeCost"  value="<?php echo isset($meta['nameTypeCost']) ? $meta['nameTypeCost']: '' ?>" >
                  </div>
                    <label class="form-label">Montant</label>
                  <div class="input-group input-group-outline my">
                    <input type="number" class="form-control"  name="priceCost"  value="<?php echo isset($meta['priceCost']) ? $meta['priceCost']: '' ?>" required>
                  </div>

                

                <div id="car">

                  <div class="input-group input-group-outline my-3" >
                        <select name="car"  class="form-control">


                            <?php 
                            
                            if(isset($_GET['id'])){ 
                              
                              if($meta['car'] !='0'){ ?>
                            
                                <option value="<?php echo isset($meta['car']) ? $meta['car']: ''; ?>"> <?php echo isset($meta['car']) ? $meta['car']: '' ; ?> </option>
                            
                            <?php }}   ?>

                            <option value="0">Choisir Bus (Si relié)</label>

                        <?php
                            
                            $worker_query = $conn->query("SELECT * FROM cars ORDER BY idCar DESC");  
                            
                            while($row = $worker_query->fetch()): ?> 

                                <option value ="<?php echo $row['plaque']; ?>"> <?php echo $row['plaque']; ?></option>

                            <?php endwhile; ?>

                        </select>
                  </div>

                  
                  <div class="input-group input-group-outline my-3">
                        <select name="worker"  id ="worker" class="form-control">


                            <?php 
                            
                            if(isset($_GET['id']) & $meta['worker'] != 0){ 
                              
                              $workerd_query = $conn->query("SELECT * FROM workers  WHERE idWorker=".$meta['worker'] );
  
                              $rows = $workerd_query->fetch() ;
                               ?>


                            
                                <option value="<?php echo $rows['idWorker']; ?>"> <?php echo $rows['firstName'].' '.$rows['lastName']; ?> </option>
                            
                            <?php }   ?>

                            <option value="0">Choisir Employé (Si relié)</label>

                        <?php
                            
                            $worker_query = $conn->query("SELECT * FROM workers ORDER BY idWorker DESC");  
                            
                            while($row = $worker_query->fetch()): ?> 

                                <option value ="<?php echo $row['idWorker']; ?>"> <?php echo $row['firstName'].' '.$row['lastName'].' ( '.str_replace(',','.',number_format($row['salary'])) .'  F)'; ?> </option>

                            <?php endwhile; ?>

                        </select>
                  </div>
                

                  <label for="example-text-input" class="form-control-label">Réçus/Bordereaux</label>

                  <div class="input-group input-group-outline my-3">
                     
                              
                            <input class="form-control" type="file" name="img" >
                                            </br>
                              <img class="thumbnail preview" src="../photos/<?php echo $meta['bill']; ?>" alt="" width="100px" style="border-radius: 20px 20px 20px 20px">
                              
                 </div>
                 
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Enregistrer</button>
                  </div>
                  
                </form>
              </div>
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    </div>



 <script>

  $("#dep").hide();
  
$("#newExpense").change(function(){
    
  var expense = $("#newExpense").val();
  
    
  if(expense != '0'){
        
        $("#dep").hide();
        
    }else{
        
        $("#dep").show();
        
        
    }
    
});


		
	$("#add_cost").submit(function(e){
				e.preventDefault();
				start_load();
				var formData = jQuery(this).serialize();
				$.ajax({
					type: "POST",
					url: '../fonctions/ajax.php?action=save_cost',
					data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
					
					success: function(resp){

                        console.log(resp)

						if (resp == 1) {

						
                                swal({
                                    type: "success",
                                    title: "Ajouté avec succés",
                                    showConfirmButton: true,
                                    confirmButtonText: "Fermer"
                        
                                    }).then(() => {
                                    

                                        window.location = "index.php?page=costs";

                                        
                                    })
                                
                        ;

				        }else if (resp == 2) {

							
						
                                swal({
                                    type: "success",
                                    title: "Modifié avec succés",
                                    showConfirmButton: true,
                                    confirmButtonText: "Fermer"
                        
                                    }).then(() => {
                                    

                                        window.location = "index.php?page=costs";

                                        
                                    })
                               ;
						
						}
					},
					
				
					
				});
				return false;
				});

</script>


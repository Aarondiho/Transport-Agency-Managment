<?php 

if(isset($_GET['id'])){
  
    $worker_query = $conn->query("SELECT * FROM workers  WHERE idWorker=".$_GET['id']);
  
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Employés</li>
          </ol>
          <h6 class="font-weight-bolder mb-0"><?php if(isset($_GET['id'])){ echo 'Editer un Employé' ;}else{ echo 'Ajouter un Employé' ;} ?></h6>
        </nav>
        <?php 

          include '../includes/navBar.php';

          ?>
    <!-- End Navbar -->


    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-4 mx-md-4 mt-n10">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/user.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php if(isset($_GET['id'])){ echo 'Modifier' ;}else{ echo 'Nouveau' ;} ?> 
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
              Employé
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
             
            </div>
          </div>
        </div>
        <div class="card-body">
                <form role="form" class="text-start" id="add_worker" enctype="multipart/form-data">

                <input class="form-control" type="hidden" name="id" value="<?php echo isset($meta['idWorker']) ? $meta['idWorker']: '' ?>" required>


                    <label class="form-label">Nom</label>
                  <div class="input-group input-group-outline my-1">
                        <input type="text" class="form-control"  name="lastName"  value="<?php echo isset($meta['lastName']) ? $meta['lastName']: '' ?>" required>
                  </div>
                    <label class="form-label">Prénom</label>
                  <div class="input-group input-group-outline my-1">
                    <input type="text" class="form-control"  name="firstName"  value="<?php echo isset($meta['firstName']) ? $meta['firstName']: '' ?>" required>
                </div>
                 
                  <div class="input-group input-group-outline my-3">
                        <select name="typeWorker"  class="form-control" required>

                            <?php if(isset($_GET['id'])){?>

                                <option value="<?php echo isset($meta['typeWorker']) ? $meta['typeWorker']: '' ?>"> <?php 
                                    
                                    $type =isset($meta['typeWorker']) ? $meta['typeWorker']: '';
                                    if($type==2){ echo 'Charoi';}else if($type==1){ echo 'Comptable';}else{ echo 'Chauffeur';} ?> </option>
                            
                            <?php } ?> 

                            <option value="0" >Choisir Type Employé</label>
                            <option value ="1"> Comptable</option>
                            <option value ="2"> Charoi</option>
                            <option value ="3"> Chauffeur</option>
                        </select>
                  </div>

                  <div class="input-group input-group-outline my-3">
                        <select name="car"  class="form-control" >


                            <?php 

                           
                            
                            if(isset($_GET['id'])){ ?>
                            
                                <option value="<?php echo isset($meta['car']) ? $meta['car']: ''; ?>"> <?php echo isset($meta['car']) ? $meta['car']: '' ; ?> </option>
                            
                            <?php }   ?>

                            <option value="0">Choisir Plaque de Bus</label>

                        <?php
                            
                            $worker_query = $conn->query("SELECT * FROM cars ORDER BY idCar DESC");  
                            
                            while($row = $worker_query->fetch()): ?> 

                                <option value ="<?php echo $row['plaque']; ?>"> <?php echo $row['plaque']; ?></option>

                            <?php endwhile; ?>

                        </select>
                  </div>

                    <label class="form-label">Salaire</label>
                  <div class="input-group input-group-outline my-1">
                    <input type="number" class="form-control"  name="salary"  value="<?php echo isset($meta['salary']) ? $meta['salary']: '' ?>" required>
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
		
	$("#add_worker").submit(function(e){
				e.preventDefault();
				start_load();
				var formData = jQuery(this).serialize();
				$.ajax({
					type: "POST",
					url: '../fonctions/ajax.php?action=save_worker',
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
                                    

                                        window.location = "index.php?page=workers";

                                        
                                    })
                                
                        ;

				        }else if (resp == 2) {

							
						
                                swal({
                                    type: "success",
                                    title: "Modifié avec succés",
                                    showConfirmButton: true,
                                    confirmButtonText: "Fermer"
                        
                                    }).then(() => {
                                    

                                        window.location = "index.php?page=workers";

                                        
                                    })
                               ;
						
						}
					},
					
				
					
				});
				return false;
				});

</script>


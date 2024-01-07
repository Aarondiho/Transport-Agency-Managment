
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">  
  <link rel="icon" type="image/png" href="assets/img/bus.jpg">
  <title>
    Bus
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>

   <!-- sweet alert -->
   <script src="assets/js/plugins/sweetalert2.all.js"></script>

<!-- By default sweetalert2 doesn't support IE. To enable IE 11 support, include Promise polyfill -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="assets/js/jquery-1.9.1.min.js"></script>

</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Connexion</h4>
                 
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" id="login">
                  <?php echo md5('12345');?>
                    <label class="form-label">Nom d'Utilisateur</label>
                  <div class="input-group input-group-outline my-1">
                    <input type="text" class="form-control" name="userName">
                  </div>
                    <label class="form-label">Mot de Passe</label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Souvenez de moi</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Connexion</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="align-items-center justify-content-lg-between">
              <div class="copyright text-center text-sm text-white text-lg">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart bg-gradiant-primary" aria-hidden="true"></i> by
                <a href="https://www.seesternconsulting.com" class="font-weight-bold text-white" target="_blank">Seestern Consulting</a>
                for a better managment.
              </div>
            </div>
            
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>

  <script>

  jQuery("#login").submit(function(e){
		e.preventDefault();
		var formData = jQuery(this).serialize();
		start_load();
		$.ajax({
			type: "POST",
			url: "fonctions/ajax.php?action=login",
			data: formData,
			success: function(resp){

				console.log(resp);

        if(resp=='1'){
        
        window.location = 'pages/';  

        }else if(resp=='10'){
        
          window.location = 'pages/password_change.php';  

        }else if(resp == '11'){

        swal({
                type: "error",
                title: "Nom Utilisateur ou Mot de passe incorrect",
                showConfirmButton: true,
                confirmButtonText: "Fermer"
              
                }).then(() => {
                
                    window.location = "index.php";
                    
              });
    
          
			
        }else if(resp == '1100'){

          swal({
                  type: "error",
                  title: "Vous avez été désactivé, Veuillez contacter l'administrateur",
                  showConfirmButton: true,
                  confirmButtonText: "Fermer"
                
                  }).then(() => {
                  
                      window.location = "index.php";
                    
                      
            });
          
          }
        }
			
		});
		return false;
	});


  

function start_load(){

$(document).ajaxSend(function() {
    $('.spinner').prepend('<img id="loaderIcon" src="assets/img/preloader.gif" alt="..."/>');
    $("#overlay").fadeIn(300);　
});

}

function end_load(){
      $('.spinner').hide();
      $("#overlay").hide();　
      $('.cv-spinner').hide();
    

    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>

  
</body>

</html>
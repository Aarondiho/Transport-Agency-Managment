<?php

include '../connection/db_connect.php'; 

$initialDate = isset($_GET["initialDate"])? $_GET["initialDate"] : date('Y-m-01');
$finalDate =isset($_GET["finalDate"])? $_GET["finalDate"]:date('Y-m-d');


    if($initialDate == $finalDate){

            if($_GET["page"]=="pay"){

                $pay_query = $conn->query("SELECT * FROM payments WHERE datePay LIKE '%$finalDate%' ORDER BY idPay DESC");
              
            }else if($_GET["page"]=="cost"){

                $cost_query = $conn->query("SELECT * FROM costs WHERE dateCost LIKE '%$finalDate%' ORDER BY idCost DESC"); 

            }else if($_GET["page"]=="deposit"){

                $depot_query = $conn->query("SELECT * FROM deposits WHERE dateDeposit LIKE '%$finalDate%' ORDER BY idDeposit DESC");   

            } 


    }else{

        $actualDate = new DateTime();
        $actualDate ->add(new DateInterval("P1D"));
        $actualDatePlusOne = $actualDate->format("Y-m-d");

        $finalDate2 = new DateTime($finalDate);
        $finalDate2 ->add(new DateInterval("P1D"));
        $finalDatePlusOne = $finalDate2->format("Y-m-d");


        if($_GET["page"]=="pay"){
                
                $pay_query = $conn->query("SELECT * FROM payments WHERE datePay BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idPay DESC");
                
        }else if($_GET["page"]=="cost"){

            $cost_query = $conn->query("SELECT * FROM costs WHERE dateCost BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idCost DESC");
               

        }else if($_GET["page"]=="deposit"){

            $depot_query = $conn->query("SELECT * FROM deposits WHERE dateDeposit BETWEEN '$initialDate' AND '$finalDatePlusOne' ORDER BY idDeposit DESC"); 
 

        }


        

        }       


    if($_GET["page"]=="pay"){
            
            $name = 'Versements.xls';
            // Headers for download 
            header("Content-Disposition: attachment; filename=\"$name\""); 
            header("Content-Type: application/vnd.ms-excel"); 
            header('Expires: 0');
            header('Cache-control: private');
            header("Cache-Control: cache, must-revalidate"); 
            header('Content-Description: File Transfer');
            header('Last-Modified: '.date('D, d M Y H:i:s'));
            header("Pragma: public"); 
            header("Content-Transfer-Encoding: binary");


            echo '<table>';

            echo mb_convert_encoding("
                    

                        <tr>
                                <td style='border:1px solid #eee;'><b>BUS</b></td>
                                <td style='border:1px solid #eee;'><b>MONTANT</b></td>
                                <td style='border:1px solid #eee;'><b>FAITE PAR</b></td>
                                <td style='border:1px solid #eee;'><b>DATE</b></td>
                    </tr>

                    ", "UTF-8", "ISO-8859-1"
            );


            $totalAmount = 0;


            while($row = $pay_query->fetch()):

                $id = $row['idPay'];
                $totalAmount += $row["amount"]?$row["amount"]:0 ;

                
                $user_query = $conn->query("SELECT * FROM users  WHERE idUser=".$row['user']);
                $rows = $user_query ->fetch();

            

                    echo mb_convert_encoding("

                        <tr>
                            <td style='border:1px solid #eee;'>".$row['bus']."</td>
                            <td style='border:1px solid #eee;'>".$row['amount']."</td>
                            <td style='border:1px solid #eee;'>".$rows['firstName']." ".$rows['lastName']."</td>
                            <td style='border:1px solid #eee;'>".date('d-m-Y', strtotime($row['datePay']))."</td>
                        </tr>
                            
                                    ", "UTF-8", "ISO-8859-1"
                    );

            endwhile;

            if($totalAmount > 0){

                
                echo mb_convert_encoding("

                        <tr>
                        
                            <td style='border:1px solid #eee;'><b>TOTAL</b></td>
                            <td style='border:1px solid #eee;'><b>".$totalAmount."</b></td>
                            <td style='border:1px solid #eee;'></td>
                            <td style='border:1px solid #eee;'></td>
                        </tr>
                        ", "UTF-8", "ISO-8859-1"
                );

            }
                        
                echo "</table>";

                
    }else if($_GET["page"]=="cost"){


        $name = 'Depense.xls';
        // Headers for download 
        header("Content-Disposition: attachment; filename=\"$name\""); 
        header("Content-Type: application/vnd.ms-excel"); 
        header('Expires: 0');
        header('Cache-control: private');
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header("Content-Transfer-Encoding: binary");


        echo '<table>';

        echo mb_convert_encoding("

                    <tr>
                            <td style='border:1px solid #eee;'><b>DEPENSE</b></td>
                            <td style='border:1px solid #eee;'><b>COUT</b></td>
                            <td style='border:1px solid #eee;'><b>DETAIL</b></td>
                            <td style='border:1px solid #eee;'><b>DATE</b></td>
                </tr>

                ", "UTF-8", "ISO-8859-1"
        );


        $totalAmount = 0;


        while($row = $cost_query->fetch()):

            $totalAmount += $row["priceCost"]?$row["priceCost"]:0 ;


            if($row['nameCost'] =='Salaire'){

                $worker_query = $conn->query("SELECT * FROM workers  WHERE idWorker=".$row['worker']);
                $rows = $worker_query ->fetch();

                $car = $rows['firstName'].' '.$rows['lastName']; 

                
            }else  if($row['nameCost'] =='Réparation'){

                $car = $row['car'] ;

            
            }else{

                $car = '';

            }

        

                echo mb_convert_encoding("

                    <tr>
                        <td style='border:1px solid #eee;'>".$row['nameCost']."</td>
                        <td style='border:1px solid #eee;'>".$row['priceCost']."</td>
                        <td style='border:1px solid #eee;'>".($car?$car.'<br>':'').($row['detail']?nl2br(htmlspecialchars($row['detail'])):'')."</td>
                        <td style='border:1px solid #eee;'>".date('d-m-Y', strtotime($row['dateCost']))."</td>
                    </tr>
                        
                                ", "UTF-8", "ISO-8859-1"
                );

        endwhile;

        if($totalAmount > 0){

            
            echo mb_convert_encoding("

                    <tr>
                    
                        <td style='border:1px solid #eee;'><b>TOTAL</b></td>
                        <td style='border:1px solid #eee;'><b>".$totalAmount."</b></td>
                        <td style='border:1px solid #eee;'></td>
                        <td style='border:1px solid #eee;'></td>
                    </tr>
                    ", "UTF-8", "ISO-8859-1"
            );

        }
                    
            echo "</table>";

       
           

    }else if($_GET["page"]=="deposit"){


        $name = 'Dépots.xls';
        // Headers for download 
        header("Content-Disposition: attachment; filename=\"$name\""); 
        header("Content-Type: application/vnd.ms-excel"); 
        header('Expires: 0');
        header('Cache-control: private');
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header("Content-Transfer-Encoding: binary");


        echo '<table>';

        echo mb_convert_encoding("
                

                    <tr>
                            <td style='border:1px solid #eee;'><b>MONTANT</b></td>
                            <td style='border:1px solid #eee;'><b>FAITE PAR</b></td>
                            <td style='border:1px solid #eee;'><b>DATE</b></td>
                </tr>

                ", "UTF-8", "ISO-8859-1"
        );


        $totalAmount = 0;


        while($row = $depot_query->fetch()):

            
            $totalAmount += $row["amount"]?$row["amount"]:0 ;

            
            $user_query = $conn->query("SELECT * FROM users  WHERE idUser=".$row['user']);
            $rows = $user_query ->fetch();

        

                echo mb_convert_encoding("

                    <tr>
                        <td style='border:1px solid #eee;'>".$row['amount']."</td>
                        <td style='border:1px solid #eee;'>".$rows['firstName']." ".$rows['lastName']."</td>
                        <td style='border:1px solid #eee;'>".date('d-m-Y', strtotime($row['dateDeposit']))."</td>
                    </tr>
                        
                                ", "UTF-8", "ISO-8859-1"
                );

        endwhile;

        if($totalAmount > 0){

            
            echo mb_convert_encoding("

                    <tr>
                    
                        <td style='border:1px solid #eee;'><b>".$totalAmount."</b></td>
                        <td style='border:1px solid #eee;'></td>
                        <td style='border:1px solid #eee;'></td>
                    </tr>
                    ", "UTF-8", "ISO-8859-1"
            );

        }
                    
            echo "</table>";

        

    }else if($_GET["page"]=="rapport"){


        $name = 'Rapport.xls';
        // Headers for download 
        header("Content-Disposition: attachment; filename=\"$name\""); 
        header("Content-Type: application/vnd.ms-excel"); 
        header('Expires: 0');
        header('Cache-control: private');
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header("Content-Transfer-Encoding: binary");


        echo '<table>';

        echo mb_convert_encoding("
                

                    <tr>
                           <td style='border:1px solid #eee;'><b>VERSEMENT</b></td>
                           <td style='border:1px solid #eee;'><b>DEPENSE</b></td>
                           <td style='border:1px solid #eee;'><b>CAISSE</b></td>
                           <td style='border:1px solid #eee;'><b>P.A</b></td>
                           <td style='border:1px solid #eee;'><b>ACHEVEMENT</b></td>
                </tr>

                ", "UTF-8", "ISO-8859-1"
        );


                      $totVers = 0;
                      $totDep = 0;
                      $totCaisse = 0;
                      $achat = 0;
                      $i = 0;

                      $car_query = $conn->query("SELECT SUM(price) as prices, COUNT(idCar) as allCar FROM cars");
                      $cars_query = $conn->query("SELECT * FROM cars"); 
                      
                      $car =$car_query ->fetch();
                
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

                        $hundre = (($pa['inputs']?$pa['inputs']:0) - (($de['outputs']?$de['outputs']:0) + ($dsalary['salari']?$dsalary['salari']:0) + ($otherCosts?$otherCosts:0))) *100;
                        $perc = $hundre / ($row['price']?$row['price']:1);

        

                echo mb_convert_encoding("

                    <tr>
                        <td style='border:1px solid #eee;'>".($pa['inputs']?$pa['inputs']:0)."</td>
                        <td style='border:1px solid #eee;'>".(($de['outputs']?$de['outputs']:0) + ($dsalary['salari']?$dsalary['salari']:0) + ($otherCosts?$otherCosts:0))."</td>
                        <td style='border:1px solid #eee;'>".(($pa['inputs']?$pa['inputs']:0) - ($de['outputs']?$de['outputs']:0) - ($dsalary['salari']?$dsalary['salari']:0) - ($otherCosts?$otherCosts:0))."</td>
                        <td style='border:1px solid #eee;'>".($row['price']?$row['price']:0)."</td>
                        <td style='border:1px solid #eee;'>".number_format($perc,2)." %</td>
                    </tr>
                        
                                ", "UTF-8", "ISO-8859-1"
                );

        endwhile;


            $hundres = ($totVers - ($totDep?$totDep:0)) *100;
            $perce = $hundres / ($car['prices']?$car['prices']:1);

            
            echo mb_convert_encoding("

                    <tr>
                    
                        <td style='border:1px solid #eee;'><b>".$totVers."</b></td>
                        <td style='border:1px solid #eee;'><b>".($totDep?$totDep:0)."</b></td>
                        <td style='border:1px solid #eee;'><b>".($totVers - $totDep )."</b></td>
                        <td style='border:1px solid #eee;'><b>".($car['prices']?$car['prices']:0)."</b></td>
                        <td style='border:1px solid #eee;'><b>".number_format($perce,2)." %</b></td>
                    </tr>
                    ", "UTF-8", "ISO-8859-1"
            );

        
                    
            echo "</table>";

        

    } 

?>
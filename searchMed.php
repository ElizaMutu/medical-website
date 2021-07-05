<?php

require_once ("db.php");

$conn = DB::connect();
$keyword = $_POST['keyword'];
    
$query="SELECT * FROM medicamente ";
if($keyword !=''){
    $query.="WHERE nume_med LIKE '%".$keyword."%'";
}
$stmt=$conn->prepare($query);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC); //array

if(isset($data['0'])){
    foreach($data as $list){ ?> 
      
     <div id="result">
     <ul class="list-group">
        <li class="list-group-item">
        <a href="<?php echo ('medicamente/'.$list['cod_med']); ?>"><?php echo $list['nume_med']; ?></a>
     </li>  </ul>
    </div>
   <?php  }
} else {
    echo "Cautarea nu a generat niciun rezultat" ;
    }



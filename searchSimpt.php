<?php

require_once ("db.php");

$conn = DB::connect();
$keyword = $_POST['keyword'];
    
$query="SELECT * FROM simptome ";
if($keyword !=''){
    $query.="WHERE nume_simptom LIKE '%".$keyword."%'";
}
$stmt=$conn->prepare($query);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($data['0'])){
    foreach($data as $list){
      ?> 
     <div id="result">
     <ul class="list-group">
        <li class="list-group-item">
        <a href="<?php echo ('simptome/'.$list['id_simptom']); ?>"><?php echo $list['nume_simptom']; ?></a>
     </li>  </ul>
    </div>
   <?php  }
   
} else {
    echo "Cautarea nu a generat niciun rezultat" ;
    }



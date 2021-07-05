<?php

require_once ("db.php");

$conn = DB::connect();
$keyword = $_POST['keyword'];
    
$query="SELECT * FROM boli ";
if($keyword !=''){
    $query.="WHERE denumire LIKE '%".$keyword."%'";
}
$stmt=$conn->prepare($query);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($data['0'])){
   
    foreach($data as $list){  ?>
      
     <div id="result">
     <ul class="list-group">
        <li class="list-group-item">
        <a href="<?php echo ('boli/'.$list['id_boala']); ?>"><?php echo $list['denumire']; ?></a>
     </li>  </ul>
    </div>
   <?php  }
} else {
    echo "Cautarea nu a generat niciun rezultat" ;
    }



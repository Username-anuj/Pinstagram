<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>


<?php
include("../../connection/conn.php");
session_start();//you dont need where condition Left join already filter data over all of your tables demand,supplier, MIILOC

  $query_user = "SELECT * FROM User order by UserId";
                $result_user = $conn->query($query_user);
                
$table = "<table id='example' class='display' cellspacing='0' width='100%'>
<thead>
  <tr style='background:#ccc;'>
    <th STYLE='WIDTH:50px; padding:7px'>ID</th>
    <th STYLE='WIDTH:250px; padding:7px'>Description</th>

    <th STYLE='WIDTH:100px; padding:7px'>Supplier#</th>
   
</tr>   </thead>";

// if ($result->num_rows > 0) {
    $table .= "<tbody>";
while($row_user = $result_user->fetch_assoc()){
      $table .= "
      <tr>
        <th STYLE='WIDTH:50px; padding:7px'>{$row_user["UserId"]}</th>
        <th STYLE='WIDTH:250px; padding:7px'>{$row_user["UserName"]}</th>
        <th STYLE='WIDTH:100px; padding:7px'>{$row_user["Email"]}</th>
    
    </tr>";
}
$table .= "</tbody>";

$table .= "</table>";

echo $table;

?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            select: true
        } );
    } );

</script>
</body>
</html>
<?php


function create_connection(){

  //connection properties
  $servername = "localhost"; //mysql.hostinger.co.uk
  $username = "root"; //"u795493454_admin";
  $password = "D89CBD186B79B3EF";
  $dbname = "todo";  //u795493454_uifi
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(!mysqli_query($conn, "SET NAMES UTF8")){
    echo $conn->error;
  }
  return $conn;
}

//function to use if mysqlnd driver is not present
// function get_result( $Statement ) {
//     $data = array();
//     $RESULT = array();
//     $Statement->store_result();
//     for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
//         $Metadata = $Statement->result_metadata();
//         $PARAMS = array();
//         while ( $Field = $Metadata->fetch_field() ) {
//             $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
//         }
//         call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
//         $Statement->fetch();
//     }
//     return $RESULT;
// }

?>
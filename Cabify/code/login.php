<?php
if (isset($_POST['submit'])) {
  $email= $_POST['email'];
  $pas=$_POST['password'];
     
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cabify";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM customer where password='$pas' and email='$email'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) 
  {
  if($row = mysqli_fetch_assoc($result)) {
      ?>

      <?php
      session_start();
      $_SESSION["flag"]=1;
      $_SESSION["username"]=$row["email"];
      $_SESSION["userid"]=$row["userid"];
      $_SESSION['name']=$row['name'];
      $_SESSION['img']=$row['image'];
      
      ?>
      <script type="text/javascript">
      window.open('home.php','_self');
      </script>
      <?php
    }
  }  
  else {
  $sql = "SELECT * FROM driver where password='$pas' and email='$email'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    if($row = mysqli_fetch_assoc($result)) {
       
        session_start();
        $_SESSION["flag"]=2;
        $_SESSION["username"]=$row["email"];
        $_SESSION['name']=$row['name'];
        $_SESSION['img']=$row['image'];
        
        ?>
        <script type="text/javascript">
        window.open('home.php','_self');
        </script>
        <?php
      }
  } 
  else{
    ?>
    <script type="text/javascript">
      alert("please enter valid email or password...");
      window.open('home.php','_self');
    </script>
    <?php
  }
  }
  mysqli_close($conn);
}
?>

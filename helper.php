<?php

@include 'config.php';

$val=$_GET["value"];
$val_M=mysqli_real_escape_string($conn,$val);

$sql="SELECT * FROM signup_warden WHERE block='$val_M' order by Warden_ID DESC";
$result=mysqli_query($conn,$sql);

?>
<select class="field" name="warden" id="wname" onchange="my_fun2(this.value);" required>
<option>select warden</option>
<?php
    while($rows = mysqli_fetch_array($result)){
    ?>
    <option value="<?php echo $rows['Warden_ID']; ?>"><?php echo $rows['Name']; ?>  (<?php echo $rows['Room_Type']; ?>)</option>
    <?php
    }
    ?>
</select>

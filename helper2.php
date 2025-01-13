<?php

@include 'config.php';

$val=$_GET["value"];
$val_M=mysqli_real_escape_string($conn,$val);

$sql="SELECT * FROM signup_warden WHERE Warden_ID='$val_M' order by Warden_ID DESC";
$result=mysqli_query($conn,$sql);

?>
<select name="room_type" id="room_type" required>
<?php
    while($rows = mysqli_fetch_array($result)){
    ?>
    <option value="<?php echo $rows['Room_Type']; ?>"><?php echo $rows['Room_Type']; ?><input type="hidden" name="tele" id="tele" value="<?php echo $rows['tele_id']; ?>"></option>
    <?php
    }
    ?>
</select>
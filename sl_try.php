<!DOCTYPE html>
<html>
<head>
  <title>Slot Booking</title>
</head>
<body>
  <h1>Slot Booking</h1>
  <p>Please select a slot below.</p>
  <form action="sl_try2.php" method="post">
    <input type="date" name="date" placeholder="Date">
    <input type="time" name="time" placeholder="Time">
    <select name="slot">
      <?php foreach ($slots as $slot) { ?>
        <option value="<?php echo $slot; ?>"><?php echo $slot; ?></option>
      <?php } ?>
    </select>
    <input type="submit" value="Book slot">
    <input type="reset" value="Reset">
    <a href="index.php">Back</a>
  </form>
</body>
</html>



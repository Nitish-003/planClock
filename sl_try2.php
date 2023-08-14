<?php
  function generateSlots($start_time, $end_time) {
    $slots = [];
    for ($i = $start_time; $i < $end_time; $i += 10) {
      $slots[] = $i;
    }
    return $slots;
  }

  function getSlots($date, $time) {
    $start_time = strtotime($date . ' ' . $time);
    $end_time = strtotime($date . ' +1 hour');
    return generateSlots($start_time, $end_time);
  }

  $slots = getSlots($_POST['date'], $_POST['time']);

  if ($slots) {
    echo '<p>Slot booked successfully!</p>';
  } else {
    echo '<p>Slot booking failed. Please try again.</p>';
  }
?>
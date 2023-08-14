<?php

session_start();

?>
<?php

// Refer to the PHP quickstart on how to setup the environment:
// https://developers.google.com/calendar/quickstart/php
// Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
// credentials.

$event = new Google_Service_Calendar_Event(
    array(
        'summary' => 'Appointment with '. $_SESSION['recipient_name'],
        'location' => 'Department room, Block 2',
        'description' => 'This is the Appointment with ' . $_SESSION['recipient_name'],
        'start' => array(
            'dateTime' => '2023-07-10T09:00:00-07:00',
            'timeZone' => 'America/Los_Angeles',
        ),
        'end' => array(
            'dateTime' => '2030-07-10T17:00:00-07:00',
            'timeZone' => 'America/Los_Angeles',
        ),
        'recurrence' => array(
            'RRULE:FREQ=DAILY;COUNT=2'
        ),
        'attendees' => array(
            array('email' => $_SESSION['recipient_email']),
            array('email' => 'sbrin@example.com'),
        ),
        'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
                array('method' => 'email', 'minutes' => 24 * 60),
                array('method' => 'popup', 'minutes' => 10),
            ),
        ),
    )
);

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s\n', $event->htmlLink);

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

?>

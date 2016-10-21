<html>
<head>
<title></title>
</head>

<body>
<form method="POST">
Event ID: <input type="text" name="id" size="20" value="E0-001-000249321-2" /> <br />
<input type="submit" value="Show Event" />
</form>

<? if ($_REQUEST['id']) { ?>

<p>An example event:</p>

<pre>
<?php
    require 'EVDB.php';

    // Enter your application key here. (See http://api.evdb.com/keys/)
    $app_key = 'bQFXd3Kmmcn5q8sg';

    // Authentication is required for some API methods.
    $user     = $_REQUEST['roderickfung'];
    // $user     = $_REQUEST['user'];
    $password = $_REQUEST['r2d34k5'];
    // $password = $_REQUEST['password'];

    $evdb = new Services_EVDB($app_key);

    if ($user and $password)
    {
      $l = $evdb->login($user, $password);

      if ( PEAR::isError($l) )
      {
          print("Can't log in: " . $l->getMessage() . "\n");
      }
    }

    // All method calls other than login() go through call().
    $args = array(
      'id' => $_REQUEST['id'],
    );
    $event = $evdb->call('events/get', $args);

    if ( PEAR::isError($event) )
    {
        print("An error occurred: " . $event->getMessage() . "\n");
        print_r( $evdb );
    }

    // The return value from a call is an XML_Unserializer data structure.
    print_r( $event );

?>
</pre>

<? } ?>

</body>
</html>

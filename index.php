<?php

require_once "sms.class.php";
$sms = new sms_net_bd("ymJc9Nb1LNzQ1mwDfjD6AMCxpqih7Nm76pVRD6un");

$balanceReq = $sms->getBalance();
$balanceReq = $balanceReq["data"];

$msg = "";
$request_id = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (!empty($_POST["schedule"])) {
    $resp = $sms->sendScheduledSMS(
      $_POST["message"],
      $_POST["numbers"],
      $_POST["schedule"]
    );

    $msg = $resp["msg"];
    $request_id = 0;
  } else {

    $resp = $sms->sendSMS(
      $_POST["message"],
      $_POST["numbers"]
    );

    $msg = $resp["msg"];
    $request_id = $resp["data"]["request_id"] ?? 0;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container my-5 mx-auto">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4>Information</h4>
        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">

          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">

              <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                  <h6 class="mb-0">Balance</h6>
                  <p class="mb-0 opacity-75"><?= $balanceReq["balance"] ?></p>
                </div>

              </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">

              <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                  <h6 class="mb-0">Validity</h6>
                  <p class="mb-0 opacity-75"><?= date(
                                                "M d, Y h:i A",
                                                strtotime($balanceReq["validity"])
                                              ) ?></p>
                </div>

              </div>
            </a>

          </div>
        </div>


        <div class="card mx-auto">

          <div class="card-header"> Send SMS Form </div>
          <?php
          if (!empty($msg)) {
            echo '<div class="alert alert-success" role="alert">' .
              $msg .
              "</div>";
          }

          if (!empty($request_id)) {
            echo '<div class="alert alert-primary" role="alert">Request ID: ' .
              $request_id .
              "</div>";
          }
          ?>
          <form method="post" class=" p-4 ">
            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="numbers" class="form-control" placeholder="017XXXXXXXX, 88017XXXXXXXX" required>
              <div class="form-text">Single phone number or comma separated phone numbers</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Message</label>
              <textarea class="form-control" name="message" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Schedule (Optional)</label>
              <input type="datetime-local" name="schedule" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>




  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>
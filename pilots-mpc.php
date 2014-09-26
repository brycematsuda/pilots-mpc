<?php

  // Ensure time zone is always West Coast time in case of server location differences.
date_default_timezone_set("America/Los_Angeles");

  // Constants for meal plan prices and rates per day and week
  // to allow for easy editing from semester to semester.

define("plan1Start", 1479.00);
define("plan2Start", 1660.00);
define("plan3Start", 1820.00);
define("plan4Start", 2740.00);

define("plan1WeeklyRate", (plan1Start / 14.25));
define("plan2WeeklyRate", (plan2Start / 14.25));
define("plan3WeeklyRate", (plan3Start/ 14.25));
define("plan4WeeklyRate", (plan4Start / 14.25));

define("plan1DailyRate", (plan1WeeklyRate / 7));
define("plan2DailyRate", (plan2WeeklyRate / 7));
define("plan3DailyRate", (plan3WeeklyRate / 7));
define("plan4DailyRate", (plan4WeeklyRate / 7));

// Randomly picked cheesy subtitles.

$randomHeaders = array(
  'geeky randomly generated subtitle goes here',
  'it\'s burrito bowl time!',
  'how many meal points should i be at right now?',
  'is it time to start panicking and start splurging at mack\'s market?',
  'should i stop spending my points for now?',
  'here\'s why i\'m buying dinner for you',
  'am i behind on my meal plan?',
  'omnomnomnomnomnom'
  );

$rand = rand(0, count($randomHeaders) - 1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pilots Meal Points Checker</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/footable.core.min.css">
  <link rel="stylesheet" href="css/footable.standalone.min.css">  
  <link rel="stylesheet" href="css/meal-layout.css">
  <meta name="viewport" content="width=500px, initial-scale=1">
</head>
<body>
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 column">
      <h3>Pilots Meal Points Checker</h3>
        <h3 style="margin: 0 auto; padding: 0 auto;"><small>"<?php echo $randomHeaders[$rand] ?>"</small></h3>
        <table class="table table-striped table-condensed">
          <thead>
            <tr>
              <th colspan="5">Suggested Meal Plan Budgets</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Meal Plan</th>
              <th>Points Available</th>
              <th>Points Budgeted Per Week</th>
              <th>Suggested # of Meals Per Week</th>
              <th>Points Budgeted Per Day</th>
            </tr>
            <tr class="info">
              <td>1</td>
              <td><?php echo plan1Start; ?></td>
              <td><?php echo round(plan1WeeklyRate, 2); ?></td>
              <td>7 meals</td>
              <td><?php echo round(plan1DailyRate, 2); ?></td>
            </tr>
            <tr class="success">
              <td>2</td>
              <td><?php echo plan2Start; ?></td>
              <td><?php echo round(plan2WeeklyRate, 2); ?></td>
              <td>7 meals + snacks</td>
              <td><?php echo round(plan2DailyRate, 2); ?></td>
            </tr>
            <tr class="warning">
              <td>3</td>
              <td><?php echo plan3Start; ?></td>
              <td><?php echo round(plan3WeeklyRate, 2); ?></td>
              <td>14 meals</td>
              <td><?php echo round(plan3DailyRate, 2); ?></td>
            </tr>
            <tr class="danger">
              <td>4</td>
              <td><?php echo plan4Start; ?></td>
              <td><?php echo round(plan4WeeklyRate, 2) ?></td>
              <td>14 meals</td>
              <td><?php echo round(plan4DailyRate, 2); ?></td>
            </tr>
          </tbody>
        </table>
        <h4>Compare balance</h4>
        <br />
        <input type="text" rel="txtTooltip" id="enter-balance" class="form-control" maxlength="7" title="Only decimal numbers from 0 to 4999.99 are allowed." data-toggle="tooltip" data-placement="bottom" placeholder="Enter your balance in decimal form (e.g. 1000.00, 24.53)">
        <br />
        <table class="table table-striped table-condensed">
          <thead>
            <tr>
              <th colspan="5">Targeted Meal Plan Balances for Fall 2014</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Meal Plan</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
            </tr>
            <tr class="warning">
              <th>Current week ending</th>
              <th colspan="4"><?php
              // Only change weeks once we've past saturday
              if (strtotime('now') == strtotime('saturday')){
                echo date('F d, Y', strtotime('saturday'));
              }
              else {
                echo date('F d, Y', strtotime('next saturday'));
              } ?>
              </th>
            </tr>
            <tr class="warning">
              <th>Your balance</th>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
            </tr>
            <tr class="warning">
              <th>Estimated balance</th>
              <?php

              // TODO: Take into account fall break from 2014-10-11 to 2014-10-17)

              $datetime1 = new DateTime('2014-08-23');
              $datetime2 = new DateTime('now');

              $interval = $datetime1->diff($datetime2)->format('%a');

              $estWeekPlan1 = plan1Start - (3 * plan1DailyRate) - (round($interval/7) * plan1WeeklyRate);
              $estWeekPlan2 = plan2Start - (3 * plan2DailyRate) - (round($interval/7) * plan2WeeklyRate);
              $estWeekPlan3 = plan3Start - (3 * plan3DailyRate) - (round($interval/7) * plan3WeeklyRate);
              $estWeekPlan4 = plan4Start - (3 * plan4DailyRate) - (round($interval/7) * plan4WeeklyRate);

              ?>
              <td id="w-plan1"><?php echo number_format($estWeekPlan1, 2, '.', ''); ?></td>
              <td id="w-plan2"><?php echo number_format($estWeekPlan2, 2, '.', ''); ?></td>
              <td id="w-plan3"><?php echo number_format($estWeekPlan3, 2, '.', ''); ?></td>
              <td id="w-plan4"><?php echo number_format($estWeekPlan4, 2, '.', ''); ?></td>
            </tr>
            <tr class="warning">
              <th>Point difference</th>
              <td class="user-difference" id="w-plan1-diff"></td>
              <td class="user-difference" id="w-plan2-diff"></td>
              <td class="user-difference" id="w-plan3-diff"></td>
              <td class="user-difference" id="w-plan4-diff"></td>
            </tr>
            <tr class="info">
              <th>Current day ending</th>
              <th colspan="4"><?php echo date('F d, Y', strtotime('now'));?></th>
            </tr>
            <tr class="info">
              <th>Your balance</th>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
              <td class="user-balance"></td>
            </tr>
            <tr class="info">
              <th>Estimated balance</th>
              <?php 

              $estDailyPlan1 = plan1Start - (3 * plan1DailyRate) - ($interval * plan1DailyRate);
              $estDailyPlan2 = plan2Start - (3 * plan1DailyRate) - ($interval * plan2DailyRate);
              $estDailyPlan3 = plan3Start - (3 * plan1DailyRate) - ($interval * plan3DailyRate);
              $estDailyPlan4 = plan4Start - (3 * plan1DailyRate) - ($interval * plan4DailyRate);

              ?>
              <td id="d-plan1"><?php echo number_format($estDailyPlan1, 2, '.', ''); ?></td>
              <td id="d-plan2"><?php echo number_format($estDailyPlan2, 2, '.', ''); ?></td>
              <td id="d-plan3"><?php echo number_format($estDailyPlan3, 2, '.', ''); ?></td>
              <td id="d-plan4"><?php echo number_format($estDailyPlan4, 2, '.', ''); ?></td>
            </tr>
            <tr class="info">
              <th>Point difference</th>
              <td class="user-difference" id="d-plan1-diff"></td>
              <td class="user-difference" id="d-plan2-diff"></td>
              <td class="user-difference" id="d-plan3-diff"></td>
              <td class="user-difference" id="d-plan4-diff"></td>
            </tr>
          </tbody>
        </table>
        <p class="disclaimer">disclaimer 1: these values are only suggestions. having a large point difference for a given day or week
          does not necessarily mean you won't be able to deplete all your points by the end of the semester.
        <p class="disclaimer">disclaimer 2: while points do transfer from semester to semester, they do not transfer from year to year. you have been warned.
        <p class="disclaimer">disclaimer 3: this site is in no way officially affiliated with the university of portland or bon appetit. this serves only as an unofficial guide for spending meal points in a timely manner at up.</p>
        <p class="disclaimer">&copy; 2014 <a href="http://brycematsuda.com/">bryce matsuda</a> // last updated on sept. 25, 2014.</p>
        </div>
      </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/meal.js"></script>
    <script src="js/footable.js"></script>
  </body>
  </html>

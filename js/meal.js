$(document).ready(function(){

  $('input[rel="txtTooltip"]').tooltip();

// Regex to test for numeric input in decimal form (200.00, 2003.13) from 0000.00 to 4999.99.
var numRegex = /^[0-4]?([0-9]){1,3}\.([0-9]){2}$/;

// Current plan points.
var wPlan1 = $("td#w-plan1").text();
var wPlan2 = $("td#w-plan2").text();
var wPlan3 = $("td#w-plan3").text();
var wPlan4 = $("td#w-plan4").text();

var dPlan1 = $("td#d-plan1").text();
var dPlan2 = $("td#d-plan2").text();
var dPlan3 = $("td#d-plan3").text();
var dPlan4 = $("td#d-plan4").text();

$("input#enter-balance").keyup( function(){
  var balance = $("input#enter-balance").val(); // User input balance

  if (balance.match(numRegex)) {
      // Show balance and point difference across all meal plans
      $("td.user-balance").text(balance);
      $("td#w-plan1-diff").text((balance - wPlan1).toFixed(2));
      $("td#w-plan2-diff").text((balance - wPlan2).toFixed(2));
      $("td#w-plan3-diff").text((balance - wPlan3).toFixed(2));
      $("td#w-plan4-diff").text((balance - wPlan4).toFixed(2));

      $("td#d-plan1-diff").text((balance - dPlan1).toFixed(2));
      $("td#d-plan2-diff").text((balance - dPlan2).toFixed(2));
      $("td#d-plan3-diff").text((balance - dPlan3).toFixed(2));
      $("td#d-plan4-diff").text((balance - dPlan4).toFixed(2));
    }
    else {
      // Clear the cells.
      $("td.user-balance").text("");
      $("td.user-difference").text("");
    }
  });


$("p#link-disc").click(function() {
  $("div#disclaimer").slideToggle();
  return false;
});
});

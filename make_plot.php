<?php
//get_include_path();


   //Set content-type header
   //header("Content-type: image/png");

//include jpgraph
ini_set('include_path','../myphp/');
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('jpgraph/jpgraph_line.php');
require_once ('jpgraph/jpgraph_date.php');

// Decode then unserialize GET data sent from details.php
$ydata = unserialize(urldecode(($_GET['points'])));
$xdata = unserialize(urldecode(($_GET['date'])));  //include xdata to get proper time labelling on x axis.




$maxy = max($ydata) + 20;
$miny = min($ydata) - 20;
$maxx = max($xdata) + 1000;
$minx = min($xdata);

// Only plot the last $cut timepoints
//$cut = 10;
//array_splice($ydata, $cut);
//array_splice($xdata, $cut);




// Width and height of the graph
$width = 300; $height = 400;
 
// Create a graph instance
$graph = new Graph($width,$height);
 
// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
//$graph->SetScale('intint');
$graph->SetScale( 'datlin' ,$miny,$maxy, $minx, $maxx ); 



$graph->xaxis->SetLabelAngle(90);
$graph->SetMargin(40,40,30,80);

// Setup a title for the graph
//$graph->title->Set('test');
 
// Setup titles and X-axis labels
//$graph->xaxis->title->Set('(time)');
//$graph->xaxis->SetTickLabels($xdata); 

// The automatic format string for dates can be overridden
$graph->xaxis->scale->SetDateFormat('y:m:d');

// Adjust when to place ticks
$graph->xaxis->scale->SetTimeAlign(MONTHADJ_6);
// Force labels to only be displayed every 5 minutes
//$graph->xaxis->scale->ticks->Set(*60*60);

// Setup Y-axis title
$graph->yaxis->title->Set('(Weight (lbs))');
 


// Create the bar plot
$barplot=new BarPlot($ydata,$xdata);
$lineplot = new LinePlot($ydata,$xdata); 

// Add fill under lineplot
$lineplot->SetFillColor('orange@0.5');


// Add the plot to the graph
$graph->Add($barplot);
$graph->Add($lineplot);
 
// Display the graph
$graph->Stroke();



?>

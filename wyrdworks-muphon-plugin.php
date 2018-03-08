<?php 
    /*
    Plugin Name: MUFON test
    Plugin URI: http://roncartwright.net
    Description: Plugin for displaying last 20 reported MUFON sightings 
    Author: R. Cartwright
    Version: 1.0
    Author URI: http://roncartwright.net
    */
?>

<?php 
ini_set('MAX_EXECUTION_TIME', 10000);
error_reporting(0);
    
$url = 'https://mufoncms.com/cgi-bin/report_handler.pl?req=latest_reports'; 

// Open url and get the contents of each <td> to establish object
// 'elements'
  $doc = new DOMDocument();
  $doc->loadHTMLFile($url);
  $elements = $doc->getElementsByTagName('td');

echo('<table border="1">');   

// loop through elements object to find nodeValue
if (!is_null($elements)) {
    $count = 0;
  foreach ($elements as $element) {
    $nodes = $element->childNodes;
      
    foreach ($nodes as $node) {
       if(preg_match("/^[0-9]{5,}$/",$node->nodeValue)){
          echo("<tr>");
       }
       echo("<td>" . $node->nodeValue. "</td>");
    }
  $count++;
      if(preg_match("/[A-Z]{2}$/",$node->nodeValue) && $count == 6){
         echo("</tr>");
          $count = 0;
      }
   }
}
echo('</table>');     
?>

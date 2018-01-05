<?php

$pageTitle = "INZU - Events";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start


/*Page Content*/


//Get event ID if user has made a selection
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);


//Request data from INZU for the 20 latest "Event" entries ordered by date and in ascending order

$arguments = array("page"=>"1", "page_rows"=>"20", "order"=>"date", "order_type"=>"ASC");
$inzu = INZU_GET("cms/events", $arguments);


///We now begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;

foreach ( $inzu->data as $entry ) { 
	
$i++;


//Convert date from unix time to human readable
$date = intval($entry->date);
$date = date("M jS Y",$date);


if( ($i == 1 && !$entry_id ) || ( $entry->entry_id == $entry_id ) ) { //Displays the first entry if an entry has not been selected from the archive

//Create booking link if there is one set and event is in the future

$todays_date = date("U");

if ( $entry->book != '' && ($date+86400) > $todays_date ) {
	
$book = '<br/><a href="'.$entry->book.'" target="_blank" >Book tickets</a>';

} else {
	
$book = NULL;

}


echo<<<EOD
<h2>EVENTS</h2>
<hr/>
<img src="{$entry->image}" width="480" />
<h2>{$entry->title} - $date</h2>
<p class="article">{$entry->description}$book</p>
<hr/>
<h2>Date</h2>
<span class="main_body">$date</span>
EOD;


if ( $entry->venue != "" ) {
	
echo<<<EOD
<h2>Venue</h2>
<span class="main_body">{$entry->venue}</span>
EOD;

}
 
if ( $entry->time != "" ) {
	
echo<<<EOD
<h2>Time</h2>
<span class="main_body">{$entry->time}</span>
EOD;

}

if ( $entry->fee != "" ) {
	
echo<<<EOD
<h2>Fee</h2>
<span class="main_body">{$entry->fee}</span>
EOD;

}

if ( $entry->location != "" ) {
	
echo<<<EOD
<h2>Where</h2>
<span class="main_body">{$entry->location}</span>
EOD;

}

if ( $entry->review != "" ) {
	
echo<<<EOD
<h2>Review</h2>
<hr/><div class="main_body">{$entry->review}</div>
EOD;

}


} else {

//Create archive

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a href="events.php?entry_id={$entry->entry_id}">{$entry->title}</a> $date</div>
</div>
EOD;
}

}



$right_col=<<<EOD
<h2>Events</h2>
<hr/>
$archive
EOD;



require("template/template_end.php");


?>

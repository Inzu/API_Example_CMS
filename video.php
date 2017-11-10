<?php

$pageTitle = "INZU - Video";


//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start


/*Page Content*/

//Get the entry id
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);


//Request data from INZU for the 10 latest "Video" entries ordered by date and in ascending order
$arguments = array("page"=>"1", "page_rows"=>"100", "order"=>"date", "order_type"=>"ASC");
$inzu = INZU_GET("cms/video", $arguments);


///We now begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;

foreach ( $inzu->data as $entry ) { 
	
$i++;

if( ( $i==1 && !$entry_id ) || ( $entry->entry_id == $entry_id ) ) { //Displays the first entry if an entry has not been selected from the archive

echo<<<EOD
<h2>Video</h2>
<hr/>
<div>
{$entry->video}
<hr/><h2>$entry->title</h2>
<hr/><div >{$entry->description}</div>
</div>
EOD;


} else {

//Create archive

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a  href="video.php?id={$entry->entry_id}">{$entry->title}</a></div>
</div>
EOD;

}

}

$right_col=<<<EOD
<h2>Videos</h2>
<hr/>
$archive
EOD;


require("template/template_end.php");

?>
<?php

//Load includes
require "lib/core/config.php";  /// This is where your API Key is stored

$pageTitle = "INZU - Articles";

include("template/header.php"); /// Your site template header


/*Page Content*/


//Get article ID from right column archive list if clicked
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);


//Request data from INZU for the 32 latest "Article" entries starting with the latest, ordered by date and in ascending order.
$json = file_get_contents("$api_base/cms/articles?api_key={$api_key}&pagenum=1&rows_page=32&order=date&order_type=ASC");
$inzu = json_decode($json); 


///Begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;
foreach ($inzu->data as $entry) { 
$i++;

if(($i==1 && $entry_id=="")||($entry_id==$entry->entry_id)){ //Displays the first entry if an entry has not been selected from the archive


//Loop through the file attachments for the article

foreach ($entry->file_list as $file ){
$files.=<<<EOD
<div class="page_element">
{$file->description} - <a href="{$file->file}"/> Download</a>
</div>
EOD;
}


//Create the page and include the attachments

echo<<<EOD
<h2>Article</h2>
<hr/><h3>{$entry->title}</h3>
<div class="article">
{$entry->article}
{$files}
</div>
EOD;

}else{

//If the entry is not being displayed it is added to the archive list

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a href="articles.php?id={$entry->entry_id}">{$entry->title}</a></div>
</div>
EOD;

}
}


$right_col=<<<EOD
<h2>Articles Posted</h2>
<hr/>
$archive
EOD;



include("template/footer.php"); /// Your site template header

?>
<?php


//Load includes
require "lib/core/config.php";  /// This is where your API Key is stored

$pageTitle = "INZU - Gallery";

include("template/header.php"); /// Your site template header


/*Page Content*/


//Get gallery ID if user has made a selection
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);

//Get gallery image ID if user has selected an image otherwise set to zero
$img_id = preg_replace("/[^0-9]/", "",@ $_GET['img_id']);

if(!$img_id){$img_id=0;}


//Request data from INZU for the 10 latest "Gallery" entries starting with the latest, ordered by date and in ascending order.
$json = file_get_contents("$api_base/cms/gallery?api_key={$api_key}&pagenum=1&rows_page=100&order=date&order_type=ASC");
$inzu = json_decode($json); 


///We now begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;
foreach ($inzu->data as $entry) { 
$i++;

if(($i==1&&!$entry_id)||($entry->entry_id==$entry_id)){ //Displays the first entry if an entry has not been selected from the archive


echo<<<EOD
<h2>Gallery</h2>
<hr/>
<div>
<img src="{$entry->image_list[$img_id]->image}"  width="480" />
<hr/><div >{$entry->image_list[$img_id]->caption}</div>
<hr/><h2>$entry->title</h2>
<div class="main_body" style="margin-bottom:4px;" >$entry->description</div>
</div>
EOD;

//Add gallery thumbnails
$im=0;
foreach ($entry->image_list as $img ){
echo<<<EOD
<div class="mask" style="float:left;">
<a href="gallery.php?entry_id={$entry->entry_id}&img_id={$im}"><img src="{$img->image_thumb}" border="0"/></a>
</div>
EOD;
$im++;
}


}else{

//Create archive

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a  href="gallery.php?id={$entry->entry_id}">{$entry->title}</a></div>
</div>
EOD;

}

}

$right_col=<<<EOD
<h2>Galleries</h2>
<hr/>
$archive
EOD;


include("template/footer.php"); /// Your site template header



?>

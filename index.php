<?php

//Load includes
include("lib/core/config.php");  /// This is where your API Key is stored

$pageTitle = "INZU - Home";

include("template/header.php"); /// Your site template header


/*Page Content*/

//We will now select a series of data feeds from Inzu, these can be mixed and matched in any combination


//Request data from INZU for the "Home" section
$json = file_get_contents("$api_base/cms/home?api_key={$api_key}");
$inzu = json_decode($json); 

echo<<<EOD
<h2>Home</h2>
<hr/><p class="article" >{$inzu->data[0]->entry}</p>
EOD;



//Request data from INZU for the latest "Event" entry
$json =  file_get_contents("$api_base/cms/events?api_key={$api_key}&latest=true");
$inzu = json_decode($json); 

echo<<<EOD
<div>
<img src="{$inzu->data[0]->image}" width="477"/>
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/>
</div>
EOD;



//Request data from INZU for the latest "video" entry
$json =  file_get_contents("$api_base/cms/video?api_key={$api_key}&latest=true");
$inzu = json_decode($json); 


echo<<<EOD
<div>
{$inzu->data[0]->video}
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/></div>
EOD;



include("template/footer.php"); /// Your site template footer

?>
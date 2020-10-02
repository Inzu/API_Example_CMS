<?php


$pageTitle = "Inzu - Home";	


// Load Includes

require("lib/core/functions.php"); 
require("lib/core/config.php");  // This is where your API Key and API Password is stored
require("template/template_start.php"); // Your site template start


// We will now select a series of data feeds from Inzu, these can be mixed and matched in any combination

// Request data from Inzu for the "Home" section

$inzu = INZU_GET("/cms/home");

echo<<<EOD
<h2>Home</h2>
<hr/><p class="article" >{$inzu->data[0]->entry}</p>
EOD;



// Request data from Inzu for the latest "Event" entry

$inzu = INZU_GET("/cms/events", array("latest"=>"true"));


echo<<<EOD
<div>
<img src="{$inzu->data[0]->image}" width="477"/>
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/>
</div>
EOD;



// Request data from Inzu for the latest "video" entry

$inzu = INZU_GET("/cms/video", array("latest"=>"true"));

echo<<<EOD
<div>
{$inzu->data[0]->video}
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/></div>
EOD;


include("template/template_end.php"); // Your site template footer

?>
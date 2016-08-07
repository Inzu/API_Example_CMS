<?php

//Load includes
include("lib/core/config.php");  /// This is where your API Key is stored

$pageTitle = "INZU - Search";

include("template/header.php"); /// Your site template header


/*Page Content*/

$search=preg_replace("/[^a-zA-Z0-9[:blank:][:space:]]/", "", urldecode($_REQUEST['search']));
$search_api=urlencode($search);

//Results
$json = file_get_contents("$api_base/functions/search?api_key={$api_key}&search=$search_api");
$inzu = json_decode($json);


foreach($inzu->data as $entry){

	if($entry->zone == "about"){
		
	$link="about.php?";
	
	}else if($entry->zone == "articles"){
		
	$link="articles.php?id=".$entry->entry_id;
	
	}else if($entry->zone == "news"){
		
	$link="news.php?id=".$entry->entry_id;
	
	}

$results.=<<<EOD
<div>
<h2>{$entry->title}</h2>
<p>{$entry->preview}</p>
</div>
+ <a href="{$link}">View</a>
<hr>
EOD;
}

if(!$results){
$results="<p>Try using the phrase \"test\" to find a result.</p>";
}


echo<<<EOD
<h2>Search results</h2>
<hr/>$results
EOD;


include("template/footer.php"); /// Your site template header

?>
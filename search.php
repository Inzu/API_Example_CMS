<?php

$pageTitle = "INZU - Search";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start

/*Page Content*/

$search = preg_replace("/[^a-zA-Z0-9[:blank:][:space:]]/", "", @$_REQUEST['search']);

//Results

$inzu = INZU_GET("functions/search", array("search"=>$search));


foreach ( $inzu->data as $entry ) {

	if( $entry->zone == "about" ) {
		
	$link = "about.php?";
	
	}else if( $entry->zone == "articles" ) {
		
	$link = "articles.php?entry_id=".$entry->entry_id;
	
	}else if( $entry->zone == "news" ) {
		
	$link = "news.php?entry_id=".$entry->entry_id;
	
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

if ( !$results ) $results = "<p>Try using the phrase \"test\" to find a result.</p>";

echo<<<EOD
<h2>Search results</h2>
<hr/>$results
EOD;


require("template/template_end.php");

?>

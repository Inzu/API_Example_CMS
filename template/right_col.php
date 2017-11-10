<?php

///Default content for the right column

$arguments = array("page"=>"1", "page_rows"=>"3", "order"=>"date", "order_type"=>"ASC");
$inzu = INZU_GET("cms/news", $arguments);

foreach ($inzu->data as $entry) { 

$date = intval($entry->date);
$date = date("M jS, Y",$date);

$right_col.=<<<EOD
<div>
<h4>{$entry->title}</h4>
<img src="{$entry->image}" width="72" class="inzu_feed_image" />
	<div  class="inzu_feed_text" >
	<a href="/news.php?news_id={$entry->entry_id}" >{$entry->article}</a>
	<br />
	<span class="inzu_feed_textSmall" >{$date}</span>
	</div>
</div>
<hr/>
EOD;

}


$right_col=<<<EOD
<h1>NEWS</h1>
<hr/>
$right_col
EOD;


?>
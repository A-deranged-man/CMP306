<?php
header('Content-type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>

<rss version=\"2.0\"
     xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
     xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"
     xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
     xmlns:atom=\"http://www.w3.org/2005/Atom\"
     xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"
     xmlns:slash=\"http://purl.org/rss/1.0/modules/slash/\"
     >
<channel>
 <title>DB Software RSS Feed</title>
 <link>https://mayar.abertay.ac.uk/~1901368/cmp306/</link>
 <description>RSS Feed containing all items from my site</description>
";

include("../model/api.php");
$gridtxt = displaygridview() ;
$grid = json_decode($gridtxt) ;
for ($i=0, $iMax = 6; $i< $iMax; $i++) {
    echo "<item>
      <title><![CDATA[{$grid[$i] -> title}]]></title>
      <link>https://mayar.abertay.ac.uk/~1901368/cmp306/view/item.php?item_page_id={$grid[$i] -> item_page_id}</link>  
       <description>{$grid[$i] -> short_description}</description></item>";
}
echo "
</channel>
</rss>";

?>



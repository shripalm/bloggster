<pre>
<?php
    $xmlString = file_get_contents('sitemap.xml');
    $xml = new SimpleXMLElement($xmlString);
    print_r($xml)
?>
</pre>
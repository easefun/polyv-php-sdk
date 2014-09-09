polyv-php-sdk
=============
Usage

--
```php

<?php

require_once('polyvSDK.php');


$polyvSDK = new PolyvSDK();

$result = $polyvSDK->getNewList(1,10,"");
foreach($result as $video){
	echo $video['swf_link']."<br>";
}

```

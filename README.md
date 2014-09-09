polyv-php-sdk
=============
Usage

--
```php

<?php

require_once('polyvSDK.php');


$polyvSDK = new PolyvSDK();
//load newest video list
$result = $polyvSDK->getNewList(1,10,"");
foreach($result as $video){
	echo $video['swf_link']."<br>";
}

```
```php
//load one video info
$result = $polyvSDK->getById('sl8da4jjbx8d08acd03fa6eee83a9cf0_s');
echo $result['swf_link'];
```

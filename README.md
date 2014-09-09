polyv-php-sdk
=============
Usage
---

config
--
before call any function

change demo parameters in polyvSDK.php __construct to your own `_readtoken`,`_writetoken`,`_privatekey` and if `_sign` needed.
```php

function __construct() {
	
		$this->_readtoken = "nsJ7ZgQMN0-QsVkscukWt-qLfodxoDFm";
		$this->_writetoken 	= "Y07Q4yopIVXN83n-MPoIlirBKmrMPJu0";	
		$this->_privatekey = "DFZhoOnkQf";	
		$this->_sign = true;//提交参数是否需要签名
}
	
```php



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

polyv-php-sdk Usage
=============


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
	
```


Demo code
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


```php
//upload a local video file
$result = $polyvSDK->uploadfile('title1','desc1','tag1','','/home/a.mp4');
echo $result['swf_link'];
```


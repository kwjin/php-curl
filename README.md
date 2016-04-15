<h1>PHP Curl Library</h1>

<h3>How To Use</h3>


// 2016-04-15 by kwj
$curl_obj = new Class_Curl(); // Construct.
$curl_obj->url="_URL_"; // 

$curl_obj->useragent="Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36"; // User Agent.

$curl_obj->referer="http://www.aliexpress.com/category/5090301/mobile-phones.html?spm=2114.01010208.2.4.8YU1rf"; // Referer.
$curl_obj->cookie="aep_usuc_f=site=glo&region=IN&b_locale=en_US&c_tp=INR; intl_locale=en_US;"; // Target Site Cookie.
$curl_obj->curlInit(); // Variables Setting and Ready 
$curl_obj->curlgetPage(); // Curl Run
$page_result_time = $curl_obj->loadtime; // Get Page Run time
$response_body = $curl_obj->receive_data; // Response page set
unset($curl_obj); // Destory Curl Object
</code>

<h1>PHP Curl Library</h1>

<h3>How To Use</h3>
===================
<p>
$curl_obj = new Class_Curl(); // Construct.
<br>
$curl_obj->url="_URL_"; // Target Url
<br>
$curl_obj->useragent="Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36"; // User Agent.
<br>
$curl_obj->referer="_REFERER_ADRESS_"; // Referer.
<br>
$curl_obj->cookie="_SITECOOKIE_"; // Target Site Cookie.
<br>
$curl_obj->curlInit(); // Variables Setting and Ready 
<br>
$curl_obj->curlgetPage(); // Curl Run
<br>
$page_result_time = $curl_obj->loadtime; // Get Page Run time
<br>
$response_body = $curl_obj->receive_data; // Response page set
<br>
unset($curl_obj); // Destory Curl Object
</p>

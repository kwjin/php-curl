<?
/*
Author : KWJ
Date : 2010-02-25 06:00
*/

class Curl
{
    public $url = "";
    public $cookie = "";
    public $post = false;
    public $params = array();
    public $timeout = 3;
    public $receive_data = "";
    public $addopt = "";
    public $pagestatus = "";
    public $return = true;
    public $loadtime = 0;
    public $binarytransfer = 0;
    public $headers = array("Content-Type" => "text/html", 'Content-Length' => 0);
    public $sslverify = false;
    public $useragent = "";
    public $followlocation = 0;
    public $request_method = 'GET';
    public $referer = "";
    public $debug = 0;

    public function __construct()
    {
    }

    public function curl_init()
    {
        if ($this->post < 1) { // GET type
            $tmp_data = "";
            if (is_array($this->params)) {
                while (list($key, $val) = each($this->params)) {
                    if ($tmp_data == "") {
                        $tmp_data .= $key . "=" . $val;
                    } else {
                        $tmp_data .= "&" . $key . "=" . $val;
                    }
                }
            } else {
                if (!empty($this->params)) {
                    $tmp_data = $this->params;
                }
            }

            if ($tmp_data != "") {
                if (substr($tmp_data, 0, 1) == "?") {
                    $this->url = $this->url . $tmp_data;
                } else {
                    $this->url = $this->url . "?" . $tmp_data;
                }
            }
        }
    }

    public function curl_get_page()
    {
        $page_stime = time();
        $__curl_handler = curl_init();
        curl_setopt($__curl_handler, CURLOPT_URL, $this->url);
        if ($this->post) {
            curl_setopt($__curl_handler, CURLOPT_POST, $this->post);
            curl_setopt($__curl_handler, CURLOPT_POSTFIELDS, $this->params);
            curl_setopt($__curl_handler, CURLOPT_CUSTOMREQUEST, $this->request_method);
        } else {
            curl_setopt($__curl_handler, CURLOPT_CUSTOMREQUEST, $this->request_method);
        }
        if (is_array($this->params) || !empty($this->params)) {
            $this->headers['Content-length'] = strlen(http_build_query($this->params));
        }

        curl_setopt($__curl_handler, CURLOPT_HTTPHEADER, $this->headers);

        if ($this->useragent != "") {
            curl_setopt($__curl_handler, CURLOPT_USERAGENT, $this->useragent);
        }
        curl_setopt($__curl_handler, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($__curl_handler, CURLOPT_SSL_VERIFYPEER, $this->sslverify);
        curl_setopt($__curl_handler, CURLOPT_RETURNTRANSFER, true);  //$this->return
        if ($this->binarytransfer) {
            curl_setopt($__curl_handler, CURLOPT_BINARYTRANSFER, 1);
        }
        curl_setopt($__curl_handler, CURLOPT_TCP_NODELAY, 1);
        if ($this->followlocation) {
            curl_setopt($__curl_handler, CURLOPT_FOLLOWLOCATION, true);
        }
        if ($this->referer != "") {
            curl_setopt($__curl_handler, CURLOPT_REFERER, $this->referer);
        }
        $this->receive_data = curl_exec($__curl_handler);
        $this->pagestatus = curl_getinfo($__curl_handler);
//        $this->pagestatus = curl_getinfo($__curl_handler, CURLINFO_HTTP_CODE);
        $page_etime = time();
        $this->loadtime = $page_etime - $page_stime;

        curl_close($__curl_handler);
    }
}

?>

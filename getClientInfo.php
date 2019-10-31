<?php
class clientData {
    // $_SERVER
    public $os;
    public $browser;
    public $architecture;
    public $ip;
    public $ip_lookup;
    public $language;
    public $method;
    public $script;
    public $http_cookie;
    public $request = array();
    public $post = array();
    public $get = array();
    public $files = array();
    public $remote_port;
    public $referer;
    public $provetor;
    public $agent;

    public function __construct() {
        $this->detectOs();
        $this->detectBrowser();
        $this->detectArchitecture();
        $this->detectIP();
        $this->detectLanguage();
        $this->detectReferer();
        $this->detectProvetor();
        $this->detectAgent();
        $this->detectMethod();
        $this->detectScript();
        $this->detectHttpCookie();
        $this->detectGETvars();
        $this->detectPOSTvars();
        $this->detectFILESvars();
        $this->detectREQUESTvars();
        $this->detectRemotePort();
    }

    private function detectOs() {
        $system = "unknown";
        $os = array(
            '/Windows NT 10.0/i'	=>  'Windows 10',
            '/windows nt 6.4/i'		=>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows me/i'         =>  'Windows ME',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/win98/i'				=>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/windows nt 4.0/i'     =>  'Windows NT 4.0',
            '/windows nt 3.51/i'    =>  'Windows NT 3.51',
            '/windows nt 3.5/i'   	=>  'Windows NT 3.5',
            '/windows nt 3.1/i'     =>  'Windows NT 3.1',
            '/windows nt 3.11/i'    =>  'Windows 3.11',
            '/linux/i'             	=>  'Linux',
            '/android/i'            =>  'Android',
            '/android 1.6/i'        =>  'Android 1.6',
            '/android 2.0/i'        =>  'Android 2.0',
            '/android 2.0.1/i'      =>  'Android 2.0.1',
            '/android 2.1/i'        =>  'Android 2.1',
            '/android 2.2/i'        =>  'Android 2.2',
            '/android 2.2.1/i'      =>  'Android 2.2.1',
            '/android 2.2.2/i'      =>  'Android 2.2.2',
            '/android 2.2.3/i'      =>  'Android 2.2.3',
            '/android 2.2.4/i'      =>  'Android 2.2.4',
            '/android 2.3/i'        =>  'Android 2.3',
            '/android 2.3.0/i'      =>  'Android 2.0.3',
            '/android 2.3.1/i'      =>  'Android 2.3.1',
            '/android 2.3.3/i'      =>  'Android 2.3.3',
            '/android 2.3.4/i'      =>  'Android 2.3.4',
            '/android 2.3.5/i'      =>  'Android 2.3.5',
            '/android 2.3.6/i'      =>  'Android 2.3.6',
            '/android 2.3.7/i'      =>  'Android 2.3.7',
            '/android 3.0/i'        =>  'Android 3.0',
            '/android 3.1/i'        =>  'Android 3.1',
            '/android 3.2/i'        =>  'Android 3.1',
            '/android 3.2.1/i'      =>  'Android 3.2.1',
            '/android 3.2.2/i'      =>  'Android 3.2.2',
            '/android 3.2.3/i'      =>  'Android 3.2.3',
            '/android 3.2.4/i'      =>  'Android 3.2.4',
            '/android 4.0/i'        =>  'Android 4.0',
            '/android 4.0.0/i'      =>  'Android 4.0.0',
            '/android 4.0.1/i'      =>  'Android 4.0.1',
            '/android 4.0.2/i'      =>  'Android 4.0.2',
            '/android 4.0.3/i'      =>  'Android 4.0.3',
            '/android 4.0.4/i'      =>  'Android 4.0.4',
            '/android 4.2.1/i'      =>  'Android 4.2.1',
            '/android 4.2.2/i'      =>  'Android 4.2.2',
            '/android 4.3/i'        =>  'Android 4.3',
            '/android 4.4/i'        =>  'Android 4.4',
            '/android 4.4.1/i'      =>  'Android 4.4.1',
            '/android 4.4.2/i'      =>  'Android 4.4.2',
            '/android 4.4.3/i'      =>  'Android 4.4.3',
            '/android 4.4.4/i'      =>  'Android 4.4.4',
            '/android 5.0/i'        =>  'Android 5.0',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/ubuntu/i'             =>  'Ubuntu',
            '/SymbianOS/i'          =>  'SymbianOS',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/tablet os/i'          =>  'Table OS',
            '/blackberry/i'         =>  'BlackBerry',
            '/bb/i'                 =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os as $regex => $value){
            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
                $system = $value;
            }
        }
        $this->os = $system;
    }

    private function detectBrowser() {
        $navigator = "unknown";
        $browser = array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/BrowserNG/i'  =>  'BrowserNG',
            '/konqueror/i'  =>  'Konqueror',
            '/ie/i'         =>  'Internet Explorer',
            '/mobile/i'     =>  'Handheld Browser'
        );

        foreach ($browser as $regex => $value) {
            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
                $navigator = $value;
            }
        }
        $this->browser = $navigator;
    }

    private function detectArchitecture() {
        $arqui = "32Bits (default)";
        $architecture = array(
            '/x86_64/i'     => '64Bits',
            '/amd64/i'     => '64Bits',
            '/x86-64/i'     => '64Bits',
            '/x64_64/i'    => '64Bits',
            '/x64/i'        => '64Bits',
            '/WOW64/i'     => '64Bits'
        );

        foreach ($architecture as $regex => $value) {
            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
                $arqui = $value;
            }
        }

        $this->architecture = $arqui;
    }

    private function detectIP() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $this->ip = trim(end($ipAddresses));
        }else {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }

        if (filter_var($this->ip, FILTER_VALIDATE_IP)) {
            $this->ip_lookup = $this->lookupIP($this->ip);
        } else {
            $this->ip_lookup = 'Invalid IP';
        }
    }

    private function lookupIP($ip = '') {
        if ($ip) {
            $lookup_href = 'https://www.iplocate.io/api/lookup/' . $ip;
        } else {
            return 'IP not available!';
        }

        $lookup_info = file_get_contents($lookup_href);
        $lookup_info = json_decode($lookup_info);

        if ($lookup_info) {
            return $lookup_info;
        } else {
            return 'Lookup failed!';
        }
    }

    private function detectLanguage() {
        $this->language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }

    private function detectProvetor() {
        $this->provetor = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    }

    private function detectAgent() {
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
    }

    private function detectReferer() {
        $this->referer = $_SERVER['HTTP_REFERER'];
    }

    private function detectMethod() {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    private function detectScript() {
        $this->script = $_SERVER['SCRIPT_FILENAME'];
    }

    private function detectHttpCookie() {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $this->http_cookie = $_SERVER['HTTP_COOKIE'];
        } else {
            $this->http_cookie = 'Error on getting cookie!';
        }
    }

    private function detectGETvars() {
        $this->get = $_GET;
    }

    private function detectPOSTvars() {
        $this->post = $_POST;
    }

    private function detectFILESvars() {
        $this->files = $_FILES;
    }

    private function detectREQUESTvars() {
        $this->request = $_REQUEST;
    }

    private function detectRemotePort() {
        if (isset($_SERVER['REMOTE_PORT'])) {
            $this->remote_port = $_SERVER['REMOTE_PORT'];
        } else {
            $this->remote_port = 'Remote port not detected!';
        }
    }

    public function save($dir = __DIR__ . '/connv2_logs/') {
        if (is_dir($dir)) {
            file_put_contents($dir . 'connections_' . date('d-m-Y') . '.log', print_r($this->prepareSaveData(), true), FILE_APPEND);
        } else {
            mkdir($dir);
            file_put_contents($dir . 'connections_' . date('d-m-Y') . '.log', print_r($this->prepareSaveData(), true), FILE_APPEND);
        }
    }

    private function prepareSaveData() {
        $str = PHP_EOL;
        $str .= '-----------------------------------------------------------------------------------------' . PHP_EOL;
        $str .= '---------- ' . date('d-m-Y H:i:s') . '------------------------------' . PHP_EOL;

        $str .= 'Script: ' . $this->script . PHP_EOL;
        $str .= 'Referer: ' . $this->referer . PHP_EOL;
        $str .= 'Method: ' . $this->method . PHP_EOL . PHP_EOL;

        // IP
        $str .= 'IP address: ' . $this->ip . PHP_EOL;
        $str .= '---> Lookup IP info:' . PHP_EOL;
        $str .= '->Country: ' . $this->ip_lookup->country . PHP_EOL;
        $str .= '->Country Code: ' . $this->ip_lookup->country_code . PHP_EOL;
        $str .= '->City: ' . $this->ip_lookup->city . PHP_EOL;
        $str .= '->Continent: ' . $this->ip_lookup->continent . PHP_EOL;
        $str .= '->Country: ' . $this->ip_lookup->country . PHP_EOL;
        $str .= '->Latitude: ' . $this->ip_lookup->latitude . PHP_EOL;
        $str .= '->Longitude: ' . $this->ip_lookup->longitude . PHP_EOL;
        $str .= '->Time Zone: ' . $this->ip_lookup->time_zone . PHP_EOL;
        $str .= '->Country: ' . $this->ip_lookup->country . PHP_EOL;
        $str .= '->Postal Code: ' . $this->ip_lookup->postal_code . PHP_EOL;
        $str .= '->Organisation: ' . $this->ip_lookup->org . PHP_EOL;
        $str .= '->Asn: ' . $this->ip_lookup->asn . PHP_EOL;
        $str .= '->Subdivision: ' . $this->ip_lookup->subdivision . PHP_EOL;
        $str .= '->Subdivision2: ' . $this->ip_lookup->subdivision2 . PHP_EOL;
        $str .= PHP_EOL;

        // OS, Browser
        $str .= 'OS: ' . $this->os . PHP_EOL;
        $str .= 'Architecture: ' . $this->architecture . PHP_EOL;
        $str .= 'Browser: ' . $this->browser . PHP_EOL;

        $str .= 'Provetor: ' . $this->provetor . PHP_EOL;
        $str .= 'Agent: ' . $this->agent . PHP_EOL;
        $str .= 'Language: ' . $this->language . PHP_EOL;

        if ($this->request) {
            $str .= '---------------------------------' . PHP_EOL;
            $str .= '----> Request Array:' . PHP_EOL;
            $str .= print_r($this->request, true);
            $str .= '---------------------------------' . PHP_EOL;
        }

        if ($this->post) {
            $str .= '---------------------------------' . PHP_EOL;
            $str .= '----> Post Array:' . PHP_EOL;
            $str .= print_r($this->post, true);
            $str .= '---------------------------------' . PHP_EOL;
        }

        if ($this->get) {
            $str .= '---------------------------------' . PHP_EOL;
            $str .= '----> Get Array:' . PHP_EOL;
            $str .= print_r($this->get, true);
            $str .= '---------------------------------' . PHP_EOL;
        }

        if ($this->files) {
            $str .= '---------------------------------' . PHP_EOL;
            $str .= '----> Files Array:' . PHP_EOL;
            $str .= print_r($this->files, true);
            $str .= '---------------------------------' . PHP_EOL;
        }
        $str .= '-----------------------------------------------------------------------------------------' . PHP_EOL;

        return $str;
    }
}

$info = new clientData();
$info->save();
?>
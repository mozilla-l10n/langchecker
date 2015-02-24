<?php
namespace Transvision;

class Json
{
    /**
     * Return a json/jsonp representation of data and exit
     *
     * @param array  $data  Data in json format
     * @param string $jsonp Function name, default to false
     *
     * @return string Json feed
     */
    public static function output(array $data, $jsonp = false, $pretty_print = false)
    {
        $json = $pretty_print ? json_encode($data, JSON_PRETTY_PRINT) : json_encode($data);
        $mime = 'application/json';

        if ($jsonp) {
            $mime = 'application/javascript';
            $json = $jsonp . '(' . $json . ')';
        }

        ob_start();
        header("access-control-allow-origin: *");
        header("Content-type: {$mime}; charset=UTF-8");
        echo $json;
        $json = ob_get_contents();
        ob_end_clean();

        return $json;
    }

    /**
     * Return a array from a local or remote file json file
     *
     * @param string $uri Uri of the resource
     *
     * @return array Data in array format
     */
    public static function fetch($uri)
    {
        return json_decode(file_get_contents($uri), true);
    }

    /**
     * Return HTTP code 400 and an error if the API call is incorrect
     *
     * @param string $error Error message
     *
     * @return string Display error message
     */
    public static function invalidAPICall($error)
    {
        http_response_code(400);

        return self::output(['error' => $error], false, true);
    }
}

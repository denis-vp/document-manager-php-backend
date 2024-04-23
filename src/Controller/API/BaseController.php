<?php
class BaseController
{
    /** 
     * __call magic method. 
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /** 
     * Get URI elements. 
     * 
     * @return array 
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }

    /** 
     * Get query string params. 
     * 
     * @return array 
     */
    protected function getQueryStringParams()
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }
    
    /** 
     * Send API output. 
     * 
     * @param mixed $data 
     * @param string $httpHeader 
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }

    /** 
     * Validate document. 
     * 
     * @param object $document 
     * @throws Exception 
     */
    protected function getRequestBody($key)
    {
        $requestBody = file_get_contents('php://input');
        $requestBody = json_decode($requestBody);
        if (!isset($requestBody->$key)) {
            throw new Exception("Invalid request body");
        }
        return $requestBody->$key;
    }
}
?>

<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/8/29
 * Time: 14:28
 */

namespace App\Curl;


class Http
{
    protected $url = '';

    protected $method = 'GET';

    protected $data = null;

    protected $header = [];

    protected $isReturnHeader = false;

    protected $referer = "";

    protected $isReturnCode = true;


    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header)
    {

        $this->header = $header;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }



    /**
     * @return bool
     */
    public function isReturnHeader(): bool
    {
        return $this->isReturnHeader;
    }

    /**
     * @param bool $isReturnHeader
     * @return $this
     */
    public function setIsReturnHeader(bool $isReturnHeader)
    {
        $this->isReturnHeader = $isReturnHeader;
        return $this;
    }

    /**
     * @param string $referer
     * @return $this
     */
    public function setReferer(string $referer)
    {
        $this->referer = $referer;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferer(): string
    {
        return $this->referer;
    }

    public function request(){

        $ch = curl_init(); //启动CURL 会话
        curl_setopt($ch, CURLOPT_URL, $this->url); //设置要访问的地址

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header); //设置请求头

        if($this->method == 'post'){
            curl_setopt($ch,CURLOPT_POST,1); //设置POST请求
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
        @curl_setopt($ch,CURLOPT_POSTFIELDS,$this->data); //设置发送的数据

        // 返回 response_header, 该选项非常重要,如果不为 true, 只会获得响应的正文
        curl_setopt($ch, CURLOPT_HEADER, $this->isReturnHeader);

        if($this->referer){
            curl_setopt ($ch, CURLOPT_REFERER, "http://www.xxxx.com/");
        }

        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_PROXY, "localhost:1080");



        $result['body'] = curl_exec($ch);

        if($this->isReturnCode){
            $result['http_code'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        }


        if($this->isReturnHeader){
            // 计算头部长度
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            // 根据头大小去获取头信息内容
            $result['header'] = substr($result['body'], 0, $headerSize);
        }

        curl_close($ch);

        return $result;

    }

    /**
     * @return Http
     */
    public static function getInstance(){
        return new Http();
    }
}
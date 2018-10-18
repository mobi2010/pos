<?php

namespace App\Helpers;


/**
 * curl
 *
 *
 *
 *
 * 范例：raw-data类型
 *
 * $curlParams['url'] = $apiParamsConfig['thirdUrl']['aicblock']."/api/coin/charge";#必填
 * $curlParams['header'] = ['client-id:100100110','Content-Type: text/html;charset=utf-8'];#选填
 * $curlParams['data'] = '{"quantity":"0.001","identity":"c1dfd96eea8cc2b62785275bca38ac261256e278"}';#必填
 * $curlParams['body'] = 'raw';#选填，默认form-data
 * $curlParams['debug'] = true;#选填，默认false
 *
 * HttpCurl::post($curlParams);
 *
 *
 *
 *
 *
 *
 * 范例：form-data类型
 *
 * $curlParams['url'] = $apiParamsConfig['thirdUrl']['aicblock']."/api/coin/charge";
 * $curlParams['data'] = ['email'=>'123456@qq.com'];
 *
 * HttpCurl::post($curlParams);
 * HttpCurl::get($curlParams);
 */


class HttpCurl
{
    /**
     * [put]
     * @param  array  $params [description]
     *
     * url 		[必填] string 	 	请求的地址
     * data 	[选填] array  	 	请求的数据，key value 对应
     * header   [选填] array      	请求的数据，key value 对应
     * option   [选填] array  		curl设置的选项，key value 对应
     * body 	[选填] string    	raw,默认form-data

     * @return [type]         [description]
     */
    public static function put($params=[])
    {
        $url = $params['url'];
        $data = isset($params['data']) ? $params['data'] : [];

        if(isset($params['body']) && $params['body'] == 'raw'){
            $body = $data;
        }else{
            $body = http_build_query($data);
        }


        $httpHeader = isset($params['header']) ? $params['header'] : [];

        $defaults = array(
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $body
        );

        $params['defaults'] = $defaults;
        return self::curlExec($params);
    }
    /**
     * [delete]
     * @param  array  $params [description]
     *
     * url 		[必填] string 		请求的地址
     * data 	[选填] array  		请求的数据，key value 对应
     * header   [选填] array      	请求的数据，key value 对应
     * option   [选填] array  		curl设置的选项，key value 对应
     * body     [选填] string    	raw,默认form-data
     *
     * @return [type]         [description]
     */
    public static function delete($params=[])
    {
        $url = $params['url'];
        $data = isset($params['data']) ? $params['data'] : [];

        if(isset($params['body']) && $params['body'] == 'raw'){
            $body = $data;
        }else{
            $body = http_build_query($data);
        }

        $httpHeader = isset($params['header']) ? $params['header'] : [];

        $defaults = array(
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $body
        );

        $params['defaults'] = $defaults;
        return self::curlExec($params);
    }
    /**
     * [post]
     * @param  array  $params [description]
     *
     * url 		[必填] string 		请求的地址
     * data 	[选填] array  		请求的数据，key value 对应
     * header   [选填] array      	请求的数据，key value 对应
     * option   [选填] array  		curl设置的选项，key value 对应
     * body 	[选填] string    	raw,默认form-data
     *
     * @return [type]         [description]
     */
    public static function post($params=[])
    {
        $url = $params['url'];
        $data = isset($params['data']) ? $params['data'] : [];

        if(isset($params['body']) && $params['body'] == 'raw'){
            $body = $data;
        }else{
            $body = is_array($data) ? http_build_query($data) : $data;
        }

        $httpHeader = isset($params['header']) ? $params['header'] : [];

        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $body
        );

        $params['defaults'] = $defaults;
        return self::curlExec($params);
    }


    /**
     * [get]
     * @param  array  $params [description]
     *
     * url 		[必填] string 		请求的地址
     * data 	[选填] array  		请求的数据，key value 对应
     * header   [选填] array      	请求的数据，key value 对应
     * option   [选填] array  		curl设置的选项，key value 对应
     *
     * @return [type]         [description]
     */
    public static function get($params=[])
    {
        $url = $params['url'];
        $data = isset($params['data']) ? $params['data'] : [];

        $url = empty($data) ? $url : $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($data);

        $httpHeader = isset($params['header']) ? $params['header'] : [];

        $defaults = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false
        );
        $params['defaults'] = $defaults;
        return self::curlExec($params);

    }
    /**
     * [curlExec description]
     * @return [type] [description]
     */
    private static function curlExec($params){
        $ch = curl_init();
        $option = isset($params['option']) && $params['option'] ? $params['option'] : [];
        $defaults = isset($params['defaults']) ? $params['defaults'] : [];
        $setopt = $defaults+$option;
        curl_setopt_array($ch, $defaults);
        $result = curl_exec($ch);

        if(!$result){
            $error = curl_error($ch);
            $debugInfo['error'] = $error;
        }
        curl_close($ch);

        $debugInfo['setopt'] = $setopt;
        $debugInfo['result'] = $result;
        if(isset($params['debug']) && $params['debug']){
            var_dump($debugInfo);exit;
        }
        return $result;
    }

}
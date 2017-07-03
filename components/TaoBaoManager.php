<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/30/17
 * Time: 4:26 PM
 */

namespace app\components;


class TaoBaoManager
{
    public function resolverGoods($url) {

        $html = $this->getURLContent($url);

        return $html;
    }

    /**
     * 模拟google抓取内容
     *
     * @link http://cn2.php.net/manual/en/function.curl-setopt.php#78046
     * @param string $url 链接地址
     * @param string $proxy 代理Ip信息，如：127.0.0.1:81
     * @return string $html 页面内容
     */
    public function getURLContent($url, $proxy = null) {
        $curl = curl_init();

        $header = [];
        $header[0]  = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Cookie: cna=l+pgC/cDdWcCAWVF+/5q+UVs; miid=3317872020099775032; __utma=6906807.434603219.1390489590.139048";
        $header[] = "Pragma: ";

        if(is_null($proxy)) {
            curl_setopt ($curl, CURLOPT_PROXY, $proxy);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        $html = curl_exec($curl);

        curl_close($curl);

        return $html;

    }
}
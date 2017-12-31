<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 6/30/17
 * Time: 4:26 PM
 */

namespace app\components;


use yii\base\Component;

class TaoBaoManager extends Component
{
    private function _getRules($siteName='taobao', $name='') {
        static $rules = array();
        if (empty($rules)) {
            $rules = [
                'taobao' => [
                    'shopUrl' => '/<div class="tb-shop-name">[\s\S]+?<a href="(.*?)".*>[\s\S]+<\/a>[\s\S]+<\/div>/',
                    'shop' => '/sellerNick\s+:\s\'(.+?)\',/',
                    'title' => '/\<h3.+?\>(.+?)\<\/h3\>/is',
                    'price' => '/\<em class="tb-rmb-num"\>(\d+\.\d+)(\s-\s(\d+\.\d+))?<\/em\>/',
                    'productImage50' => '/src="(.+?)_50x50\.jpg"/',

                    'sibUrl' => '/sibUrl\s+:\s\'(.+?)\',/',
                    'postFee' => '/<span class=\\\"wl-yen\\\">&yen;<\\\\\/span>(\d+\.\d+)\",/',

                    'propContents' => '/<dl class="J_Prop.+?">([\s\S]+?)<\/dl>/',
                    'valItemInfo' => '/valItemInfo\s+:\s(\{[\s\S]+?\})\n\s+?\}\)/',
                    'goodsPropName' => '/<dt class="tb-property-type">(.+?)<\/dt>/',
                    'goodsPropAliasList' => '/<li data-value="(\d+):(\d+)".*?>\n\s+<a .*?>\n\s+<span>(.+?)<\/span>\n\s+<\/a>[\s\S]+?<\/li>/',
                    'goodsDetailsContents' => '/<ul class="attributes-list">([\s\S]+?)<\/ul>/',
                    'goodsDetailsList' => '/<li title=".+?">(.+?):&nbsp;(.+?)<\/li>/',
                    'descUrl' => '/descUrl\s+:\slocation.protocol===\'http:\'\s\?\s\'.+?\s:\s\'(.+?)\',/',
                    'desc' => '/var desc=\'([\s\S]+)\';/',
                ],
            ];
        }
        if (isset($rules[$siteName])) {
            $siteRules = $rules[$siteName];
        } else {
            $siteRules = [];
        }
        return $name ? ($siteRules[$name] ? $siteRules[$name] : '') : $siteRules;
    }

    public function resolverGoods($url, &$data) {

        $pattern = '/https{0,1}:\/\/\w+\.(\w+)\.com/';

        preg_match($pattern, $url, $matches);
        $siteName = $matches[1];
        $rules = $this->_getRules($siteName);

        if ($rules) {

            $goodSource = $this->getURLContent($url);
            $goodSource = mb_convert_encoding($goodSource, 'UTF-8', 'GBK');

            $data['url'] = $url;
            $data['source'] = $siteName;
            $data['websiteType'] = 1;

            //taoBao data
            if($siteName == 'taobao') {

                $params = ['shopUrl', 'shop', 'title', 'price'];
                foreach($params as $v) {
                    $data[$v] = $this->collectOne($goodSource, $rules[$v]);
                }

                $maxPrice = $this->collectOne($goodSource, $rules['price'], 3);
                if ($data['price'] < $maxPrice) {
                    $data['price'] = $maxPrice;
                }

                $data['goodsImage'] = $this->collectAll($goodSource, $rules['productImage50']);
                $data['picUrl'] = isset($data['goodsImage'][0]) ? $data['goodsImage'][0] : "";

                $propContents = $this->collectAll($goodSource, $rules['propContents']);

                $tempPropList = [];
                foreach($propContents as $content) {
                    $item = [];
                    $item['propName'] = $this->collectOne($content, $rules['goodsPropName']);
                    $list = $this->collectAllArray($content, $rules['goodsPropAliasList']);
                    for($i=0; $i<count($list[0]); $i++) {
                        $propList = [];
                        $propList['propId'] = $list[1][$i];
                        $propList['propValueId'] = $list[2][$i];
                        $propList['customName'] = $list[3][$i];
                        $propList['smallImage'] = null;
                        $propList['bigImage'] = null;
                        $propList['isImage'] = false;
                        $item['propertyAliasList'][] = $propList;

                        $tempPropList[$list[1][$i]]['propName'] = $item['propName'];
                        $tempPropList[$list[1][$i]]['propValue'][$list[2][$i]]['propValueName'] = $list[3][$i];

                    }
                    $item['isHasImage'] = false;
                    $data['goodsShowSkuItems'][] = $item;
                }

                $goodsDetailsContents = $this->collectOne($goodSource, $rules['goodsDetailsContents']);
                $goodsDetailsArray = $this->collectAllArray($goodsDetailsContents, $rules['goodsDetailsList']);
                for($i=0; $i<count($goodsDetailsArray[0]); $i++) {
                    $item = [];
                    $item['key'] = $goodsDetailsArray[1][$i];
                    $item['value'] = explode(' ', $goodsDetailsArray[2][$i]);
                    $data['goodsDetails'][] = $item;
                }


                $descUrl = $this->collectOne($goodSource, $rules['descUrl']);
                if (!strstr($descUrl, 'https:')) {
                    $descUrl = "https:".$descUrl;
                }
                $desc = $this->getURLContent($descUrl, null, $url);
                $desc = mb_convert_encoding($desc, 'UTF-8', 'GBK');
                $data['desc'] = $this->collectOne($desc, $rules['desc']);

                $sibUrl = $this->collectOne($goodSource, $rules['sibUrl']);
                $sibSource = $this->getURLContent("https:".$sibUrl."", null, $url);
                $sibContent = json_decode($sibSource, true);

                $valItemInfo = $this->collectOne($goodSource, $rules['valItemInfo']);
                $valItemInfo = str_replace(['defSelected', 'skuMap', 'propertyMemoMap'], ['"defSelected"', '"skuMap"', '"propertyMemoMap"'], $valItemInfo);
                $valItemInfo = json_decode($valItemInfo, true);

                foreach($valItemInfo['skuMap'] as $key => $sku) {
                    $itemSku = [];
                    $properties = substr(substr($key,1), 0, strlen(substr($key,1))-1);
                    $proKeyValue = explode(';',$properties);
                    foreach($proKeyValue as $keyValue) {
                        $keyValueArray = explode(":", $keyValue);

                        $itemPropName['propId'] = $keyValueArray[0];
                        $itemPropName['propName'] = $tempPropList[$keyValueArray[0]]['propName'];
                        $itemPropName['propValueId'] = $keyValueArray[1];
                        $itemPropName['propValueName'] = $tempPropList[$keyValueArray[0]]['propValue'][$keyValueArray[1]]['propValueName'];

                        $itemSku['propertiesName'][] = $itemPropName;
                    }

                    $itemSku['skuId'] = $sku['skuId'];
                    $itemSku['properties'] = $properties;
                    if (isset($sibContent['data']['dynStock']['sku'][$key])) {
                        $itemSku['quantity'] = $sibContent['data']['dynStock']['sku'][$key]['sellableQuantity'];
                    } else {
                        $itemSku['quantity'] = 0;
                    }

                    if (isset($sibContent['data']['promotion']['promoData'][$key][0]['price'])) {
                        $itemSku['price'] = $sibContent['data']['promotion']['promoData'][$key][0]['price'];
                    } else {
                        $itemSku['price'] = $sku['price'];
                    }

                    $data['skus'][] = $itemSku;
                }

            }
            $result = true;
        } else {
            $data['url'] = $url;
            $data['source'] = $siteName;
            $result = false;
        }

        return $result;
    }

    /**
     * 模拟google抓取内容
     *
     * @link http://cn2.php.net/manual/en/function.curl-setopt.php#78046
     * @param string $url 链接地址
     * @param string $proxy 代理Ip信息，如：127.0.0.1:81
     * @param string $refer
     * @return string $html 页面内容
     */
    public function getURLContent($url, $proxy = null, $refer = 'https://www.google.com') {
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
        curl_setopt($curl, CURLOPT_REFERER, $refer);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        $html = curl_exec($curl);

        curl_close($curl);

        return $html;

    }

    public function collectAll($source, $preg, $part = 1) {
        if (preg_match_all($preg, $source, $matches)) {
            return isset($matches[$part]) ? $matches[$part] : [];
        }
        return [];
    }

    public function collectOne($source, $preg, $part = 1) {
        if (preg_match($preg, $source, $matches)) {
            return isset($matches[$part]) ? trim($matches[$part]) : "";
        }
        return false;
    }

    public function collectAllArray($source, $preg) {
        if (preg_match_all($preg, $source, $matches)) {
            return $matches;
        }
        return false;
    }
}
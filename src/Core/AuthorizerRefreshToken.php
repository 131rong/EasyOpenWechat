<?php
/**
 * AuthorizerRefreshToken.php
 *
 * Author: wangyi <chunhei2008@qq.com>
 *
 * Date:   2016/12/17 11:44
 * Copyright: (C) 2014, Guangzhou YIDEJIA Network Technology Co., Ltd.
 */

namespace Chunhei2008\EasyOpenWechat\Core;


use Chunhei2008\EasyOpenWechat\Contracts\AuthorizerRefreshTokenContract;
use Chunhei2008\EasyOpenWechat\Traits\CacheTrait;
use Doctrine\Common\Cache\Cache;

class AuthorizerRefreshToken implements AuthorizerRefreshTokenContract
{
    use CacheTrait;

    /**
     * app id
     *
     * @var string
     */
    protected $appId = '';

    /**
     * authorizer refersh token
     *
     * @var string
     */
    protected $authorizerRefreshToken = '';

    /**
     *  cache key prefix
     */

    const AUTHORIZER_REFRESH_TOKEN_CACHE_PREFIX = 'easyopenwechat.core.refresh_token.';

    public function __construct($appId, Cache $cache = null)
    {
        $this->appId = $appId;
        $this->cache = $cache;

        $this->setCacheKeyField('appId');
        $this->setPrefix(static::AUTHORIZER_REFRESH_TOKEN_CACHE_PREFIX);
    }

    /**
     *
     * get refresh token
     *
     * @return string
     */

    public function getRefreshToken()
    {
        $cacheKey = $this->getCacheKey();
        return $this->authorizerRefreshToken = $this->getCache()->fetch($cacheKey);
    }

    /**
     * set refresh token
     *
     * @param $authorizerRefreshToken
     */

    public function setRefreshToken($authorizerRefreshToken)
    {
        $cacheKey                     = $this->getCacheKey();
        $this->authorizerRefreshToken = $authorizerRefreshToken;
        $this->getCache()->save($cacheKey, $authorizerRefreshToken);
    }

}
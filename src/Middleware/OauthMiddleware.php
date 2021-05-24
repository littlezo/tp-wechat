<?php

declare(strict_types=1);
/**
 * @version 1.0.0
 * @author @小小只^v^ <littlezov@qq.com>  littlezov@qq.com
 * @contact  littlezov@qq.com
 * @link     https://github.com/littlezo
 * @document https://github.com/littlezo/wiki
 * @license  https://github.com/littlezo/MozillaPublicLicense/blob/main/LICENSE
 *
 */
namespace littler\WeChat\Middleware;

use EasyWeChat\OfficialAccount\Application;
use think\facade\Event;
use think\facade\Log;
use think\facade\Session;
use think\Request;

class OauthMiddleware
{
    /**
     * 执行中间件.
     *
     * @param null $param
     * @return mixed|\think\response\Redirect
     */
    public function handle(Request $request, \Closure $next, $param = null)
    {
        $params = $this->getParam($param);

        $account = $params['account'];
        $scopes = $params['scopes'];
        //定义session
        $session_key = 'wechat_oauth_user_' . $account;
        $session = Session::get($session_key);
        /* @var Application $officialAccount */
        $officialAccount = app(\sprintf('wechat.official_account.%s', $account));
        if (! $scopes) {
            $scopes = config(\sprintf('wechat.official_account.%s.oauth.scopes', $account));
        }
        if (! $scopes) {
            $scopes = ['snsapi_base'];
        }
        if (is_string($scopes)) {
            $scopes = array_map('trim', explode(',', $scopes));
        }
        // dd($scopes);
        Log::info(json_encode($session));
        if (! $session) {
            if ($request->get('code')) {
                $session = $officialAccount->oauth->user();
                Session::set($session_key, $session);
                Event::trigger('oauth', [
                    'user' => $session,
                    'type' => 'official_account',
                    'is_new' => true,
                ]);
                //跳转到登录
                Log::info($this->getTargetUrl($request));
                return redirect($this->getTargetUrl($request));
            }
            $url = $officialAccount->oauth->scopes($scopes)->redirect($request->url(true));
            return redirect($url);
        }
        Event::trigger('oauth', [
            'user' => $session,
            'type' => 'official_account',
            'is_new' => false,
        ]);
        return $next($request);
    }

    /**
     * @param $params
     * @return array
     */
    protected function getParam($params)
    {
        //定义初始化
        $res['account'] = 'default';
        $res['scopes'] = null;
        if (! $params) {
            return $res;
        }
        //解析
        $result = explode(':', $params);
        $account = '';
        $scopes = '';
        if (isset($result[0])) {
            $account = $result[0];
        }
        if (isset($result[1])) {
            $scopes = $result[1];
        }
        if ($account) {
            if (strstr($account, 'sns')) {
                $res['scopes'] = $account;
            } else {
                $res['account'] = $account;
            }
        }
        if ($scopes) {
            $res['scopes'] = $scopes;
        }
        return $res;
    }

    /**
     * Build the target business url.
     *
     * @param Request $request
     *¬
     * @return string
     */
    protected function getTargetUrl($request)
    {
        dd($request);
        $param = $request->get();
        if (isset($param['code'])) {
            unset($param['code']);
        }
        if (isset($param['state'])) {
            unset($param['state']);
        }
        return $request->baseUrl() . (empty($param) ? '' : '?' . http_build_query($param));
    }
}

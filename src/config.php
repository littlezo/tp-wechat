<?php

declare(strict_types=1);
/**
 * #logic 做事不讲究逻辑，再努力也只是重复犯错
 * ## 何为相思：不删不聊不打扰，可否具体点：曾爱过。何为遗憾：你来我往皆过客，可否具体点：再无你。.
 *
 * @version 1.0.0
 *
 * @author @小小只^v^ <littlezov@qq.com>  littlezov@qq.com
 * @contact  littlezov@qq.com
 *
 * @see     https://github.com/littlezo
 * @document https://github.com/littlezo/wiki
 *
 * @license  https://github.com/littlezo/MozillaPublicLicense/blob/main/LICENSE
 */
return [
    /*
     *
     *
     * 默认配置，将会合并到各模块中
     */
    'default' => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/object/raw/自定义类名
         */
        'response_type' => 'array',
        /*
         * 使用 ThinkPHP 的缓存系统
         */
        'use_tp_cache' => true,
        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => env('WECHAT_LOG_LEVEL', 'debug'),
            'file' => env('WECHAT_LOG_FILE', runtime_path().'log/wechat.log'),
        ],
    ],

    //公众号
    'official_account' => [
        'default' => [
            // AppID
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'your-app-id'),
            // AppSecret
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'your-app-secret'),
            // Token
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'your-token'),
            // EncodingAESKey
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),
            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
             */
            'oauth' => [
                'scopes' => array_map(
                    'trim',
                    explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))
                ),
                'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
            ],
        ],
    ],

    //第三方开发平台
    // 'open_platform'    => [
    //    'default' => [
    //        'app_id'  => env('WECHAT_OPEN_PLATFORM_APPID', ''),
    //        'secret'  => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
    //        'token'   => env('WECHAT_OPEN_PLATFORM_TOKEN', ''),
    //        'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', ''),
    //    ],
    // ],
    //支付
    'payment' => [
        'default' => [
            'mch_id' => env('WECHAT_PAYMENT_MCH_ID', 'your-mch-id'),
            'certificate' => env('WECHAT_PAYMENT_CERT_PATH', 'path/to/cert/apiclient_cert.pem'),    // XXX: 绝对路径！！！！
            'private_key' => env('WECHAT_PAYMENT_KEY_PATH', 'path/to/cert/apiclient_key.pem'),
            'certificate_serial_no' => '',   // XXX: 绝对路径！！！！
            'http' => [
                'base_uri' => 'https://api.mch.weixin.qq.com/',
            ],
            'secret_key' => env('WECHAT_PAYMENT_KEY', ''),
            'notify_url' => 'http://example.com/payments/wechat-notify',                           // 默认支付结果通知地址
        ],
    ],

    //小程序
    'mini_app' => [
        'default' => [
            'app_id' => env('WECHAT_MINI_APP_APPID', ''),
            'secret' => env('WECHAT_MINI_APP_SECRET', ''),
            'token' => env('WECHAT_MINI_APP_TOKEN', ''),
            'aes_key' => env('WECHAT_MINI_APP_AES_KEY', ''),
        ],
    ],

    //企业微信
    // 'work' => [
    //     'default' => [
    //         'corp_id' => '',
    //         'token' => '',
    //         'aes_key' => '', // 明文模式请勿填写 EncodingAESKey
    //         'ageint_id' => 0,
    //         'secret' => env('WECHAT_WORK_AGENT_CONTACTS_SECRET', ''),
    //     ],
    // ],

    //企业开放平台
    // 'open_work' => [
    //     'default' => [
    //         'corp_id' => 'wx3cf0f39249eb0exx',
    //         'provider_secret' => 'f1c242f4f28f735d4687abb469072axx',
    //         'token' => 'easywechat',
    //         'aes_key' => '', // 明文模式请勿填写 EncodingAESKey
    //     ],
    // ],
];

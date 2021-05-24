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
namespace littler\WeChat\Command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Config extends Command
{
    protected function configure()
    {
        $this->setName('publish:wechat-config')
            ->setDescription('send wechat config to config dir');
    }

    protected function execute(Input $input, Output $output)
    {
        if (file_exists(config_path() . 'wechat.php')) {
            $output->error('file is exist');
            return;
        }
        $fileContent = file_get_contents(dirname(dirname(__FILE__)) . '/config.php');
        file_put_contents(config_path() . 'wechat.php', $fileContent);
        $output->info('send success');
    }
}

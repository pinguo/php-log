<?php
/**
 * Async stores to any stream resource
 *
 * @author camera360_server@camera360.com
 * @copyright Chengdu pinguo Technology Co.,Ltd.
 */
namespace PG\Log\Handler;

use Monolog\Handler\StreamHandler;

class PGStreamHandler extends StreamHandler
{
    /**
     * 写入日志
     *
     * @param array $record
     */
    protected function write(array $record)
    {
        if (null === $this->url || '' === $this->url) {
            throw new \LogicException('Missing stream url, the stream can not be opened. This may be caused by a premature call to close().');
        }

        $writeSuccess = false;
        do {
            if (!(function_exists('getInstance') && is_object(getInstance()->server))) {
                break;
            }

            if (!(property_exists(getInstance()->server, 'taskworker') && (getInstance()->server->taskworker === false))) {
                break;
            }

            if (swoole_async_writefile($this->url, (string)$record['formatted'], null, FILE_APPEND)) {
                $writeSuccess = true;
                break;
            }

            break;
        } while (0);

        if (!$writeSuccess) {
            file_put_contents($this->url, (string)$record['formatted'], FILE_APPEND);
        }
    }

    /**
     * 关闭
     */
    public function close()
    {
    }
}

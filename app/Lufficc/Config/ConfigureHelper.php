<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/4
 * Time: 14:51
 */

namespace Lufficc\Config;


use App\Configuration;
use Illuminate\Http\Request;
use Lufficc\Exception\UnConfigurableException;

trait ConfigureHelper
{
    public function getConfig($key, $defaultValue = null)
    {
        if (!isset($this->configuration) || !isset($this->configuration->config[$key]) || empty($this->configuration->config[$key]))
            return $defaultValue;
        return $this->configuration->config[$key];
    }

    public function getBoolConfig($key, $defaultValue = false)
    {
        $default = $defaultValue ? 'true' : 'false';
        return $this->getConfig($key, $default) == 'true';
    }

    /**
     * @return array
     */
    public abstract function getConfigKeys();

    /**
     * @param Request $request
     * @return boolean
     * @throws UnConfigurableException
     */
    public function saveConfig($request)
    {
        if (!$this->configuration) {
            $configuration = $this->innerSetConfigKeys(new Configuration(), $request);
            $this->configuration()->save($configuration);
        }
        return $this->innerSetConfigKeys($this->configuration, $request)->save();
    }

    /**
     * @param Configuration $configuration
     * @param $request
     * @return Configuration
     */
    private function innerSetConfigKeys(Configuration $configuration, $request)
    {
        $config = $configuration->config;
        foreach ($this->getConfigKeys() as $key) {
            $config[$key] = $request->get($key);
        }
        $configuration->config = $config;
        return $configuration;
    }

}
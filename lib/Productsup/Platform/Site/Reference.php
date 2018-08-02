<?php

namespace Productsup\Platform\Site;

use Productsup\Exceptions\ClientException;

class Reference
{
    const REFERENCE_SITE = 'pup-site';
    const REFERENCE_PROJECT = 'pup-project';

    private $_key;
    private $_value;

    public function __toString()
    {
        if (!$this->_key) {
            throw new ClientException('the key for your reference is missing');
        }
        if (!$this->_value) {
            throw new ClientException('the value for your reference is missing');
        }
        if ($this->_key == self::REFERENCE_SITE) {
            return (string) $this->_value;
        }

        return $this->_key . ':' . $this->_value;
    }

    /**
     * set the value of the reference.
     *
     * @param $key string Reference Key. Allowed chars [a-z0-9_]
     *
     * @throws \Productsup\Exceptions\ClientException
     */
    public function setKey($key)
    {
        if (!$this->isValid($key)) {
            throw new ClientException('invalid key passed');
        }
        $this->_key = $key;
    }

    private function isValid($str)
    {
        return !preg_match('#:#', $str);
    }

    /**
     * set the value of the reference.
     *
     * @param $value string Reference value
     *
     * @throws \Productsup\Exceptions\ClientException
     */
    public function setValue($value)
    {
        if (!$this->isValid($value)) {
            throw new ClientException('invalid value passed');
        }
        $this->_value = $value;
    }

    /**
     * get the defined value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * get the defined key.
     *
     * @return string|null
     */
    public function getKey()
    {
        return $this->_key;
    }
}

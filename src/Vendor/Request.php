<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 20.02.18
 * Time: 00:07
 */

namespace Vendor;

class Request
{
    /** @var string */
    private $requestMethod;

    /** @var string */
    private $url;

    /** @var array */
    private $parameters;

    public function __construct(array $request, array $server)
    {
        $this->setUrl($request['_url']);
        $this->setRequestMethod($server['REQUEST_METHOD']);
        foreach ($request as $key => $value) {
            $this->parameters[$key] = $value;
        }
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter(string $name)
    {
        if (array_key_exists($name, $this->parameters)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function getParameter(string $name, $default = null)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        } else {
            return $default;
        }
    }

    /**
     * @param string $method
     * @return bool
     */
    public function isMethod(string $method)
    {
        if (strtoupper($method) === strtoupper($this->getRequestMethod())) {
            return true;
        } else {
            return false;
        }
    }
}

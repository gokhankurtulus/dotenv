<?php
/**
 * @author Gökhan Kurtuluş @gokhankurtulus
 * Date: 7.07.2023 Time: 02:38
 */


namespace Dotenv;

class Dotenv
{
    protected string $path;

    /**
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->loadEnv();
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function loadEnv(): void
    {
        $realpath = realpath($this->path);
        if ($realpath == false || !is_file($this->path) & !file_exists($this->path)) {
            throw new \Exception('Environment file not found.');
        }

        $contents = file_get_contents($this->path);
        $lines = explode(PHP_EOL, $contents);

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '=') === false) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $_ENV[$this->resolveVariableValue($name)] = $this->resolveVariableValue($value);
        }
    }

    /**
     * @param string $value
     * @return string
     */
    protected function resolveVariableValue(string $value): string
    {
        preg_match_all('/\$\{(.+?)\}/', $value, $matches);

        foreach ($matches[1] as $match) {
            $envValue = $_ENV[$match];
            $value = str_replace('${' . $match . '}', $envValue, $value);
        }

        return $value;
    }

    /**
     * @param array $keys
     * @param bool $raiseError
     * @return false|mixed
     * @throws \Exception
     */
    public function required(array $keys, bool $raiseError = true): mixed
    {
        foreach ($keys as $key) {
            if (!isset($_ENV[$key])) {
                return $raiseError === true ? throw new \Exception("$key is not set on the environment file.") : false;
            }
        }
        return false;
    }
}
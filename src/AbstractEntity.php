<?php

namespace PHPMaker2024\tagihanwifi01;

/**
 * Abstract entity class
 */
abstract class AbstractEntity
{
    public static array $propertyNames;

    /**
     * Get value by column name
     *
     * @param string $name Column name
     * @return mixed
     */
    public function get($name)
    {
        $method = "get" . (static::$propertyNames[$name] ?? $name); // Method name is case-insensitive
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return null;
    }

    /**
     * Set value by column name
     *
     * @param string $name Column name
     * @param mixed $value Value
     * @return static
     */
    public function set($name, $value): static
    {
        $method = "set" . (static::$propertyNames[$name] ?? $name); // Method name is case-insensitive
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
        return $this;
    }

    /**
     * Convert to array with column name as keys
     *
     * @return array
     */
    public function toArray()
    {
        $names = array_keys(static::$propertyNames);
        return array_combine($names, array_map(fn ($name) => $this->get($name), $names));
    }
}

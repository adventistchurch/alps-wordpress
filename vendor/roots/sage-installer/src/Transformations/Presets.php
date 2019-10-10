<?php

namespace Roots\Sage\Installer\Transformations;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Illuminate\Contracts\Support\Arrayable;
use Roots\Sage\Installer\Presets\Preset;

class Presets implements Arrayable, ArrayAccess, IteratorAggregate
{
    /** @var array */
    protected $presets = [];

    /**
     * @param Preset[] $presets Instances of presets to be added
     */
    public function __construct($presets = [])
    {
        array_map([$this, 'register'], $presets);
    }

    /**
     * @param Preset $preset
     * @return static
     */
    public function register(Preset $preset)
    {
        $this->offsetSet($preset->slug, $preset);
        return $this;
    }

    /**
     * @param Preset|string $preset Either Preset intance or slug
     * @return static
     */
    public function unregister($preset)
    {
        $key = $preset instanceof Preset ? $preset->slug : $preset;
        $this->offsetUnset($key);
        return $this;
    }

    /** @return Preset[] */
    public function all()
    {
        return $this->presets;
    }

    /** @return string[] */
    public function slugs()
    {
        return array_keys($this->presets);
    }

    /** @return string[] */
    public function names()
    {
        return array_map(function (Preset $preset) {
            return $preset->name;
        }, array_values($this->presets));
    }

    /** @return string */
    public function __toString()
    {
        return implode(', ', $this->names());
    }

    /** {@inheritdoc} */
    public function toArray()
    {
        return $this->all();
    }

    /** {@inheritdoc} */
    public function offsetExists($key)
    {
        return isset($this->presets[$key]);
    }

    /** {@inheritdoc} */
    public function offsetGet($key)
    {
        return $this->offsetExists($key) ? $this->presets[$key] : false;
    }

    /** {@inheritdoc} */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->presets[] = $value;
        } else {
            $this->presets[$key] = $value;
        }
    }

    /** {@inheritdoc} */
    public function offsetUnset($key)
    {
        unset($this->presets[$key]);
    }

    /** {@inheritdoc} */
    public function getIterator()
    {
        return new ArrayIterator($this->presets);
    }
}

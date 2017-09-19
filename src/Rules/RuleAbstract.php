<?php

namespace Zhangxiangliang\Mooncake\Rules;

use Exception;
use Zhangxiangliang\Mooncake\Contracts\Rule;

class RuleAbstract implements Rule
{
    /**
     * Rule name
     */
    protected $name;

    /**
     * Rule level
     */
    protected $level;

    /**
     * Rule alias
     */
    protected $alias;

    /**
     * Dice Array, Length is Six
     */
    protected $dices;

    /**
     * Validate dices according to rule
     * @return boolen
     */
    public function validate(array $dices)
    {
        if(count($dices) !== 6) {
            throw new Exception("Dices length isn't six");
        }

        return $this->rule($dices);
    }

    /**
     * Get rule name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get rule level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get rule alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Rule
     * @return boolen
     */
    public function rule(array $dices)
    {
        return $this->dices === $dices;
    }
}

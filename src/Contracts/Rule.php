<?php

namespace Zhangxiangliang\Mooncake\Contracts;

interface Rule
{
    /**
     * Validate dices value
     * @param $dices
     * @return boolen
     */
    public function validate(array $dices);

    /**
     * Get rule alias name
     * @return string
     */
    public function getAlias();

    /**
     * Get rule name
     * @return string
     */
    public function getName();

    /**
     * Get rule level
     * @return string
     */
    public function getLevel();

    /**
     * Rule
     * @return boolen
     */
    public function rule(array $dices);
}

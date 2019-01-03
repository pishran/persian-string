<?php

namespace Pishran\PersianString;

class PersianString
{
    /**
     * @var array
     */
    protected $rules = [
        'أ' => 'ا',
        'إ' => 'ا',
        'ك' => 'ک',
        'ؤ' => 'و',
        'ة' => 'ه',
        'ۀ' => 'ه',
        'ي' => 'ی',
        '٠' => '۰',
        '0' => '۰',
        '١' => '۱',
        '1' => '۱',
        '٢' => '۲',
        '2' => '۲',
        '٣' => '۳',
        '3' => '۳',
        '٤' => '۴',
        '4' => '۴',
        '٥' => '۵',
        '5' => '۵',
        '٦' => '۶',
        '6' => '۶',
        '٧' => '۷',
        '7' => '۷',
        '٨' => '۸',
        '8' => '۸',
        '٩' => '۹',
        '9' => '۹',
        ';' => '؛',
        '?' => '؟',
        ',' => '،',
    ];

    /**
     * @var bool
     */
    protected $withEmptyRules = false;

    /**
     * @var array
     */
    protected $activeRules = [];

    /**
     * Create a new PersianString instance.
     *
     * @param bool $withEmptyRules
     */
    public function __construct(bool $withEmptyRules = false)
    {
        $this->withEmptyRules = $withEmptyRules;

        $this->activeRules = $this->withEmptyRules ? [] : $this->rules;
    }

    /**
     * @param string $string
     * @return string
     */
    public function convert(string $string): string
    {
        return strtr($string, $this->getRules());
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->activeRules;
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addRule(string $key, string $value): void
    {
        $this->activeRules[$key] = $value;
    }

    /**
     * @param array $rules
     * @return void
     */
    public function addRules(array $rules): void
    {
        $this->iterateRulesWithAction($rules, [$this, 'addRule']);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function replaceRule(string $key, string $value): void
    {
        if (isset($this->activeRules[$key])) {
            $this->activeRules[$key] = $value;
        }
    }

    /**
     * @param array $rules
     * @return void
     */
    public function replaceRules(array $rules): void
    {
        $this->iterateRulesWithAction($rules, [$this, 'replaceRule']);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function deleteRule(string $key, string $value): void
    {
        if (isset($this->activeRules[$key]) && $this->activeRules[$key] === $value) {
            unset($this->activeRules[$key]);
        }
    }

    /**
     * @param array $rules
     * @return void
     */
    public function deleteRules(array $rules): void
    {
        $this->iterateRulesWithAction($rules, [$this, 'deleteRule']);
    }

    /**
     * @return void
     */
    public function resetRules(): void
    {
        $this->activeRules = $this->withEmptyRules ? [] : $this->rules;
    }

    /**
     * @return void
     */
    public function forceResetRules(): void
    {
        $this->activeRules = $this->rules;
    }

    /**
     * @param array $rules
     * @param callable $callback
     * @return void
     */
    protected function iterateRulesWithAction(array $rules, callable $callback): void
    {
        foreach ($rules as $key => $value) {
            $callback($key, $value);
        }
    }
}

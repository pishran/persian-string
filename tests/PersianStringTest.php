<?php

namespace Pishran\PersianString\Test;

use PHPUnit\Framework\TestCase;
use Pishran\PersianString\PersianString;

class PersianStringTest extends TestCase
{
    /**
     * @test
     */
    public function should_convert()
    {
        $persianString = new PersianString();

        $notConvertedText = 'أإكؤةۀي٠0;?,';
        $expectedText = 'ااکوههی۰۰؛؟،';

        $this->assertEquals($expectedText, $persianString->convert($notConvertedText));
    }

    /**
     * @test
     */
    public function should_not_convert()
    {
        $persianString = new PersianString(true);

        $notConvertedText = 'أإكؤةۀي٠0;?,';
        $expectedText = $notConvertedText;

        $this->assertEquals($expectedText, $persianString->convert($notConvertedText));
    }

    /**
     * @test
     */
    public function should_have_rules()
    {
        $persianString = new PersianString();

        $this->assertNotEmpty($persianString->getRules());
    }

    /**
     * @test
     */
    public function should_not_have_rules()
    {
        $persianString = new PersianString(true);

        $this->assertEmpty($persianString->getRules());
    }

    /**
     * @test
     */
    public function one_rule_should_be_added()
    {
        $persianString = new PersianString();

        $key = 'new-key';
        $value = 'new-value';

        $persianString->addRule($key, $value);

        $rules = $persianString->getRules();

        $this->assertEquals($value, $rules[$key]);
    }

    /**
     * @test
     */
    public function non_existing_rule_should_be_added()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $key = 'new-key';
        $value = 'new-value';

        $persianString->addRule($key, $value);

        $this->assertEquals($count + 1, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function some_rules_should_be_added()
    {
        $persianString = new PersianString();

        $rulesToAdd = [
            'new-key-1' => 'new-value-1',
            'new-key-2' => 'new-value-2',
            'new-key-3' => 'new-value-3',
            'new-key-4' => 'new-value-4',
            'new-key-5' => 'new-value-5',
        ];

        $persianString->addRules($rulesToAdd);

        $rules = $persianString->getRules();

        $this->assertEquals($rulesToAdd['new-key-1'], $rules['new-key-1']);
        $this->assertEquals($rulesToAdd['new-key-2'], $rules['new-key-2']);
        $this->assertEquals($rulesToAdd['new-key-3'], $rules['new-key-3']);
        $this->assertEquals($rulesToAdd['new-key-4'], $rules['new-key-4']);
        $this->assertEquals($rulesToAdd['new-key-5'], $rules['new-key-5']);
    }

    /**
     * @test
     */
    public function non_existing_rules_should_be_added()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $rulesToAdd = [
            'new-key-1' => 'new-value-1',
            'new-key-2' => 'new-value-2',
            'new-key-3' => 'new-value-3',
            'new-key-4' => 'new-value-4',
            'new-key-5' => 'new-value-5',
        ];

        $persianString->addRules($rulesToAdd);

        $this->assertEquals($count + count($rulesToAdd), count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function one_rule_should_be_replaced()
    {
        $persianString = new PersianString();

        $key = 'ك';
        $value = 'new-value';

        $persianString->replaceRule($key, $value);

        $rules = $persianString->getRules();

        $this->assertEquals($value, $rules['ك']);
    }

    /**
     * @test
     */
    public function non_existing_rule_should_not_be_replaced()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $key = 'new-key';
        $value = 'new-value';

        $persianString->replaceRule($key, $value);

        $this->assertEquals($count, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function some_rules_should_be_replaced()
    {
        $persianString = new PersianString();

        $rulesToReplace = [
            'ك' => 'new-value-1',
            'ؤ' => 'new-value-2',
            'ة' => 'new-value-3',
            'ۀ' => 'new-value-4',
            'ي' => 'new-value-5',
        ];

        $persianString->replaceRules($rulesToReplace);

        $rules = $persianString->getRules();

        $this->assertEquals($rulesToReplace['ك'], $rules['ك']);
        $this->assertEquals($rulesToReplace['ؤ'], $rules['ؤ']);
        $this->assertEquals($rulesToReplace['ة'], $rules['ة']);
        $this->assertEquals($rulesToReplace['ۀ'], $rules['ۀ']);
        $this->assertEquals($rulesToReplace['ي'], $rules['ي']);
    }

    /**
     * @test
     */
    public function non_existing_rules_should_not_be_replaced()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $rulesToReplace = [
            'new-key-1' => 'new-value-1',
            'new-key-2' => 'new-value-2',
            'new-key-3' => 'new-value-3',
            'new-key-4' => 'new-value-4',
            'new-key-5' => 'new-value-5',
        ];

        $persianString->replaceRules($rulesToReplace);

        $this->assertEquals($count, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function one_rule_should_be_deleted()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $key = 'ك';
        $value = $rules[$key];

        $persianString->deleteRule($key, $value);

        $this->assertEquals($count - 1, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function non_existing_rule_should_not_be_deleted()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $key = 'new-key';
        $value = 'new-value';

        $persianString->deleteRule($key, $value);

        $this->assertEquals($count, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function some_rules_should_be_deleted()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $rulesToDelete = [
            'ك' => 'ک',
            'ؤ' => 'و',
            'ة' => 'ه',
            'ۀ' => 'ه',
            'ي' => 'ی',
        ];

        $persianString->deleteRules($rulesToDelete);

        $this->assertEquals($count - count($rulesToDelete), count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function non_existing_rules_should_not_be_deleted()
    {
        $persianString = new PersianString();

        $rules = $persianString->getRules();
        $count = count($rules);

        $rulesToDelete = [
            'new-key-1' => 'new-value-1',
            'new-key-2' => 'new-value-2',
            'new-key-3' => 'new-value-3',
            'new-key-4' => 'new-value-4',
            'new-key-5' => 'new-value-5',
        ];

        $persianString->deleteRules($rulesToDelete);

        $this->assertEquals($count, count($persianString->getRules()));
    }

    /**
     * @test
     */
    public function should_have_rules_after_reset()
    {
        $persianString = new PersianString();

        $persianString->resetRules();

        $this->assertNotEmpty($persianString->getRules());
    }

    /**
     * @test
     */
    public function should_not_have_rules_after_reset()
    {
        $persianString = new PersianString(true);

        $persianString->resetRules();

        $this->assertEmpty($persianString->getRules());
    }

    /**
     * @test
     */
    public function should_have_rules_after_force_reset()
    {
        $persianString = new PersianString();

        $persianString->forceResetRules();

        $this->assertNotEmpty($persianString->getRules());
    }

    /**
     * @test
     */
    public function should_have_rules_after_force_reset_with_empty_rules()
    {
        $persianString = new PersianString(true);

        $persianString->forceResetRules();

        $this->assertNotEmpty($persianString->getRules());
    }
}

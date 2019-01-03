# Persian String

تبدیل حروف، اعداد و کاراکترهای عربی، انگلیسی و ... به حروف، اعداد و کاراکترهای فارسی

```php
$persianString = new PersianString();

$persianString->convert('یك متن «تقریبا» فارسي, که شامل برخی حروف، اعداد 1 و ٤ و سایر کاراکترهای غیر فارسی مي باشد');

// یک متن «تقریبا» فارسی، که شامل برخی حروف، اعداد ۱ و ۴ و سایر کاراکترهای غیر فارسی می باشد
```

## روش نصب
برای نصب و استفاده از این پکیج می توانید از کمپوسر استفاده کنید:

`composer require pishran/persian-string`

## مستندات
```php
use Pishran\PersianString\PersianString;

$persianString = new PersianString(bool $withEmptyRules = false)

$persianString->convert(string $string): string

$persianString->getRules(): array

$persianString->addRule(string $key, string $value): void
$persianString->addRules(array $rules): void

$persianString->replaceRule(string $key, string $value): void
$persianString->replaceRules(array $rules): void

$persianString->deleteRule(string $key, string $value): void
$persianString->deleteRules(array $rules): void

$persianString->resetRules(): void
$persianString->forceResetRules(): void
```

<?php

namespace WordStat\Models;

use InvalidArgumentException;

class WorldCalculator
{
    protected $russian_chars = [
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и',
        'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т',
        'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь',
        'э', 'ю', 'я',
    ];

    protected $english_chars = [
        'a', 'b', 'b', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z'
    ];

    protected $text;

    public function __construct(string $text)
    {
        if (!$text) {
            throw new InvalidArgumentException('Invalid arguments');
        }

        $this->text = mb_strtolower($text);
    }

    public function getResult()
    {
        $result = [
            'russian' => [],
            'english' => [],
        ];

        $splitted_text = mb_str_split($this->text);

        foreach ($splitted_text as $char) {
            $language = in_array($char, $this->russian_chars) ? 'russian' : (in_array($char, $this->english_chars) ? 'english' : null);

            if ($language) {
                $result[$language][$char] = $result[$language][$char] ?? 0;
                $result[$language][$char]++;
            }
        }

        foreach (['russian', 'english'] as $language) {
            arsort($result[$language]);
        }

        return $result;
    }
}

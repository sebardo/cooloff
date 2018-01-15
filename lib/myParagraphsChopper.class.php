<?php

class myParagraphsChopper
{
    private $originalString;

    private $paragraphs = array();

    public function __construct($string)
    {
        $this->originalString = $string;

        $this->chopString($string);
    }

    public function getParagraphsCount()
    {
        return count($this->paragraphs);
    }

    public function getParagraphsAsHtml($pCount = 1)
    {
        $html = '';
        foreach ($this->paragraphs as $p) {
            $html .= $p;
            $pCount--;
            if ($pCount == 0) { break; }
        }
        return $html;
    }

    private function chopString($string)
    {
        $this->paragraphs = array('');
        $index = 0;

        $len = strlen($string);
        $pos = 0;

        $state = 'normal';
        $lastName = '';
        $pOpenCount = 0;

        for ($pos = 0; $pos < $len; $pos++) {
            $c = $string[$pos];
            if ($state == 'normal' && $c == '<') {
                $state = 'opening';
                $lastName = '';
                $this->paragraphs[$index] .= $c;
            } elseif ($state == 'opening') {
                if ($c == '/') {
                    $state = 'reading-close-tag';
                    $this->paragraphs[$index] .= $c;
                } else {
                    $state = 'reading-open-tag';
                    $pos--;
                }
            } elseif (($state == 'reading-open-tag' || $state == 'reading-close-tag')
                    && $c == '>') {
                if ($state == 'reading-close-tag') {
                    $state = 'closing-close-tag';
                } else {
                    $state = 'closing-open-tag';
                }
                $this->paragraphs[$index] .= $c;
            } elseif ($state == 'reading-open-tag' || $state == 'reading-close-tag') {
                $lastName .= $c;
                $this->paragraphs[$index] .= $c;
            } elseif ($state == 'closing-open-tag') {
                $state = 'normal';
                $pos--;
                if (strtolower($lastName) == 'p') {
                    $pOpenCount++;
                }
            } elseif ($state == 'closing-close-tag') {
                $state = 'normal';
                $pos--;
                if (strtolower($lastName) == 'p') {
                    $pOpenCount--;
                    if ($pOpenCount == 0) {
                        $this->paragraphs[] = '';
                        $index++;
                    }
                }
            } else {
                $this->paragraphs[$index] .= $c;
            }
        }
    }
}
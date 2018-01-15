<?php

if ($type == 'list')
{
    echo $inscription->getKidsAndUsCenter() ? $inscription->getKidsAndUsCenter()->getName() : '';
}

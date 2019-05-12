<?php

use yii\helpers\Url;

class FormCest
{
    public function ensureThatFormPageWorks(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/form/index'));
        $I->see('Submit');
    }

    public function ensureThatResultPageWorks(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute(['/form/result', 'result' => '25']));
        $I->see('Thank you. Result is 25');
    }
}

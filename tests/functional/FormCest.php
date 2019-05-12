<?php

use yii\helpers\Url;

class FormCest
{
    public function ensureThatFormPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/form/index'));
        $I->see('Submit');
    }

    public function ensureThatResultPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute(['/form/result', 'result' => '25']));
        $I->see('Thank you. Result is 25');
    }
}

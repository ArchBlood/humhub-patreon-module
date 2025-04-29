<?php

use yii\web\View;
use yii\helpers\Url;
use humhub\libs\Html;
use humhub\widgets\PanelMenu;

\humhub\modules\patreon\Assets::register($this);

$this->registerCss('
.patreon-button-container .patreon-widget-button {
    background-color: #f96854;
    border-radius: 9999px;
    color: white;
    padding: 0px 12px;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
    height: 40px;
    min-width: 124px;
}

.patreon-button-container .patreon-widget-button:hover {
    background-color: #e45b47;
    text-decoration: none;
}

.patreon-button-container .patreon-widget-button .fa {
    margin-right: 8px;
}
');

$this->registerJs('
function initPatreonButton() {
    $(".patreon-button-container a").each(function() {
        if (!$(this).hasClass("initialized")) {
            var $button = $(this);
            $button.addClass("patreon-widget-button initialized");
            $button.html(\'' . '<img src="data:image/svg+xml,%3Csvg%20%20xmlns=%22http://www.w3.org/2000/svg%22%20%20width=%2224%22%20%20height=%2224%22%20%20viewBox=%220%200%2024%2024%22%20%20fill=%22none%22%20%20stroke=%22currentColor%22%20%20stroke-width=%222%22%20%20stroke-linecap=%22round%22%20%20stroke-linejoin=%22round%22%20%20class=%22icon%20icon-tabler%20icons-tabler-outline%20icon-tabler-brand-patreon%22%3E%3Cpath%20stroke=%22none%22%20d=%22M0%200h24v24H0z%22%20fill=%22none%22/%3E%3Cpath%20d=%22M20%208.408c-.003%20-2.299%20-1.746%20-4.182%20-3.79%20-4.862c-2.54%20-.844%20-5.888%20-.722%20-8.312%20.453c-2.939%201.425%20-3.862%204.545%20-3.896%207.656c-.028%202.559%20.22%209.297%203.92%209.345c2.75%20.036%203.159%20-3.603%204.43%20-5.356c.906%20-1.247%202.071%20-1.599%203.506%20-1.963c2.465%20-.627%204.146%20-2.626%204.142%20-5.273z%22%20/%3E%3C/svg%3E"></img>' . ' \' + $button.text());
        }
    });
}

// Initialize on first load
initPatreonButton();

// Initialize after pjax refreshes
$(document).on("pjax:success", function() {
    initPatreonButton();
});
', View::POS_READY);
?>

<div class="panel panel-default" id="panel-patreon">
    <div class="panel-heading">
        <?= PanelMenu::widget(['id' => 'panel-patreon']); ?>
        <strong><?= Yii::t('PatreonModule.base', 'Patreon'); ?></strong>
    </div>
    <div class="panel-body">
        <?= Html::beginTag('div', ['class' => 'patreon-button-container']) ?>
            <a href="<?= $patreonUrl; ?>" target="_blank" rel="noopener" class="patreon-button">Become a Patron!</a>
        <?= Html::endTag('div'); ?>
    </div>
</div>

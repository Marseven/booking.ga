<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<!--h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
</p-->

<!-- Error Page --> 
<section class="error-page ptb-100">
    <div class="d-table">
        <div class="d-tablecell">
            <div class="container">
                <div class="error-item-wrapper text-center">
                    <div class="single-error">
                        <h1>404</h1>
                        <h4>Oops, <span>La Page demandée n'existe pas !</span></h4>
                        <p><strong><?= $url ?></strong> inexistante.</p>
                    </div>
                    <div class="custom-button">
                    <a href="javascript:history.back()" class="btn">Retour <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Error Page -->
<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

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
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<!--h2><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= h($message) ?>
</p-->

<!-- Error Page --> 
<section class="error-page ptb-100">
    <div class="d-table">
        <div class="d-tablecell">
            <div class="container">
                <div class="error-item-wrapper text-center">
                    <div class="single-error">
                        <h1>500</h1>
                        <h4>Oops, <span>Erreur Système !</span></span></h4>
                        <p><?= h($message) ?></p>
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
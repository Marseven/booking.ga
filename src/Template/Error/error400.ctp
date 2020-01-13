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

<!--Page Header-->
<section class="page-header page_404">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Erreur 404</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
                <li>Erreur 404</li>
            </ul>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Error-404-->
<section class="error_404 section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-5">
                <div class="error_text_m">
                    <h2>4<span>0</span>4</h2>
                    <div class="background_icon"><i class="fa fa-road" aria-hidden="true"></i></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-7">
                <div class="not_found_msg">
                    <div class="error_icon"> <i class="fa fa-smile-o" aria-hidden="true"></i> </div>
                    <div class="error_msg_div">
                        <h3>Oops, <span>La Page demandée n'existe pas !</span></h3>
                        <p><strong><?= $url ?></strong> inexistante.</p>
                        <a href="javascript:history.back()" class="btn">Retour <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
                    <?php //$this->Html->link(__('Back'), 'javascript:history.back()') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Error-404-->


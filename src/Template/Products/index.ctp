<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <?= $this->element('sidebar_shop') ?>
        </div>
        <div class="col-sm-9">
            <div class="row">
                <?= $this->element('shop') ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <nav>
                        <ul class="pagination">
                            <?= $this->Paginator->prev('<') ?>
                            <?= $this->Paginator->next('>') ?>
                        </ul>
                        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-wrapper">
    <nav class="side-nav">
        <ul>
        <li><?= $this->Html->link(__('Sample import file'), $this->Html->webroot . '/files/histories_csv-import.xlsx') ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
    <div class="row">
        <h1><?= __('Histories Import') ?></h1>
        <div class="imports index large-10 medium-9 columns">
            <?php
            echo $this->Form->create(null, ['type' => 'file']);
            echo $this->Form->input('file', ['type' => 'file']);
            echo $this->Form->submit();
            echo $this->Form->end();
            ?>
        </div>
    </div>
 </div>
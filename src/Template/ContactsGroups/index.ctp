<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Contacts Group'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsGroups index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('group_id') ?></th>
                        <th><?= $this->Paginator->sort('contact_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactsGroups as $contactsGroup) : ?>
                    <tr>
                        <td>
                            <?= $contactsGroup->has('group') ? $this->Html->link($contactsGroup->group->name, ['controller' => 'Groups', 'action' => 'view', $contactsGroup->group->id]) : '' ?>
                        </td>
                        <td>
                            <?= $contactsGroup->has('contact') ? $this->Html->link($contactsGroup->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsGroup->contact->id]) : '' ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $contactsGroup->group_id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactsGroup->group_id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsGroup->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsGroup->group_id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>
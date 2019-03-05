<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Usergroup'), ['action' => 'add']) ?></li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <h3><?= __('My usergroups') ?></h3>
        <div class="usergroups index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Admin User') ?></th>
                    <th><?= __('Members') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ownedBy as $usergroup): ?>
                    <tr>
                        <td><?= h($usergroup->name) ?></td>
                        <td>
                            <?php
                            print '<span class="label viewable">' .
                                $this->request->session()->read('Auth.User.name') .
                                '</span>';
                            ?>
                        </td>
                        <td>
                            <?php
                            print '<table>';
                            print $this->Html->tableHeaders(
                                [null, __('User'), __('Contacts'), __('Histories')]
                            );
                            foreach ($usergroup->users as $user) {

                                $usr = '<span class="label ';
                                if ($user->_joinData->joined) {
                                    $usr .= 'viewable"';
                                } else {
                                    $usr .= 'shared"';
                                }
                                $usr .= '>' . $user->realname . '</span>';
                                $link = $this->Html->link(
                                        '➤',
                                        [
                                            'controller' => 'Users',
                                            'action' => 'view', $user->id
                                        ]
                                    );

                                print $this->Html->tableCells(
                                    [
                                        [
                                            $link,
                                            $usr,
                                            (isset($totalsByUsers[$user->id]) && $totalsByUsers[$user->id]->total_contacts > 0)
                                                ? [$totalsByUsers[$user->id]->total_contacts, ['class' => 'c']]
                                                : ['-', ['class' => 'c']],
                                            (isset($totalsByUsers[$user->id]) && $totalsByUsers[$user->id]->total_histories > 0)
                                                ? [$totalsByUsers[$user->id]->total_histories, ['class' => 'c']]
                                                : ['-', ['class' => 'c']]
                                        ],
                                    ]
                                );
                            }
                            print '</table>';
                            ?>
                        </td>
                        <td class="actions">
                            <?= __('Actions') ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usergroup->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                [
                                    'action' => 'delete',
                                    $usergroup->id
                                ],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $usergroup->id)]
                            ) ?>
                            <?= __('Filter') ?>
                            <?=
                            $this->Html->link(
                                __('Total'),
                                ['action' => 'index'],
                                !isset($this->request->getParam('pass')[0])
                                    ? ['class' => 'active'] : []
                            )
                            ?>
                            <?=
                            $this->Html->link(
                                __('Month'),
                                ['action' => 'index', 'month'],
                                (isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == 'month')
                                    ? ['class' => 'active'] : []
                            )
                            ?>
                            <?=
                            $this->Html->link(
                                __('Week'),
                                ['action' => 'index', 'week'],
                                (isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == 'week')
                                    ? ['class' => 'active'] : []
                            )
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <h3><?= __('My memberships') ?></h3>
        <div class="usergroups index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Admin User') ?></th>
                    <th><?= __('Members') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($memberships as $usergroup): ?>
                    <tr>
                        <td><?= h($usergroup->name) ?></td>
                        <td>
                            <?php
                            print '<span class="label shared">' .
                                $usergroup->admin_user->name .
                                '</span>';
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($usergroup->users as $user) {

                                $usr = '<span class="label ';
                                if ($user->id == $this->request->session()->read('Auth.User.id')) {
                                    $usr .= 'viewable"';
                                } else {
                                    $usr .= 'shared"';
                                }
                                $usr .= '>' . $user->realname . '</span>';
                                print $usr;
                            }
                            ?>
                        </td>
                        <td class="actions">
                            <?php if ($usergroup->admin_user->id == $this->request->session()->read('Auth.User.id')) : ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usergroup->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                [
                                    'action' => 'delete',
                                    $usergroup->id
                                ],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $usergroup->id)]
                            ) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

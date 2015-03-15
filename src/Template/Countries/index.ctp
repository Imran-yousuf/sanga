<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="countries index large-10 medium-9 columns">
			<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id') ?></th>
					<th><?= $this->Paginator->sort('name') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($countries as $country): ?>
				<tr>
					<td><?= $this->Number->format($country->id) ?></td>
					<td><?= h($country->name) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $country->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
			<div class="paginator">
				<ul class="pagination">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'));
					echo $this->Paginator->numbers();
					echo $this->Paginator->next(__('next') . ' >');
				?>
				</ul>
				<p><?= $this->Paginator->counter() ?></p>
			</div>
		</div>
	</div>
</div>
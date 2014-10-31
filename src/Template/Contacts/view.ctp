<?php
$this->Html->scriptStart(['block' => true]);
?>
$(function() {
	$( "#tabs" ).tabs({active : 0}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});
<?php
$this->Html->scriptEnd();
?>
<div id="tabs" class="row">
	<div class="actions columns large-2 medium-3">
		<h3><?= __('Actions') ?></h3>
		<ul class="side-nav">
			<li><a href="#tabs-1">Személyi adatok</a></li>
			<li><a href="#tabs-2"><?= __('Workplace and skills') ?></a></li>
			<li><a href="#tabs-3">Történések</a></li>
			<li><a href="#tabs-4"><?= __('Groups') ?></a></li>
		</ul>
	</div>
	<div id="tabs-1" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-info fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Name') ?></h6>
				<p>&nbsp;<?= h($contact->name) ?></p>
				<h6 class="subheader"><?= __('Contactname') ?></h6>
				<p>&nbsp;<?= h($contact->contactname) ?></p>
				<h6 class="subheader"><?= __('Contact person') ?></h6>
				<?php if (!empty($contact->users)): ?>
					<p>
					<?php foreach ($contact->users as $users): ?>
						&nbsp;<?= h($users->name) ?>
					<?php endforeach; ?>
					</p>
				<?php endif; ?>
				<h6 class="subheader"><?= __('Address') ?></h6>
				<p>
					&nbsp;<?= $contact->has('zip') ? $this->Html->link($contact->zip->zip . ' ' . $contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?>
					&nbsp;<?= h($contact->address) ?>
				</p>
				<h6 class="subheader"><?= __('Phone') ?></h6>
				<p>&nbsp;<?= h($contact->phone) ?></p>
				<h6 class="subheader"><?= __('Email') ?></h6>
				<p>&nbsp;<?= h($contact->email) ?></p>
				<h6 class="subheader"><?= __('Birth') ?></h6>
				<p>&nbsp;
					<?php
					if($contact->birth){
						print h($contact->birth->format('Y-m-d'));
					}
					?>
				</p>
				<h6 class="subheader"><?= __('Sex') ?></h6>
				<p>&nbsp;
					<?php
					if($contact->sex == 1){
						print __('Male');
					}
					else if($contact->sex == 2){
						print __('Female');
					}
					else{
						print __('Unknown');
					}
					?>
				</p>
				<h6 class="subheader"><?= __('Family Id') ?></h6>
				<p><?= $this->Number->format($contact->family_id) ?></p>
				<h6 class="subheader"><?= __('Contactsource') ?></h6>
				<p>&nbsp;<?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?></p>
				<h6 class="subheader"><?= __('Active') ?></h6>
				<p>&nbsp;<?= $contact->active ? __('Yes') : __('No'); ?></p>
				<h6 class="subheader"><?= __('Comment') ?></h6>
				<?= $this->Text->autoParagraph(h($contact->comment)); ?>
			</div>
			<div id="mapsmall"></div>
				<?php
				if($contact->lat):
					$this->Html->scriptStart(['block' => true]);
					?>
					$(function(){
						$("#mapsmall").gmap3({
						  map:{
							options: {
							  center:[<?= $contact->lat ?>,<?= $contact->lng ?>],
							  zoom: 8,
							  mapTypeId: google.maps.MapTypeId.TERRAIN
							}
						  },
						 marker:{
							latLng:[<?= $contact->lat ?>,<?= $contact->lng ?>]
						 }
						});
					});
					<?php
					$this->Html->scriptEnd();
				endif;
				?>
		</div>
	</div>
	<div id="tabs-2" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-info fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Workplace') ?></h6>
				<p>&nbsp;<?= h($contact->workplace) ?></p>
				<h6 class="subheader"><?= __('Skills') ?></h6>
				<?php if (!empty($contact->skills)): ?>
					<p>
					<?php foreach ($contact->skills as $skills): ?>
						<span class="tag tag-success">
							<?php print h($skills->name); ?>
						</span>
					<?php endforeach; ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="tabs-3" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-info fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
		<?php if (!empty($histories)): ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?= $this->Paginator->sort('date') ?></th>
				<th><?= $this->Paginator->sort('User.name') ?></th>
				<th><?= $this->Paginator->sort('Group.name') ?></th>
				<th><?= $this->Paginator->sort('Event.name') ?></th>
				<th><?= $this->Paginator->sort('detail') ?></th>
				<th><?= $this->Paginator->sort('quantity') ?></th>
				<th><?= $this->Paginator->sort('family_id') ?></th>
			</tr>
			<?php foreach ($histories as $history): ?>
			<tr>
				<td><?php print $history->date->format('Y-m-d'); ?></td>
				<td>
					<?php
					if(isset($history->user->name)){
						print $history->user->name;
					}
					?>
				</td>
				<td>
					<?php
					if($history->group){
						print $history->group->name;
					}
					?>
				</td>
				<td><?= h($history->event->name) ?></td>
				<td><?= h($history->detail) ?></td>
				<td class="r">
					<?php
						if(isset($history->unit->name)){
							print h($this->Number->currency($history->quantity, $history->unit->name));
						}
						else{
							print h($history->quantity);
						}
					?>
				</td>
				<td><?= h($history->family_id) ?></td>
			</tr>
			<?php endforeach; ?>
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
		<?php endif; ?>
		</div>
	</div>
	<div id="tabs-4" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-info fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
			<?php if (!empty($contact->groups)): ?>
				<?php
				foreach ($contact->groups as $groups):
					$cssStyle = ($groups->admin_user_id) ? "info" : "success";
				?>
					<span class="tag tag-<?= $cssStyle ?>"><?= h($groups->name) ?></span>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
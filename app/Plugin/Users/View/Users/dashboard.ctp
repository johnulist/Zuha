<div class="users dashboard row">
    <div class="col-md-8 ">
        <table>
            <thead><th>Name</th><th>Date Registered</th><th>Role</th><th>Actions</th></thead>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $this->Html->link($user['User']['full_name'], array('action' => 'view', $user['User']['id'])); ?></td>
                    <td><?php echo ZuhaInflector::datify($user['User']['created']); ?></td>
                    <td><?php echo $user['UserRole']['name']; ?></td>
                    <td>
                        <a class="btn btn-success btn-xs" href="<?php echo $this->Html->url(array('admin' => false, 'action' => 'view', $user['User']['id'])); ?>">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                            View
                        </a>
                        <a class="btn btn-info btn-xs" href="<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>">
                            <i class="glyphicon glyphicon-edit"></i>
                            Edit
                        </a>
						<?php echo $this->Html->link(
								'<i class="glyphicon glyphicon-trash"></i> Delete',
								array('action' => 'delete', $user['User']['id']),
								array('class' => 'btn btn-danger btn-xs', 'escape' => false),
								sprintf('Are you sure you want to delete %s?', $user['User']['full_name'])
						); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->element('paging'); ?>
    </div>

    <div class="col-md-4">
        <h3>Quick Links</h3>
        <div class="list-group">
        	<?php foreach ($userRoles as $userRoleId => $userRole) : ?>
            	<?php echo $this->Html->link(__('Add %s', Inflector::humanize(Inflector::singularize($userRole))), array('action' => 'procreate', $userRoleId), array('class' => 'list-group-item')); ?>
            <?php endforeach; ?>
            <?php echo $this->Html->link('Manage User Roles', array('controller' => 'user_roles', 'action' => 'index'), array('class' => 'list-group-item')); ?>
        </div>
    </div>
</div>
<?php 
// set contextual search options
$this->set('forms_search', array(
    'url' => '/admin/users/users/dashboard/',
	'inputs' => array(
		array(
			'name' => 'contains:full_name',
			'options' => array(
				'label' => false, 
				'placeholder' => 'Search by Name',
				'value' => !empty($this->request->params['named']['contains']) ? substr($this->request->params['named']['contains'], strpos($this->request->params['named']['contains'], ':') + 1) : null,
				)
			),
		/*array(
			'name' => 'contains:email',
			'options' => array(
				'label' => false,
				'placeholder' => 'Search by Email',
				'value' => !empty($this->request->params['named']['contains']) ? substr($this->request->params['named']['contains'], strpos($this->request->params['named']['contains'], ':') + 1) : null,
				)
			)*/
		)
	));

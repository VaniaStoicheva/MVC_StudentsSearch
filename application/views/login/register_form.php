<?php
$user_name = array(
    'name' => 'user_name',
    'id' => 'user_name',
    'value' => set_value('user_name')
);
$user_password = array(
    'name' => 'user_password',
    'id' => 'user_password'
);
$passconf = array(
    'name' => 'passconf',
    'id' => 'password'
);
$user_fname = array(
    'name' => 'user_fname',
    'id' => 'user_fname',
    'value' => set_value('user_fname')
);
$user_lname = array(
    'name' => 'user_lname',
    'id' => 'user_lname',
    'value' => set_value('user_lname')
);
$user_email = array(
    'name' => 'user_email',
    'id' => 'user_email',
    'value' => set_value('user_email')
);
?>

<?= form_open('login/validate_register'); ?>
<?= form_fieldset('Register new user'); ?>
<dl>
    <dt><?= form_label('Username', $user_name['name']); ?></dt>
    <dd>
        <?= form_input($user_name['name']); ?>
<?= form_error('user_name'); ?>
    </dd>

    <dt><?= form_label('Password', $user_password['name']); ?></dt>
    <dd>
        <?= form_password($user_password['name']); ?>
<?= form_error('user_password'); ?>
    </dd>

    <dt><?= form_label('Confirm password', $passconf['name']); ?></dt>
    <dd>
        <?= form_password($passconf['name']); ?>
<?= form_error('password'); ?>
    </dd>

    <dt><?= form_label('First name', $user_fname['name']); ?></dt>
    <dd>
        <?= form_input($user_fname['name']); ?>
<?= form_error('user_fname'); ?>
    </dd>

    <dt><?= form_label('Last name', $user_lname['name']); ?></dt>
    <dd>
        <?= form_input($user_lname['name']); ?>
<?= form_error('user_lname'); ?>
    </dd>

    <dt><?= form_label('E-mail address', $user_email['name']); ?></dt>
    <dd>
        <?= form_input($user_email['name']); ?>
<?= form_error('user_email'); ?>
    </dd>

    <dt></dt>
    <dd><?= form_submit('submit', 'Make my account'); ?></dd>
</dl>


<?= form_fieldset_close(); ?>
<?= form_close(); ?>
<?= anchor('login/index', 'Login'); ?>

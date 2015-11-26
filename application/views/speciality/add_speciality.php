<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?>
    <?= form_open(); ?>
    <?= "Въведете име на нова специалност:"; ?>
    <?= form_input('long_name') . "<br/>"; ?>
    <?= form_error('long_name'); ?>
    <?= "Въведете абревиатура на новата специалност:"; ?>
    <?= form_input('short_name') . "<br/>"; ?>
    <?= form_error('short_name'); ?>
    <br/>
    <?= form_submit('add', 'Добавете специалност'); ?>
    <?= form_submit('cancel', 'Отказ'); ?>
    <?= form_submit('update', 'Обнови'); ?>
    <?= form_close(); ?>
<p><?= anchor('Speciality', 'Изход'); ?></p>
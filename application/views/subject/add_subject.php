<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?>
    <?= form_open(); ?>
    <?= "Въведете име на нов предмет:"; ?>
    <?= form_input('subject_name') . "<br/>"; ?>
    <?= form_error('subjec_name'); ?>
    <?= "Въведете хорариум часове за лекции:"; ?>
    <?= form_input('lectures') . "<br/>"; ?>
    <?= form_error('lectures'); ?>
    <?= "Въведете хорариум часове за упражнения:"; ?>
    <?= form_input('exercises') . "<br/>"; ?>
    <?= form_error('exercises'); ?>
    <br/>
    <?= form_submit('add', 'Добавете предмет'); ?>
    <?= form_submit('cancel', 'Отказ'); ?>
    <?= form_submit('update', 'Обнови'); ?>
    <?= form_close(); ?>
<p><?= anchor('Subject', 'Изход'); ?></p>
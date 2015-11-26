<p>Здравей:<b><?php echo $this->session->userdata('user_name'); ?></b></p>
<?= form_open(); ?>
<?= form_fieldset(); ?>
<?= form_submit('search', 'търсене'); ?>
<?= form_submit('specialities', 'специалности'); ?>
<?= form_submit('subject', 'предмети'); ?>
<?= form_submit('students', 'студенти'); ?>
<?= form_submit('course', 'курсове'); ?>
<?= form_submit('assesments', 'оценки'); ?>
<?= form_fieldset_close(); ?>
<?= form_close(); ?>

<p><?php echo anchor('login/logout', 'Изход'); ?></p>

<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?>
    <?= form_open(); ?>
    <?= "Изберете име на студент:"; ?>
    <?php
    foreach ($students as $student):
        $options[$student['student_id']] = $student['student_id'] . ' ' . $student['student_fname'] . ' ' . $student['student_lname'];
    endforeach;
    ?>
    <?= form_dropdown('student', $options) . "<br/>"; ?>

    <?= "Изберете предмет:"; ?>
    <?php
    foreach ($subjects as $subject):
        $option[$subject['subject_id']] = $subject['subject_id'] . ' ' . $subject['subject_name'];
    endforeach;
    ?>
    <?= form_dropdown('subject', $option) . "<br/>"; ?>

    <?= "Променете хорариум реално посетени лекции:"; ?>
    <?= form_input('lectures') . "<br/>"; ?>
    <?= form_error('lectures'); ?>
    <?= "Променете хорариум реално посетени упражнения:"; ?>
    <?= form_input('exercises') . "<br/>"; ?>
    <?= form_error('exercises'); ?>
    <?= "Въведете оценка:"; ?>
    <?= form_input('assesment') . "<br/>"; ?>
    <?= form_error('assesment'); ?>
    <br/>
<?= form_submit('edit', 'Променете хорариуми и оценка'); ?>
<?= form_submit('cancel', 'Отказ'); ?>
<?= form_submit('update', 'Обнови'); ?>
<?= form_close(); ?>
<p><?= anchor('Assesment', 'Изход'); ?></p>
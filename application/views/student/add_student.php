<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?>
    <?= form_open(); ?>
    <?= "Въведете собствено име на студент:"; ?>
    <?= form_input('student_fname') . "<br/>"; ?>
    <?= form_error('student_fname'); ?>
    <?= "Въведете фамилия на студент:"; ?>
    <?= form_input('student_lname') . "<br/>"; ?>
    <?= form_error('student_lname'); ?>
    <?= "Въведете email на студент:"; ?>
    <?= form_input('email') . "<br/>"; ?>
    <?= form_error('email'); ?>
    <?= "Въведете факултетен номер:"; ?>
    <?= form_input('fnumber') . "<br/>"; ?>
    <?= form_error('fnumber'); ?>
    <?= "Изберете курс:"; ?>
    <?php
    foreach ($courses as $course):
        $options[$course['course_id']] = $course['course_name'];
    endforeach;
    ?>
    <?= form_dropdown('course', $options) . "<br/>"; ?>

    <?= "Изберете специалност:"; ?>
    <?php
    foreach ($specialities as $speciality):
        $options[$speciality['speciality_id']] = $speciality['speciality_name_long'];
    endforeach;
    ?>
    <?= form_dropdown('speciality', $options); ?><br/>

    <?= "Изберете форма на обучение:"; ?><br/>
    <?= form_checkbox('education', 'Р') . "редовно обучение"; ?><br/>
    <?= form_checkbox('education', 'З') . "задочно обучение"; ?><br>
    <br/>
    <?= form_submit('add', 'Добавете студент'); ?>
<?= form_submit('cancel', 'Отказ'); ?>
<?= form_submit('update', 'Обнови'); ?>
<?= form_close(); ?>
<p><?= anchor('Subject', 'Изход'); ?></p>

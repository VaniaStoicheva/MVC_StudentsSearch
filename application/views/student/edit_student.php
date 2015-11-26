<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?>
    <?= form_open(); ?>
    <?php foreach ($students as $student):;?>
    <?= "име на студент:"; ?>
    <?= form_input('student_fname',$student['student_fname']) . "<br/>"; ?>
    <?= form_error('student_fname'); ?>
    <?= "фамилия на студент:"; ?>
    <?= form_input('student_lname',$student['student_lname']) . "<br/>"; ?>
    <?= form_error('student_lname'); ?>
    <?= "email на студент:"; ?>
    <?= form_input('email',$student['student_email']) . "<br/>"; ?>
    <?= form_error('email'); ?>
    <?= "факултетен номер:"; ?>
    <?= form_input('fnumber',$student['student_fnumber']) . "<br/>"; ?>
    <?= form_error('fnumber'); ?>
    <?php endforeach;?>
    <?= "Изберете курс:"; ?>
    <?php foreach ($courses as $course):
        $options[$course['course_id']]=$course['course_name'];
            endforeach;
     ?>
    <?= form_dropdown('course',$options) . "<br/>"; ?>
    
    <?= "Изберете специалност:"; ?>
    <?php foreach ($specialities as $speciality):
        $options[$speciality['speciality_id']]=$speciality['speciality_name_long'];
    endforeach;?>
    <?= form_dropdown('speciality',$options) ; ?><br/>
    
    <?= "Изберете форма на обучение:"; ?><br/>
    <?=  form_checkbox('education','Р') . "редовно обучение"; ?><br/>
    <?=  form_checkbox('education','З')."задочно обучение"; ?><br>
    <br/>
    <?= form_submit('submit', 'Променете данните за студент'); ?>
   <?= form_submit('cancel', 'Отказ'); ?>
  <?= form_close(); ?>
      
<p><?= anchor('Student/display', 'Обнови'); ?></p>
<p><?= anchor('Student', 'Изход'); ?></p>

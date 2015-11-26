<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?></p>
<? header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Student</title>
    </head>
    <body>

        <?php //echo $pagination; ?>
        <div>
            <table border="1">

                <thead>
                    <tr>
                         <th>

                            <?=
                            anchor(site_url('Student/display/student_id/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'номер');
                            ?>
                        </th>
                        <th>

                            <?=
                            anchor(site_url('Student/display/student_fnumber/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'факултетен номер');
                            ?>
                        </th>
                        <th>

                            <?=
                            anchor(site_url('Student/display/student_fname/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'име и фамилия на студент');
                            ?>
                        </th>
                        <th>email</th>
                        <th>курс</th>
                        <th>специалност</th>
                        <th>форма на обучение</th>
                        <th colspan="2">опции</th>

                    </tr>
                </thead>

                <tbody>


                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student['student_id']; ?></td>
                            <td><?= $student['student_fnumber']; ?></td>
                            <td><?= $student['student_fname'].' '.$student['student_lname']; ?></td>
                            <td><?= $student['student_email']; ?></td>
                            <td><?= $student['course_name']; ?></td>
                            <td><?= $student['speciality_name_long']; ?></td>
                            <td><?= $student['student_education_form']; ?></td>
                            <td><?= anchor(site_url('Student/edit/') . '/' . "$student[student_id]", 'промени'); ?></td>
                            <td><?=anchor(site_url('Student/delete/') . '/' . "$student[student_id]", 'изтрии', array('class' => 'delete', 'onclick' => "return confirm('Сигурни ли сте че искате да изтриете  $student[student_id]?')"));
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php echo $pagination; ?>
        </div>
        <p><?= anchor('Student/add', 'Добавете студент'); ?></p>
        <p><?= anchor('Student/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>





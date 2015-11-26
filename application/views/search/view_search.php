<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Table</title>
    </head>
    <body>
        <!--форма за търсене-->
        <?= form_open(); ?>
        <?= form_fieldset('Търсене'); ?>
        <?= "<p><b>Въведете име на студент:</b>"; ?>
        <?= form_input('student_name'); ?>
        <br/>
        <?= "<p><b>Специалност:</b>"; ?>
        <?php
        foreach ($specialities as $speciality):
            $options[$speciality['speciality_id']] = $speciality['speciality_name_long'];
        endforeach;
        ?>
        <?= form_dropdown('speciality', $options); ?>
        <br/>

        <?= "<p><b>Курс:</b>"; ?>
        <?php
        foreach ($course as $courses) :
            $options[$courses['course_id']] = $courses['course_name'];
        endforeach;
        ?>
        <?= form_dropdown('courses', $options); ?>
        <br/>

        <?= form_submit('submit', 'Tърси студент!'); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>
        <!--таблица с резултати-->
        <table border="1">
            <thead>
                <tr>
                    <th colspan="3"></th><th colspan="12">Предмети (хорариум и оценки)</th>
                </tr>
                <tr>
                    <th colspan="3"></th><th colspan="3">Математика</th><th colspan="3">Информатика</th><th colspan="3">Физика</th><th colspan="3"></th>
                </tr>
                <tr>
                    <th>
                        <?=
                        anchor(site_url('Search/display/student_id/') . '/'
                                . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'номер');
                        ?></th>
                    <th><?=
                        anchor(site_url('Search/display/student_lname/') . '/'
                                . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'Име,Фамилия');
                        ?>
                    </th><th>Курс</th>
                    <th>Лекции</th><th>Упражнения</th><th>Оценки</th>
                    <th>Лекции</th><th>Упражнения</th><th>Оценки</th>
                    <th>Лекции</th><th>Упражнения</th><th>Оценки</th>
                    <th> хорариум лекции</th>
                    <th>хорариум упражнения</th>
                    <th>среден успех</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($students as $student):;
                    $student['name'] = $student['student_fname'] . ' ' . $student['student_lname'];
                    $student['course'] = $student['course_name'] . ' ' . $student['speciality_name_short'];

                    $student['lectures_all'] = explode(',', $student['lectures']);
                    $student['exercises_all'] = explode(',', $student['exercises']);
                    list($student['sa_assesment_math'], $student['sa_assesment_info'], $student['sa_assesment_phys']) = explode(',', $student['sa_assesment']);
                    $ocenki = array(
                        2 => 'Слаб (2)',
                        3 => 'Среден (3)',
                        4 => 'Добър (4)',
                        5 => 'Мн. добър (5)',
                        6 => 'Отличен(6)',
                    );
                    if ($student['assesment'] != '0.0000') {

                        $totalGrade = explode('.', $student['assesment']);
                        $totalGrade[1] = round('0.' . $totalGrade[1], 2);

                        $grade = $totalGrade[0];

                        if ($totalGrade[1] >= 0.50) {
                            $totalGrade[0] ++;
                            $grade = str_replace($totalGrade[0], $grade + $totalGrade[1], $ocenki[$totalGrade[0]]);
                        } else {
                            $grade = str_replace($totalGrade[0], $grade + $totalGrade[1], $ocenki[$totalGrade[0]]);
                        }
                    } else {
                        $grade = '-';
                    }
                    ?>
                    <tr>
                        <td><?= $student['student_id']; ?></td>
                        <td><?= $student['name']; ?></td>
                        <td><?= $student['course']; ?></td>

                        <td><?= $student['lectures_all'][0]; ?></td>
                        <td><?= $student['exercises_all'][0]; ?></td>
                        <td><?= $ocenki[$student['sa_assesment_math']]; ?></td>

                        <td><?= $student['lectures_all'][1]; ?></td>
                        <td><?= $student['exercises_all'][1]; ?></td>
                        <td><?= $ocenki[$student['sa_assesment_info']]; ?></td>

                        <td><?= $student['lectures_all'][2]; ?></td>
                        <td><?= $student['exercises_all'][2]; ?></td>
                        <td><?= $ocenki[$student['sa_assesment_phys']]; ?></td>

                        <td><?php echo $student['sum(subject_workload_lectures)'] . '(' . $student['sum(sa_workload_lectures)'], ')'; ?></td>
                        <td><?php echo $student['sum(subject_workload_exercises)'] . '(' . $student['sum(sa_workload_exercises)'], ')'; ?></td>
                        <td><?php echo $grade; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <?php echo $pagination; ?>
        </div>
        <p><?= anchor('Search/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>

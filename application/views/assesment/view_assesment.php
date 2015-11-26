<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?></p>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Assessments</title>
    </head>
    <body>

        <?php //echo $pagination; ?>
        <div>
            <table border="1">

                <thead>
                    <tr>
                        <th>

                            <?=
                            anchor(site_url('Assesment/display/sa_student_id/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'номер');
                            ?>
                        </th>
                        <th>име на студент</th>
                        <th>Предмет</th>
                        <th>Хорариум реално посетени лекции</th>
                        <th>Хорариум реално посетени упражнения</th>
                        <th>Оценка</th>
                        <th colspan="2">опции</th>

                    </tr>
                </thead>

                <tbody>


                    <?php foreach ($assesments as $assesment): ?>
                        <tr>
                            <td><?= $assesment['sa_student_id']; ?></td>
                            <td><?= $assesment['student_fname'] . ' ' . $assesment['student_lname']; ?></td>
                            <td><?= $assesment['subject_name']; ?></td>
                            <td><?= $assesment['sa_workload_lectures']; ?></td>
                            <td><?= $assesment['sa_workload_exercises']; ?></td>
                            <td><?= $assesment['sa_assesment']; ?></td>
                            <td><?= anchor(site_url('Assesment/edit/') . '/' . "$assesment[student_id]" . '/' . "$assesment[subject_id]", 'промени'); ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php echo $pagination; ?>
        </div>

        <p><?= anchor('Assesment/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>





<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?></p>
<? header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Subjects</title>
    </head>
    <body>

        <?php //echo $pagination; ?>
        <div>
            <table border="1">

                <thead>
                    <tr>
                        <th>

                            <?=
                            anchor(site_url('Subject/display/subject_name/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'име на предмет');
                            ?>
                        </th>
                        <th>Хорариум часове за лекции</th>
                        <th>Хорариум часове за упражнения</th>
                        <th colspan="2">опции</th>

                    </tr>
                </thead>

                <tbody>


                    <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?= $subject['subject_name']; ?></td>
                            <td><?= $subject['subject_workload_lectures']; ?></td>
                            <td><?= $subject['subject_workload_exercises']; ?></td>
                            <td><?= anchor(site_url('Subject/edit/') . '/' . "$subject[subject_id]", 'промени'); ?></td>
                            <td><?=
                                anchor(site_url('Subject/delete/') . '/' . "$subject[subject_id]", 'изтрии', array('class' => 'delete', 'onclick' => "return confirm('Сигурни ли сте че искате да изтриете  $subject[subject_name]?')"));
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php echo $pagination; ?>
        </div>
        <p><?= anchor('Subject/add', 'Добавете предмет'); ?></p>
        <p><?= anchor('Subject/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>





<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?></p>
<? header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Courses_name</title>
    </head>
    <body>

        <?php //echo $pagination; ?>
        <div>
            <table border="1">

                <thead>
                    <tr>
                        <th>

                            <?=
                            anchor(site_url('Course/display/course_id/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'номер');
                            ?>
                        </th>
                        <th>
                            <?=
                            anchor(site_url('Course/display/course_name/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'име на курс');
                            ?>

                        </th>
                        <th colspan="2">опции</th>

                    </tr>
                </thead>

                <tbody>


                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= $course['course_id']; ?></td>
                            <td><?= $course['course_name']; ?></td>
                            <td><?= anchor(site_url('Course/edit/') . '/' . "$course[course_id]", 'промени'); ?></td>
                            <td><?=
                                anchor(site_url('Course/delete/') . '/' . "$course[course_id]", 'изтрии', array('class' => 'delete', 'onclick' => "return confirm('Сигурни ли сте че искате да изтриете  $course[course_name]?')"));
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php echo $pagination; ?>
        </div>
        <p><?= anchor('Course/add', 'Добавете курс'); ?></p>
        <p><?= anchor('Course/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>



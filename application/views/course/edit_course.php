<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Courses_edit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        <table border="1">
            <thead>
                <tr>
                    <th>Име на курс</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($courses as $course): ?>
                        <td><?php echo $course['course_name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>


        <?= form_open(); ?>
        <?= form_input('new_name', 'Ново име'); ?><br/>
        <?= form_submit('submit', 'Промени'); ?>
        <?= form_submit('cancel', 'Отказ'); ?>
        <?= form_close(); ?>
        <p><?= anchor('Course', 'Изход'); ?></p>
        <p><?= anchor('Course/display', 'Обнови'); ?></p>
    </body>
</html>
<?if($this->session->flashdata('flasherror'));?>
<div class="'flasherror">
    Error:<?= $this->session->flashdata('flasherror'); ?>
</div>

<?if($this->session->flashdata('flashconfirm'));?>
<div class="flashconfirm">
    Success:<?= $this->session->flashdata('flashconfirm'); ?>
</div>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Subject_edit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        <table border="1">
            <thead>
                <tr>
                    <th>Име на предмет</th>
                    <th>Хорариум часове за лекции</th>
                    <th>Хорариум часове за упражнения</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($subjects as $subject): ?>
                    <tr>
                        <td><?= $subject['subject_name']; ?></td>
                        <td><?= $subject['subject_workload_lectures']; ?></td>
                        <td><?= $subject['subject_workload_exercises']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>


        <?= form_open(); ?>
        <?= form_input('subject_name', 'Ново име'); ?><br/>
        <?= form_input('lectures', 'Хорариум часове за лекции'); ?><br/>
        <?= form_input('exercises', 'Хорариум часове за упражнения'); ?><br/>
        <?= form_submit('submit', 'Промени'); ?>
        <?= form_submit('cancel', 'Отказ'); ?>
        <?= form_close(); ?>
        <p><?= anchor('Subject', 'Изход'); ?></p>
        <p><?= anchor('Subject/display', 'Обнови'); ?></p>
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Speciality_edit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        <table border="1">
            <thead>
                <tr>
                    <th>Име на специалност</th><th>абревиатура</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($specialitys as $speciality): ?>
                        <td><?php echo $speciality['speciality_name_long']; ?></td><td>
                            <?php echo $speciality['speciality_name_short']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>


        <?= form_open(); ?>
        <?= form_input('long_name', 'Ново име'); ?><br/>
        <?= form_input('short_name', 'Новa абревиатура'); ?><br/>
        <?= form_submit('submit', 'Промени'); ?>
        <?= form_submit('cancel', 'Отказ'); ?>
        <?= form_close(); ?>
        <p><?= anchor('Speciality', 'Изход'); ?></p>
        <p><?= anchor('Speciality/display', 'Обнови'); ?></p>
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

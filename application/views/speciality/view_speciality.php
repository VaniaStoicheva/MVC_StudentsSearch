<p><?= $this->session->flashdata('flasherror'); ?></p>
<p><?= $this->session->flashdata('flashconfirm'); ?></p>
<? header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Speciality</title>
    </head>
    <body>

        <?php //echo $pagination; ?>
        <div>
            <table border="1">

                <thead>
                    <tr>
                        <th>

                            <?=
                            anchor(site_url('Speciality/display/speciality_name_long/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'име на специалност');
                            ?>
                        </th>
                        <th>
                            <?=
                            anchor(site_url('Speciality/display/speciality_name_short/') . '/'
                                    . (($sort_order == 'asc' ) ? 'desc' : 'asc'), 'абревиатура');
                            ?>

                        </th>
                        <th colspan="2">опции</th>

                    </tr>
                </thead>

                <tbody>


                    <?php foreach ($specialities as $speciality): ?>
                        <tr>
                            <td><?= $speciality['speciality_name_long']; ?></td>
                            <td><?= $speciality['speciality_name_short']; ?></td>
                            <td><?= anchor(site_url('Speciality/edit/') . '/' . "$speciality[speciality_id]", 'промени'); ?></td>
                            <td><?=
                                anchor(site_url('Speciality/delete/') . '/' . "$speciality[speciality_id]", 'изтрии', array('class' => 'delete', 'onclick' => "return confirm('Сигурни ли сте че искате да изтриете  $speciality[speciality_name_long]?')"));
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <?php echo $pagination; ?>
        </div>
        <p><?= anchor('Speciality/add', 'Добавете специалност'); ?></p>
        <p><?= anchor('Speciality/display', 'Обнови'); ?></p>
        <p><?= anchor('Members', 'Изход'); ?></p>
    </body>
</html>





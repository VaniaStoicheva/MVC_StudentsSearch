<p><?= $this->session->flashdata('errmsg'); //извежда грешките от set_flashdata  ?></p>

<div id="login">
    <fieldset>
        <legend>Login</legend>
        <?= form_open('Login/validate'); ?>
        <?= form_input('user_name', set_value('user_name', 'Име')); ?>
        <?= form_password('user_password', 'Парола'); ?>
        <?= form_submit('submit', 'Login'); ?>
        <?= form_close(); ?>

        <?= validation_errors('<div class="validation_err">'); //грешки от валидацияta  в клас*/?>
    </fieldset>

    <?= anchor('login/register', 'Register an account'); ?>
</div>

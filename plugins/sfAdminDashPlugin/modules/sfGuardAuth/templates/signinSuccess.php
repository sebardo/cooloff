<?php use_helper('Validation', 'I18N') ?>

<?php if ($sf_request->hasErrors()): ?>
  <ul class='error'>
  <?php foreach($sf_request->getErrors() as $error): ?>
    <li><?php echo __($error) ?></li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>

<div id="ctr" align="center">
  <div class="login">
    <div class="login-form">
      <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
        <h1 id="title"><?php echo __('Login') ?></h1>
        <div class="form-block">
          <?php //echo $form->renderGlobalErrors() ?>
          <div class="inputlabel"><?php echo label_for('username', __('Username:')) ?></div>
          <div>
            <?php //echo form_error('username') ?>
            <?php echo input_tag('username', $sf_data->get('sf_params')->get('username')) ?>
          </div>
          <div class="inputlabel"><?php echo label_for('password', __('Password:')) ?></div>
          <div>
            <?php //echo form_error('password') ?>
            <?php echo input_password_tag('password') ?>
          </div>
          <?php /* ?>
          <div class="inputlabel">
            <?php echo label_for('remember', __('Remember me?')) ?>
            <?php echo checkbox_tag('remember') ?>
          </div>
          <?php */ ?>
          <div align="left">
          	<?php echo submit_tag(__('sign in'));
          	/*echo submit_tag(__('sign in')),
          	  link_to(__('Forgot your password?'), 
          	  	'@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password'))*/ ?>
  		  </div>
        </div>
      </form>
    </div>
    
    <div class="login-text">
      <div class="ctr"><img alt="Security" src="<?php echo sfConfig::get('sf_relative_url_root') ?>/sfAdminDashPlugin/images/icon_toolbar/login64.png" /></div>
      <p>
        <?php echo __('Welcome to ') ?>
        <span><?php echo sfAdminDash::getProperty('site') ?></span>
      </p>
      <p><?php echo __('Use a valid username and password to gain access to the administration console.') ?></p>
    </div>

    <div class="clr"></div>
  </div>
</div>

<div id="container-centers">
    <div class="content-centers">
          <div class="info">
            <h2><?php echo __("L'arxiu"); ?> <?php echo $protectedFile->getFilename(); ?> <?php echo __("està protegit"); ?></h2>
              <div class="description">
                  <p><?php echo __("Entra el password per poder descarregar l'arxiu"); ?></p>
                  <?php echo form_tag('@center_password_check?stripped_center='.$stripped_center.'&id='.$protectedFile->getId()) ?>
                      <input type="text" name="password" id="password" />
                      <input type="submit" value="<?php echo __("registration.trans124"); ?>" />
                  </form>
              </div>
          </div>
    </div>
</div>
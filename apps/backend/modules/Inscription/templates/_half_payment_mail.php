
<style>
    p{
        font: arial;
        font-size: 12px;;
    }
ul{
    margin-left:50px;
    list-style-type: disc;
}

</style>


        <p><?php echo __('Benvolguts pares,') ?></p>
        <p><?php echo __('Gràcies per la vostra inscripció a les activitats de l\'Cooloff.') ?></p>
        <p><?php  echo __('Pagament 50%') ?></p>
         
        <p><?php echo __('Moltes gràcies un cop més per confiar en Kids&Us!') ?></p>
        <p><?php  echo __('Atentament, ') ?></p>

        <?php echo image_tag($sf_user->getCulture().'/logo.png',array('absolute'=>true, 'width'=>'205px;')) ?>

        <?php if ($sf_user->getCulture()=='ca' || $sf_user->getCulture()=='es') { ?>

                <p><?php  echo __('T. (+34) 902 93 40 23, ') ?></p>


                 <a href="mailto:info@kidsandus.es">info@kidsandus.es</a>

          <?php } ?>

<?php $culture = $sf_user->getCulture(); ?>
<div id="container-home">
    <div class="content-home">      
        <div class="content-intro">    
            <?php echo image_tag("summer_fun/details/home1.jpg", array('alt' => '', 'class' => 'main-image')); ?>
            <div class="intro">
                <h2><?php echo __("ENGLISH SUMMER FUN[1]ESTIU [2]", array('[1]' => '<br /><span>', '[2]' => date('Y') . "</span>")); ?></h2>
                <p><?php echo __("L'English Summer Fun és el resultat de l'esforç continu d'un equip de persones amb gran experiència en el món de l'ensenyament de l'anglès per a nens petits. Els coneixements pedagògics de l'equip d'I+D de Kids[1]Us i les necessitats motivacionals dels nostres alumnes es combinen per oferir una experiència única als petits mentre aprenen anglès.", array('[1]' => '&amp;')); ?></p>
                <p><?php echo __("L'English Summer Fun by Kids[1]Us és un casal d'estiu amb un objectiu molt clar: [2]Que els alumnes tornin cada dia a casa amb la sensació que han viscut unes experiències divertides i diferents i sense adonar-se que tot això ho han fet al mateix temps que aprenen anglès[2].", array('[1]' => '&amp;', '[2]' => '"')); ?></p>
                <p class="centre nm"><?php echo link_to_i18n(__("On?"), '@centers', array('title' => __("On seran?"), 'class' => 'where')); ?></p>
            </div>
            <br class="clear" />
        </div>
        <div class="box home1">
            <h3><?php echo __("Què és?", array('[1]' => '<br />')); ?></h3>
            <p><?php echo __("És un casal d'estiu amb l'objectiu principal d'aconseguir que cada dia els nens surtin feliços i contents, amb la sensació d'haver viscut unes experiències divertides i diferents..., i sense adonar-se que tot això ho han estat fent en anglès![1]Al Summer Fun fem molt més que classes d'anglès! Fem activitats de lleure, vivencials i enriquidores on la llengua vehicular és l'anglès.", array('[1]' => '<br />')); ?></p>
        </div>
        <div class="box home2">
            <h3><?php echo __("Com és?"); ?></h3>
            <p><?php echo __("Cada setmana l'equip de Kids[1]Us acompanyarà els vostres fills en les diferents aventures que els proposarem.[2]La nostra missió és aconseguir que els nens i nenes s'interessin per les activitats que desenvolupen i s'arribin a identificar plenament amb els personatges i històries que expliquem, així aconseguim que interioritzin les estructures i el vocabulari de manera natural i sòlida sense ser conscients d'estar-ho fent. Oi que sembla màgic?", array('[1]' => '&amp;', '[2]' => '<br />')); ?></p>
        </div>
        <div class="box home3">
            <h3<?php echo $sf_user->getCulture() == 'it' ? ' class="it"':''; ?>><?php echo __("Com ho fem?"); ?></h3>
            <p><?php echo __("El nostre equip està format per persones sociables i amb clara vocació per la docència, a qui els apassionen els nens i el seu món i amb aptituds per l'ensenyament de l'anglès. Gent dinàmica, alegre i motivada per la seva feina.[1]Tots els professors tenen experiència en l'ensenyament de l'anglès amb metodologia Kids[2]Us.[1]Formació específica en material i dinàmica de les Fun Weeks.", array('[1]' => '<br />', '[2]' => '&amp;')); ?></p>
        </div>
        <br class="clear" />
        
        <a href="<?php echo $url_kids; ?>" class="centers" target="_blank"><?php echo __("Coneix els centres Kids[1]Us", array('[1]' => '&')); ?></a>
        
    </div>
</div>
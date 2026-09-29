<?php if(!empty($rwsubcat)){ ?>
<div class="eip-program-section" id="vtc-program">
    <div class="container-lg">
        <div class="widgethead text-center">
            <?php if(!empty($rwsubcat['sdesc'])){ ?>
            <p class="sec-sub-title"><?=$rwsubcat['sdesc'];?></p>
            <?php } ?>
        </div>
        <?php if(!empty($rwsubcat['sc_desc'])){ ?>
        <div class="eip-desc-content">
            <?=$rwsubcat['sc_desc'];?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>

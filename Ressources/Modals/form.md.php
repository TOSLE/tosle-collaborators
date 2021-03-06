<?php if(!empty($errors)): ?>
    <div class="errors-message">
        <?php foreach($errors as $name => $value):?>
            <p>
                <span class="error-type">*<?php echo $name; ?></span> <span class="error-content"><?php echo $value;?></span>
            </p>
        <?php endforeach; ?>
    </div>
<?php endif;?>

<form method="<?php echo $config['config']['method'];?>" action="<?php echo $config['config']['action'];?>">
    <div class="form-group-base">
        <?php if(isset($config['input'])):?>
            <?php foreach ($config["input"] as $name => $attributs):?>
                <?php if(isset($attributs["label"])):?>
                    <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                <?php endif;?>
                <?php if($attributs["type"]=="text" || $attributs["type"]=="email" || $attributs["type"]=="number" || $attributs["type"]=="password"):?>
                    <input type="<?php echo $attributs["type"];?>" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]) && $attributs["required"])?"required='required'":"";?> value="<?php echo (isset($config["data_content"][$name]))?$config["data_content"][$name]:"";?>">
                <?php endif;?>
                <?php if($attributs["type"]=="password_install"):?>
                    <input type="password" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]) && $attributs["required"])?"required='required'":"";?> value="<?php echo (isset($config["data_content"][$name]))?$config["data_content"][$name]:"";?>">
                <?php endif;?>
                <?php if(isset($attributs["description"])):?>
                    <div class="small-precision-input"><?php echo $attributs["description"];?></div>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
        <?php if(isset($config["captcha"])):?>
            <label for="captcha" class="captcha_img">
                <img src="<?php echo DIRNAME;?>Public/Libraries//TosleCaptcha/GenerateCaptcha.php">
            </label>
            <input id="captcha" type="text" name="captcha" placeholder="Please enter the captcha shown above" required='required'>
            <div class="small-precision-input">You can reload the page to generate a new captcha</div>
        <?php endif;?>
        <?php if(isset($config["textarea"])):?>
            <?php if(isset($config["textarea"]["label"])):?>
                <label for="textArea_exampleBase"><?php echo $config["textarea"]["label"];?></label>
            <?php endif;?>
            <?php if(isset($config["textarea"]["name"])):?>
                <textarea id="<?php echo $config["textarea"]["name"];?>" name="<?php echo $config["textarea"]["name"];?>" class="textarea-col-12" placeholder="<?php echo (isset($config["textarea"]["placeholder"])?$config["textarea"]["placeholder"]:"");?>"><?php if(isset($config["content_value"]["content"])):?><?php echo $config["content_value"]["content"];?><?php endif;?></textarea>
            <?php endif;?>
            <?php if(isset($config["textarea"]["description"])):?>
                <div class="small-precision-input"><?php echo $config["textarea"]["description"];?></div>
            <?php endif;?>
        <?php endif;?>
        <?php if(isset($config['config']['secure']['status']) && $config['config']['secure']['status']):?>
            <input type="hidden" name="_token" id="_token" value="<?php echo Form::secureCSRF();?>">
        <?php endif;?>
        <input type="submit" class="btn btn-tosle" value="<?php echo $config["config"]["submit"];?>">
    </div>
</form>
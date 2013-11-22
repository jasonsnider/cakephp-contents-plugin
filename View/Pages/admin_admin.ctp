<?php
    //Returns all plugins in the system, if that plugin has a controller and that follows the CakePHP standard of 
    //naming, it will try to link to the index view of that controller.
    //Not intended for production, rather as an aid for plugin development.

    $li = null;
    $pluginLi = null;
    $adminPluginLi = null;

    //Find all of the Plugins
    $plugins = scandir(APP . 'Plugin');
    foreach($plugins as $plugin):

        //Create the expected path to the plugins default controller
        $loc = Inflector::underscore($plugin); 

        $pluginMain = 
            ROOT . DS . 
            APP_DIR . DS . 
            'Plugin' .  DS . 
            $plugin . DS . 
            'Controller' . DS . 
            "{$plugin}Controller.php";

        //Does the plugin have a controller named after the plugin?
        if(!in_array($plugin, array('.', '..'))):
            //It does create a link
            $li .= $this->Html->tag('li',  $plugin, array('class'=>'list-group-item'));
        endif;

        $pluginControllers = 
            ROOT . DS . 
            APP_DIR . DS . 
            'Plugin' .  DS . 
            $plugin . DS . 'Controller';

        $pluginViews = 
            ROOT . DS . 
            APP_DIR . DS . 
            'Plugin' .  DS . 
            $plugin . DS . 'View';

        $nav = array();
        $adminNav = array();

        if(is_dir($pluginControllers)):

            foreach(scandir($pluginControllers) as $directory):

                if(!in_array($directory, array('.', '..', 'Component'))):
                     $theController = str_replace('Controller.php', '', $directory);

                     //Regular pages
                    if(is_file($pluginViews . DS . $theController . DS . 'index.ctp')){
                        $nav[$plugin][] = $theController;
                    }

                    //Admin pages
                    if(is_file($pluginViews . DS . $theController . DS . 'admin_index.ctp')){
                        $adminNav[$plugin][] = $theController;
                    }

                endif;

            endforeach;

        endif;

        foreach($nav as $key => $menu):

            $pluginLi .= $this->Html->tag('li', $key, array('class'=>'list-group-item'));

            for($i=0; $i<count($menu); $i++):

                $pluginLi .= $this->Html->tag(
                    'li', 
                    $this->Html->link(
                        $menu[$i], 
                        array(
                            'admin'=>false,
                            'plugin'=>Inflector::underscore($plugin),
                            'controller'=>Inflector::underscore($menu[$i]),
                            'action'=>'index'
                        )
                    ), 
                    array('class'=>'list-group-item')
                );

            endfor;

        endforeach;

        foreach($adminNav as $key => $menu):

            $adminPluginLi .= $this->Html->tag('li', $key, array('class'=>'list-group-item'));

            for($i=0; $i<count($menu); $i++):

                $adminPluginLi .= $this->Html->tag(
                    'li', 
                    $this->Html->link(
                        $menu[$i], 
                        array(
                            'admin'=>true,
                            'plugin'=>Inflector::underscore($plugin),
                            'controller'=>Inflector::underscore($menu[$i])
                        )
                    ), 
                    array('class'=>'list-group-item')
                );

            endfor;

        endforeach;

    endforeach;
        
?>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Installed Plugins</div>
            <div class="panel-body"><em>A simple of all plugins used by this project.</em></div>
            <?php echo $this->Html->tag('ul', $li, array('class'=>'list-group')); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Menu</div>
            <div class="panel-body"><em>The sites main menu.</em></div>
            <?php echo $this->Html->tag('ul', $pluginLi, array('class'=>'list-group')); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Admin</div>
            <div class="panel-body"><em>Navigation into all of the admin functions.</em></div>
            <?php echo $this->Html->tag('ul', $adminPluginLi, array('class'=>'list-group')); ?>
        </div>
    </div>
</div>

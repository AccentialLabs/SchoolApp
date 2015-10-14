<?php
echo $this->Html->script('jquery.min') . "\n";
echo $this->Html->script('bootstrap.min') . "\n";
echo $this->Html->script('base') . "\n";
echo $this->fetch('script');
?>
<?php
echo $this->Html->css('bootstrap.min', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');
?>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">

                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="brand" href="">Adventa Master</a>

                <!-- Top Menu -->
                <div class="nav-collapse collapse">
                    <?php echo $this->element('top_menu'); ?>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class='row'>
            <!-- Sidebar Menu -->
            <div class='span3'>
                <?php echo $this->element('sidebar_menu'); ?>
            </div>

            <div class='span9'>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div> <!-- /container -->

</body>
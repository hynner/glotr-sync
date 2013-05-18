<div id="menu">
    <ul>
        <?php
            foreach($subpages as $s):
        ?>
            <li>
                <a href="<?php echo makeUrl("home/$s"); ?>"><?php echo $s; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

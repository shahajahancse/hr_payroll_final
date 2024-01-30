        <div class="col-md-12" style="display: flex;flex-wrap: wrap;">
            <div class=col-md-4 style="display: flex;flex-direction: column;">
                <?php $limit = 25;
                $offset = $limit;
                $i = 0;
                foreach ($results as $key => $v) {
                    if ($offset == $i) {
                        echo '</div><div class=col-md-4 style="display: flex;flex-direction: column;">';
                        $offset += $limit;
                    }
                ?>
                    <div>
                        <?php if (!empty($desig_id) && in_array($v->id, $desig_id)) { ?>
                            <input type="checkbox" onchange="check_level()" />
                            <span style="color: #0d14f3;"><?php echo $v->desig_name; ?></span>
                        <?php } else { ?>
                            <input type="checkbox" onchange="check_level()" />
                            <span><?php echo $v->desig_name; ?></span>
                        <?php } ?>
                    </div>
                <?php $i++;
                } ?>
            </div>
        </div>

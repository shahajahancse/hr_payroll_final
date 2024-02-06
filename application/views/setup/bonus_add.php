<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-3" style="padding: 7px;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('index.php/setup_con/bonus_setup') ?>">
                        << Back</a>
                            <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
                </div>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
    <div class="row">
        <?php
            $failuer = $this->session->flashdata('failure');
            ?>
    </div>
    <div class="tablebox">
        <h3>Create  Bonus</h3>
        <form action="<?= base_url('index.php/setup_con/bonus_add')?>" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="unit_id">Unit</label>
                            <select name="unit_id" id="unit_id" class="form-control">
                                <option value="">Select Unit</option>
                                <?php foreach ($pr_units as $key => $value) {
                            ?>
                                <option value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_name; ?></option>
                                <?php } ?>
                            </select>
                            <?= (isset($failuer['unit_id'])) ? '<div class="alert alert-failuer">' . $failuer['unit_id'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Employee Type</label>
                            <!-- <input required type="text" name="emp_type" value="" placeholder="Employee Type"
                                class="form-control"> -->
                                <select name="emp_type" id="">
                                    <option value="">Select Employee Type</option>
                                    <option value="Worker">Worker</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            <?=(isset($failuer['emp_type'])) ? '<div class="alert alert-failuer">' . $failuer['emp_type'] . '</div>' : ''; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Bonus First Month</label>
                            <input required type="number" name="bonus_first_month" value=""
                                placeholder="Bonus First Month" class="form-control">
                            <?=(isset($failuer['bonus_first_month'])) ? '<div class="alert alert-failuer">' . $failuer['bonus_first_month'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Bonus Second Month</label>
                            <input required type="number" name="bonus_second_month" value=""
                                placeholder="Bonus Second Month" class="form-control">
                            <?=(isset($failuer['bonus_second_month'])) ? '<div class="alert alert-failuer">' . $failuer['bonus_second_month'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Bonus Amount</label>
                            <select name="bonus_amount" id="">
                                    <option value="">Select Employee Type</option>
                                    <option value="Gross">Gross</option>
                                    <option value="Basic">Basic</option>
                                </select>
                            <?=(isset($failuer['bonus_amount'])) ? '<div class="alert alert-failuer">' . $failuer['bonus_amount'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Bonus Amount Fraction</label>
                            <input required type="number" name="bonus_amount_fraction" value=""
                                placeholder="Bonus Amount Fraction" class="form-control">
                            <?=(isset($failuer['bonus_amount_fraction'])) ? '<div class="alert alert-failuer">' . $failuer['bonus_amount_fraction'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Bonus Percent</label>
                            <input required type="number" name="bonus_percent" value="" placeholder="Bonus Percent"
                                class="form-control">
                            <?=(isset($failuer['bonus_percent'])) ? '<div class="alert alert-failuer">' . $failuer['bonus_percent'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Festival</label>
                            <input required type="text" name="festival" value="" placeholder="Festival"
                                class="form-control">
                            <?=(isset($failuer['festival'])) ? '<div class="alert alert-failuer">' . $failuer['festival'] . '</div>' : ''; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Effective Date</label>
                            <input required type="text" class="date" name="effective_date" value="" placeholder="Effective Date"
                                class="form-control">
                            <?=(isset($failuer['effective_date'])) ? '<div class="alert alert-failuer">' . $failuer['effective_date'] . '</div>' : ''; ?>
                        </div>
                    </div>
                    <br>

                    <div class="form-group footer_button">
                        <button type="submit" class="btn btn-primary ">Submit</button></button>
                        <a href="" class="btn-warning btn">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
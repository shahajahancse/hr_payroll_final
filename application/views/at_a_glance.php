<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f8;
    color: #333;
    padding: 20px;
}

/* Dashboard Cards */
.dash-cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.dash-card {
    background: #fff;
    flex: 1;
    min-width: 290px;
    display: flex;
    height: 117px;
}


.dash-card__icon {
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.dash-card__icon i {
    font-size: 2em;
    color: #fff;
}

.dash-card__content {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
}




.dash-card__row {
    display: flex;
    height: 50%;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 0px 2px 0px #828282;
    padding: 11px 33px;
}

.dash-card__title {
    font-size: 16px;
    font-weight: 400;
    color: #070707;
}

.dash-card__value {
    font-family: Roboto;
    font-weight: 600;
    font-size: 20px;
    line-height: 150%;
    letter-spacing: 0%;
    color: #000000;
}




.dash-card--blue .dash-card__icon {
    background: #009bbd;
}

.dash-card--green .dash-card__icon {
    background: #448644;
}

.dash-card--blue2 .dash-card__icon {
    background: #4b87f9;
}

/* Dashboard Stats */
.dash-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.dash-stat {
    background: #fff;
    border: 1px solid #e0e0e0;
}

.dash-stat--total {}

.dash-stat--today {}

.dash-stat--current {}

.dash-stat--prev {}

.dash-stat__header {
    padding: 8px 12px;
    font-weight: bold;
    color: #fff;
}

.dash-stat--total .dash-stat__header {
    background: #7c0b22;
}

.dash-stat--today .dash-stat__header {
    background: #7c1478;
}

.dash-stat--current .dash-stat__header {
    background: #1e4486;
}

.dash-stat--prev .dash-stat__header {
    background: #00732e;
}

.dash-stat__list {
    list-style: none;
    padding: 12px;
}


.dash-stat__item {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    border: 1px solid #e1e1e1;
    padding: 3px;
}

.dash-bullet {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-right: 8px;
    border-radius: 50%;
}

.dash-stat--total .dash-bullet {
    background: #60c94f;
}

.dash-stat--total:nth-child(2) .dash-bullet {
    background: #e02424;
}

.dash-stat--total:nth-child(3) .dash-bullet {
    background: #5b5bdc;
}

.dash-stat--total:nth-child(4) .dash-bullet {
    background: #7c1478;
}

.dash-stat--today .dash-bullet {
    background: #60c94f;
}

.dash-stat--today:nth-child(2) .dash-bullet {
    background: #e02424;
}

.dash-stat--today:nth-child(3) .dash-bullet {
    background: #5b5bdc;
}

.dash-stat--today:nth-child(4) .dash-bullet {
    background: #7c1478;
}

.dash-stat--current .dash-bullet {
    background: #60c94f;
}

.dash-stat--current:nth-child(2) .dash-bullet {
    background: #e02424;
}

.dash-stat--current:nth-child(3) .dash-bullet {
    background: #5b5bdc;
}

.dash-stat--current:nth-child(4) .dash-bullet {
    background: #7c1478;
}

.dash-stat--prev .dash-bullet {
    background: #60c94f;
}

.dash-stat--prev:nth-child(2) .dash-bullet {
    background: #e02424;
}

.dash-stat--prev:nth-child(3) .dash-bullet {
    background: #5b5bdc;
}

.dash-stat--prev:nth-child(4) .dash-bullet {
    background: #7c1478;
}

.dash-stat__label {
    flex: 1;
    color: #444;
}

.dash-stat__value {
    font-weight: bold;
}

.pichart_main {}

.piechart_c {
    height: 276px !important;
    background: #ffffff;
    padding: 27px;
    margin-bottom: 13px;
}
</style>







<div class="content">
    <!-- Top Cards -->
    <div class="dash-cards">
        <div class="dash-card dash-card--blue">
            <div class="dash-card__icon"><i class="fa fa-users"></i></div>
            <div class="dash-card__content">
                <div class="dash-card__row"><span class="dash-card__title">Total Staff</span><span
                        class="dash-card__value" id="total_staff">0</span></div>
                <div class="dash-card__row"><span class="dash-card__title">Total Worker</span><span
                        class="dash-card__value" id="total_worker">0</span></div>
            </div>
        </div>
        <div class="dash-card dash-card--green">
            <div class="dash-card__icon"><i class="fa fa-university"></i></div>
            <div class="dash-card__content">
                <div class="dash-card__row"><span class="dash-card__title">Department</span><span
                        class="dash-card__value" id="total_department">0</span></div>
                <div class="dash-card__row"><span class="dash-card__title">Line</span><span class="dash-card__value"
                        id="total_line">0</span></div>
            </div>
        </div>
        <div class="dash-card dash-card--blue2">
            <div class="dash-card__icon"><i class="fa fa-id-card-o"></i></div>
            <div class="dash-card__content">
                <div class="dash-card__row"><span class="dash-card__title">Section</span><span class="dash-card__value"
                        id="total_section">0</span></div>
                <div class="dash-card__row"><span class="dash-card__title">Designation</span><span
                        class="dash-card__value" id="total_designation">0</span></div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="dash-stats">
        <div class="dash-stat dash-stat--total">
            <div class="dash-stat__header"><i class="fa fa-table"></i> Total Manpower</div>
            <ul class="dash-stat__list">
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Total
                        Employee</span><span class="dash-stat__value" id="total_employee">0</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Total
                        Male</span><span class="dash-stat__value" id="total_male">0</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Total
                        Female</span><span class="dash-stat__value" id="total_female">0</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Total
                        Common</span><span class="dash-stat__value" id="total_common">0</span></li>
            </ul>
        </div>
        <div class="dash-stat dash-stat--today">
            <div class="dash-stat__header"><i class="fa fa-calendar"></i> Today Attendance</div>
            <ul class="dash-stat__list">
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Present</span><span class="dash-stat__value"
                        id="total_present">0</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Absent</span><span class="dash-stat__value" id="total_absent">0</span>
                </li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Leave</span><span class="dash-stat__value" id="total_leave">0</span>
                </li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Late</span><span class="dash-stat__value" id="total_late">0</span>
                </li>
            </ul>
        </div>
        <div class="dash-stat dash-stat--current">
            <div class="dash-stat__header"><i class="fa fa-bell"></i> Current Month Status</div>
            <ul class="dash-stat__list">
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">New
                        Join</span><span class="dash-stat__value" id="total_new_join">370</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Resign</span><span class="dash-stat__value" id="total_resign">28</span>
                </li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Lefty</span><span class="dash-stat__value" id="total_lefty">75</span>
                </li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">New to
                        Regular</span><span class="dash-stat__value" id="total_new_to_regular">75</span></li>
            </ul>
        </div>
        <div class="dash-stat dash-stat--prev">
            <div class="dash-stat__header"><i class="fa fa-address-book" aria-hidden="true"></i> Previous Month Summary
            </div>
            <ul class="dash-stat__list">
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Salary</span><span class="dash-stat__value"
                        id="total_salary">10000000</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span
                        class="dash-stat__label">Overtime</span><span class="dash-stat__value"
                        id="total_overtime">200000</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Ext.
                        Overtime</span><span class="dash-stat__value" id="total_ext_overtime">500000</span></li>
                <li class="dash-stat__item"><span class="dash-bullet"></span><span class="dash-stat__label">Attn.
                        Bonus</span><span class="dash-stat__value" id="total_attn_bonus">500000</span></li>
            </ul>
        </div>
    </div>

    <!-- Charts -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 pichart_main">
                <div class="piechart_c">
                    <canvas id="dash-barChart" style="height: 240px !important;"></canvas>
                </div>
            </div>
            <div class="col-md-4 pichart_main">
                <div class="piechart_c">
                    <canvas id="dash-pieChart" style="height: 240px !important;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Bar Chart Data
    const ctxBar = document.getElementById('dash-barChart').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                    label: 'Salary',
                    data: [480, 420, 410, 390, 430, 450, 560, 400, 380, 390, 420, 430]
                },
                {
                    label: 'Overtime',
                    data: [440, 380, 370, 360, 390, 410, 530, 380, 360, 370, 390, 400]
                },
                {
                    label: 'Allowance',
                    data: [460, 400, 400, 380, 410, 420, 520, 390, 370, 380, 400, 410]
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Pie Chart Data
    const ctxPie = document.getElementById('dash-pieChart').getContext('2d');
    const pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['New Joining', 'Resign', 'Lefty'],
            datasets: [{
                data: [370, 28, 75]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    </script>
    <script>
    $(document).ready(function() {
        function get_dashboard_data() {

            $.ajax({
                url: '<?php echo base_url(); ?>/dashboard/get_dashboard_data',
                method: 'POST',
                success: function(data) {
    //                 data = JSON.parse(data);
    //                   [monthly_join_id] => 62
    // [monthly_resign_id] => 37
    // [monthly_left_id] => 4
    // [salary] => 24024162
    // [ot] => 5964728
    // [eot] => 2496815
    // [att_bonus] => 1395900
    // [all_emp] => 2951
    // [all_present] => 
    // [all_absent] => 
    // [all_male] => 1234
    // [all_female] => 1717
    // [all_late] => 
    // [all_leave] => 
    // [all_staff] => 256
    // [all_employee] => 2695
                    var salary = data.salary;
                    var ot = data.ot;
                    var eot = data.eot;
                    var att_bonus = data.att_bonus;
                    var all_emp = data.all_emp;
                    var all_present = data.all_present;
                    var all_absent = data.all_absent;
                    var all_male = data.all_male;
                    var all_female = data.all_female;
                    var all_late = data.all_late;
                    var all_leave = data.all_leave;

                    console.log(salary);
                    

                    $("#total_salary").html(salary);
                    $("#total_overtime").html(ot);
                    $("#total_ext_overtime").html(eot);
                    $("#total_attn_bonus").html(att_bonus);



                    $("#total_all_emp").html(all_emp);
                    $("#total_all_present").html(all_present);
                    $("#total_all_absent").html(all_absent);
                    $("#total_all_male").html(all_male);
                    $("#total_all_female").html(all_female);
                    $("#total_all_late").html(all_late);
                    $("#total_all_leave").html(all_leave);


                    $("#total_all_emp").html('');
                    $("#total_all_present").html('');
                    $("#total_all_absent").html('');
                    $("#total_all_male").html('');
                    $("#total_all_female").html('');
                    $("#total_all_late").html('');
                    $("#total_all_leave").html('');



                },
                error: function() {
                    alert('error');
                }
            });
        }
        get_dashboard_data();
    });
    </script>

</div>

  
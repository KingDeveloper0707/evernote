<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text">ACTIVE USERS</div>
                    <div class="number count-to" data-from="0" data-to="<?= $active_users; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text">ALL CUSTOMERS</div>
                    <div class="number count-to" data-from="0" data-to="<?= $all_customers; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <div class="text">ALL REQUESTS</div>
                    <div class="number count-to" data-from="0" data-to="<?= $all_requests; ?>" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
                
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="content">
                    <div class="text">TODAY'S REQUESTS</div>
                    <div class="number count-to" data-from="0" data-to="<?= $today_requests; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
</div>


<!-- ======================= Scripts for this page ============================== -->
<!-- Jquery CountTo Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
<script src="<?= base_url()?>public/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url()?>public/plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="<?= base_url()?>public/plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Custom Js -->
<script src="<?= base_url()?>public/js/pages/index.js"></script>

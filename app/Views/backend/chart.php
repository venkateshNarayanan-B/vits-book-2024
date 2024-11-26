<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Flot Charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flot</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Temperature
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtimeTemperature" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="temperature" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Humidity
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtimeHumidity" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="humidity" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- FLOT CHARTS -->
<script src="<?= base_url('assets')?>/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= base_url('assets')?>/plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
  $(function () {
    var data = [];
    var totalPoints = 100;
    var updateInterval = 500; // Update interval in milliseconds
    var realtime = 'on'; // Real-time mode
    
    function getRandomData() {
      if (data.length > 0) data = data.slice(1);
      
      while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50;
        var y = prev + Math.random() * 10 - 5;
        y = Math.max(0, Math.min(y, 100));
        data.push(y);
      }

      var res = [];
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]]);
      }
      return res;
    }

    function createPlot(container, color) {
      return $.plot(container, [getRandomData()], {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: color,
          lines: { lineWidth: 2, show: true, fill: true }
        },
        yaxis: { min: 0, max: 100, show: true },
        xaxis: { show: true }
      });
    }

    var temperature = createPlot('#temperature', '#3c8dbc');
    var humidity = createPlot('#humidity', '#3c8dbc');

    function update(plot, getDataFunc) {
      plot.setData([getDataFunc()]);
      plot.draw();
      if (realtime === 'on') {
        setTimeout(function() {
          update(plot, getDataFunc);
        }, updateInterval);
      }
    }

    if (realtime === 'on') {
      update(temperature, getRandomData);
      update(humidity, getRandomData);
    }

    function handleRealtimeToggle(buttonGroup, plot, getDataFunc) {
      $(buttonGroup + ' .btn').click(function () {
        realtime = $(this).data('toggle');
        if (realtime === 'on') {
          update(plot, getDataFunc);
        }
      });
    }

    handleRealtimeToggle('#realtimeTemperature', temperature, getRandomData);
    handleRealtimeToggle('#realtimeHumidity', humidity, getRandomData);
  });

</script>
<?= $this->endSection() ?>

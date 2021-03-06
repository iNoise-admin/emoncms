<!--
   All Emoncms code is released under the GNU Affero General Public License.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
-->

<?php
  global $path;
  $embed = intval(get("embed"));
  $mid = intval(get("mid"));
?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.time.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/api.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/common/inst.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $path; ?>Modules/vis/visualisations/multigraph.js"></script>
 
<?php if (!$embed) { ?>
<h2>Multigraph</h2>
<?php } ?>

<div id="multigraph"></div>

<script id="source" language="javascript" type="text/javascript">

  var mid = <?php echo $mid; ?>;
  var path = "<?php echo $path; ?>";
  var embed = <?php echo $embed; ?>;
  var apikey = "<?php echo $apikey; ?>";
  var multigraph_feedlist = {};

  $.ajax({ url: path+"vis/multigraph/get.json", data: "&id="+mid, dataType: 'json', async: true,
    success: function(data)
    {
        multigraph_feedlist = data;

        var timeWindow = (3600000*24.0*7);				//Initial time window
        var start = ((new Date()).getTime())-timeWindow;		//Get start time
        var end = (new Date()).getTime();				//Get end time

        multigraph_init("#multigraph");
        vis_feed_data();
    } 
  });

</script>

